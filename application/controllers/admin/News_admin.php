<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_admin extends Admin_Controller
{
    private $upload_path;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('News_model', 'Category_model', 'Tag_model'));
        $this->load->library(array('form_validation', 'upload'));
        $this->upload_path = FCPATH . 'assets/uploads/news/';
    }

    public function index()
    {
        $data['news_list']  = $this->News_model->admin_get_all(100, 0);
        $data['page_title'] = 'Articles';
        $this->render('admin/news/index', $data);
    }

    public function create()
    {
        $data['categories'] = $this->Category_model->get_active();
        $data['news']       = NULL;
        $data['page_title'] = 'New Article';
        $this->render('admin/news/form', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('title',       'Title',    'required|min_length[5]|max_length[300]');
        $this->form_validation->set_rules('category_id', 'Category', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('body',        'Body',     'required|min_length[20]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('admin/news/create');
            return;
        }

        $title  = $this->input->post('title');
        $slug   = $this->News_model->generate_slug($title);
        $status = $this->input->post('status') ?: 'draft';
        $banner = $this->_handle_upload('banner_image');
        $banner2 = $this->_handle_upload('banner_image_2');
        $banner3 = $this->_handle_upload('banner_image_3');

        $id = $this->News_model->insert_news(array(
            'category_id'  => $this->input->post('category_id'),
            'admin_id'     => $this->session->userdata('admin_id'),
            'title'        => $title,
            'slug'         => $slug,
            'summary'      => $this->input->post('summary'),
            'body'         => $this->input->post('body'),
            'banner_image' => $banner,
            'banner_image_2' => $banner2,
            'banner_image_3' => $banner3,
            'is_featured'  => (int)(bool)$this->input->post('is_featured'),
            'is_breaking'  => (int)(bool)$this->input->post('is_breaking'),
            'status'       => $status,
            'published_at' => ($status === 'published') ? date('Y-m-d H:i:s') : NULL,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ));

        // Sync tags
        $tags = explode(',', $this->input->post('tags') ?: '');
        $this->Tag_model->sync_for_news((int)$id, $tags);

        $this->session->set_flashdata('success', 'Article created successfully!');
        redirect('admin/news');
    }

    public function edit($id)
    {
        $news = $this->News_model->get_by_id((int)$id);
        if ( ! $news) {
            $this->session->set_flashdata('error', 'Article not found.');
            redirect('admin/news');
        }
        $tags = $this->Tag_model->get_by_news_id((int)$id);
        $news['tags'] = implode(', ', array_column($tags, 'name'));

        $data['categories'] = $this->Category_model->get_active();
        $data['news']       = $news;
        $data['page_title'] = 'Edit Article';
        $this->render('admin/news/form', $data);
    }

    public function update($id)
    {
        $news = $this->News_model->get_by_id((int)$id);
        if ( ! $news) {
            $this->session->set_flashdata('error', 'Article not found.');
            redirect('admin/news');
        }

        $this->form_validation->set_rules('title',       'Title',    'required|min_length[5]|max_length[300]');
        $this->form_validation->set_rules('category_id', 'Category', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('body',        'Body',     'required|min_length[20]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('admin/news/edit/' . $id);
            return;
        }

        $status = $this->input->post('status') ?: 'draft';
        $banner = $this->_handle_upload('banner_image') ?: $news['banner_image'];
        $banner2 = $this->_handle_upload('banner_image_2') ?: $news['banner_image_2'];
        $banner3 = $this->_handle_upload('banner_image_3') ?: $news['banner_image_3'];

        $update = array(
            'category_id'  => $this->input->post('category_id'),
            'title'        => $this->input->post('title'),
            'summary'      => $this->input->post('summary'),
            'body'         => $this->input->post('body'),
            'banner_image' => $banner,
            'banner_image_2' => $banner2,
            'banner_image_3' => $banner3,
            'is_featured'  => (int)(bool)$this->input->post('is_featured'),
            'is_breaking'  => (int)(bool)$this->input->post('is_breaking'),
            'status'       => $status,
            'updated_at'   => date('Y-m-d H:i:s'),
        );
        if ($status === 'published' && $news['status'] !== 'published') {
            $update['published_at'] = date('Y-m-d H:i:s');
        }
        $this->News_model->update_news((int)$id, $update);

        $tags = explode(',', $this->input->post('tags') ?: '');
        $this->Tag_model->sync_for_news((int)$id, $tags);

        $this->session->set_flashdata('success', 'Article updated successfully!');
        redirect('admin/news');
    }

    public function delete($id)
    {
        $news = $this->News_model->get_by_id((int)$id);
        if ($news) {
            $images = [$news['banner_image'], $news['banner_image_2'], $news['banner_image_3']];
            foreach ($images as $img) {
                if (!empty($img) && file_exists($this->upload_path . $img)) {
                    @unlink($this->upload_path . $img);
                }
            }
        }
        $this->News_model->delete_news((int)$id);
        $this->session->set_flashdata('success', 'Article deleted.');
        redirect('admin/news');
    }

    public function toggle_status($id)
    {
        $news = $this->News_model->get_by_id((int)$id);
        if ($news) {
            $new_status = ($news['status'] === 'published') ? 'draft' : 'published';
            $upd = array('status' => $new_status, 'updated_at' => date('Y-m-d H:i:s'));
            if ($new_status === 'published' && empty($news['published_at'])) {
                $upd['published_at'] = date('Y-m-d H:i:s');
            }
            $this->News_model->update_news((int)$id, $upd);
        }
        $this->session->set_flashdata('success', 'Status updated.');
        redirect('admin/news');
    }

    // ── Private ───────────────────────────────────────────────────────────

    private function _handle_upload($field)
    {
        if ( ! isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            return NULL;
        }
        if ( ! is_dir($this->upload_path)) {
            mkdir($this->upload_path, 0755, TRUE);
        }
        $config = array(
            'upload_path'   => $this->upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|gif',
            'max_size'      => 2048,
            'encrypt_name'  => TRUE,
        );
        $this->upload->initialize($config);
        if ($this->upload->do_upload($field)) {
            return $this->upload->data('file_name');
        }
        return NULL;
    }
}
