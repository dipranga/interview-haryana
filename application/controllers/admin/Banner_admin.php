<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_admin extends Admin_Controller
{
    private $upload_path;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Banner_model');
        $this->load->library(array('form_validation', 'upload'));
        $this->upload_path = FCPATH . 'assets/uploads/banners/';
    }

    public function index()
    {
        $data['banners']    = $this->Banner_model->get_all();
        $data['page_title'] = 'Banners & Sliders';
        $this->render('admin/banners/index', $data);
    }

    public function create()
    {
        $data['banner']     = NULL;
        $data['page_title'] = 'New Banner';
        $this->render('admin/banners/form', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('admin/banners/create');
            return;
        }
        $image = $this->_handle_upload('image');
        if ( ! $image) {
            $this->session->set_flashdata('error', 'Image upload failed. Please upload a valid image (JPG/PNG/WebP, max 2MB).');
            redirect('admin/banners/create');
            return;
        }
        $this->Banner_model->insert_banner(array(
            'title'      => $this->input->post('title'),
            'subtitle'   => $this->input->post('subtitle'),
            'image'      => $image,
            'link_url'   => $this->input->post('link_url'),
            'position'   => $this->input->post('position') ?: 'homepage_slider',
            'sort_order' => (int)$this->input->post('sort_order'),
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        $this->session->set_flashdata('success', 'Banner created!');
        redirect('admin/banners');
    }

    public function edit($id)
    {
        $data['banner']     = $this->Banner_model->get_by_id((int)$id);
        $data['page_title'] = 'Edit Banner';
        $this->render('admin/banners/form', $data);
    }

    public function update($id)
    {
        $banner = $this->Banner_model->get_by_id((int)$id);
        $image  = $this->_handle_upload('image') ?: $banner['image'];
        $this->Banner_model->update_banner((int)$id, array(
            'title'      => $this->input->post('title'),
            'subtitle'   => $this->input->post('subtitle'),
            'image'      => $image,
            'link_url'   => $this->input->post('link_url'),
            'position'   => $this->input->post('position'),
            'sort_order' => (int)$this->input->post('sort_order'),
            'is_active'  => (int)(bool)$this->input->post('is_active'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        $this->session->set_flashdata('success', 'Banner updated!');
        redirect('admin/banners');
    }

    public function delete($id)
    {
        $banner = $this->Banner_model->get_by_id((int)$id);
        if ($banner && file_exists($this->upload_path . $banner['image'])) {
            @unlink($this->upload_path . $banner['image']);
        }
        $this->Banner_model->delete_banner((int)$id);
        $this->session->set_flashdata('success', 'Banner deleted.');
        redirect('admin/banners');
    }

    private function _handle_upload($field)
    {
        if ( ! isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) return NULL;
        if ( ! is_dir($this->upload_path)) mkdir($this->upload_path, 0755, TRUE);
        $config = array(
            'upload_path'   => $this->upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|gif',
            'max_size'      => 2048,
            'encrypt_name'  => TRUE,
        );
        $this->upload->initialize($config);
        return $this->upload->do_upload($field) ? $this->upload->data('file_name') : NULL;
    }
}
