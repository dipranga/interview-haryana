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

        // If custom slug toggle is ON, validate the slug field too
        if ($this->input->post('have_custom_slug')) {
            $this->form_validation->set_rules(
                'custom_slug', 'Custom Slug',
                'required|min_length[2]|max_length[120]|alpha_dash'
            );
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('admin/categories/create');
            return;
        }

        // Decide slug based on toggle and input
        $slug = $this->input->post('have_custom_slug') ? $this->Category_model->generate_slug($this->input->post('custom_slug')) : $this->Category_model->generate_slug($this->input->post('name'));

        $this->Category_model->insert_category(array(
            'name'       => $this->input->post('name'),
            'slug'       => $slug,
            'have_custom_slug' => (int)(bool)$this->input->post('have_custom_slug'),
            'color'      => $this->input->post('color') ?: '#1a3a6b',
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

        if ($this->input->post('have_custom_slug')) {
            $this->form_validation->set_rules(
                'custom_slug', 'Custom Slug',
                'required|min_length[2]|max_length[120]|alpha_dash'
            );
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('admin/categories/edit/' . $id);
            return;
        }

        // Decide slug based on toggle and input
        $slug = $this->input->post('have_custom_slug') ? $this->Category_model->generate_slug($this->input->post('custom_slug'), (int)$id) : $this->Category_model->generate_slug($this->input->post('name'), (int)$id);

        $this->Category_model->update_category((int)$id, array(
            'name'       => $this->input->post('name'),
            'slug'       => $slug,
            'have_custom_slug' => (int)(bool)$this->input->post('have_custom_slug'),
            'color'      => $this->input->post('color') ?: '#1a3a6b',
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
