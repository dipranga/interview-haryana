<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_admin extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['categories'] = $this->Category_model->get_all();
        $data['page_title'] = 'Categories';
        $this->render('admin/categories/index', $data);
    }

    public function create()
    {
        $data['cat']        = NULL;
        $data['page_title'] = 'New Category';
        $this->render('admin/categories/form', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[100]');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('admin/categories/create');
            return;
        }
        $this->Category_model->insert_category(array(
            'name'       => $this->input->post('name'),
            'slug'       => $this->Category_model->generate_slug($this->input->post('name')),
            'color'      => $this->input->post('color') ?: '#e63946',
            'sort_order' => (int)$this->input->post('sort_order'),
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        $this->session->set_flashdata('success', 'Category created!');
        redirect('admin/categories');
    }

    public function edit($id)
    {
        $data['cat']        = $this->Category_model->get_by_id((int)$id);
        $data['page_title'] = 'Edit Category';
        $this->render('admin/categories/form', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('admin/categories/edit/' . $id);
            return;
        }
        $this->Category_model->update_category((int)$id, array(
            'name'       => $this->input->post('name'),
            'color'      => $this->input->post('color') ?: '#e63946',
            'sort_order' => (int)$this->input->post('sort_order'),
            'is_active'  => (int)(bool)$this->input->post('is_active'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        $this->session->set_flashdata('success', 'Category updated!');
        redirect('admin/categories');
    }

    public function delete($id)
    {
        $this->Category_model->delete_category((int)$id);
        $this->session->set_flashdata('success', 'Category deleted.');
        redirect('admin/categories');
    }
}
