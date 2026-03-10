<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_admin extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tag_model');
    }

    public function index()
    {
        $data['tags']       = $this->Tag_model->get_all_with_count();
        $data['page_title'] = 'Tags';
        $this->render('admin/tags/index', $data);
    }

    public function store()
    {
        $names = explode(',', $this->input->post('names') ?: '');
        foreach ($names as $name) {
            $name = trim($name);
            if (empty($name)) continue;
            $slug   = mb_strtolower(preg_replace('/\s+/', '-', $name));
            $exists = $this->db->where('slug', $slug)->count_all_results('tags');
            if ( ! $exists) {
                $this->db->insert('tags', array(
                    'name'       => $name,
                    'slug'       => $slug,
                    'created_at' => date('Y-m-d H:i:s'),
                ));
            }
        }
        $this->session->set_flashdata('success', 'Tags added!');
        redirect('admin/tags');
    }

    public function delete($id)
    {
        $this->Tag_model->delete_tag((int)$id);
        $this->session->set_flashdata('success', 'Tag deleted.');
        redirect('admin/tags');
    }
}
