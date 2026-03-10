<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }
        $this->load->view('admin/login');
    }

    public function login_post()
    {
        $this->form_validation->set_rules('email',    'Email',    'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect('admin/login');
            return;
        }

        $admin = $this->Admin_model->find_by_email($this->input->post('email'));

        if ( ! $admin || ! password_verify($this->input->post('password'), $admin['password'])) {
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('admin/login');
            return;
        }

        $this->session->set_userdata(array(
            'admin_logged_in' => TRUE,
            'admin_id'        => $admin['id'],
            'admin_name'      => $admin['name'],
            'admin_role'      => $admin['role'],
        ));

        $this->Admin_model->update_last_login($admin['id']);
        $this->session->set_flashdata('success', 'Welcome back, ' . $admin['name'] . '!');
        redirect('admin/dashboard');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logged out successfully.');
        redirect('admin/login');
    }

    public function change_password_post()
    {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect('admin/settings/change_password');
            return;
        }

        $admin_id = $this->session->userdata('admin_id');
        $admin = $this->Admin_model->find_by_id($admin_id);

        if ( ! password_verify($this->input->post('current_password'), $admin['password'])) {
            $this->session->set_flashdata('error', 'Current password is incorrect.');
            redirect('admin/settings/change_password');
            return;
        }

        $this->Admin_model->update_password($admin_id, $this->input->post('new_password'));

        $this->session->set_flashdata('success', 'Password changed successfully.');
        redirect('admin/dashboard');
    }
}
