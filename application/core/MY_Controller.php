<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller — Base controller for all CI3 controllers
 * Provides common helpers: settings loader, auth check
 */
class MY_Controller extends CI_Controller
{
    protected $settings = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model');
        $this->settings = $this->Settings_model->get_all();
    }

    // Pass settings + categories to every public view
    protected function render($view, $data = array())
    {
        $this->load->model('Category_model');
        $data['settings']   = $this->settings;
        $data['categories'] = $this->Category_model->get_active();
        $this->load->view('layouts/header', $data);
        $this->load->view($view, $data);
        $this->load->view('layouts/footer', $data);
    }
}

// ─────────────────────────────────────────────────────────────────────────────

/**
 * Admin_Controller — Base for all admin controllers
 * Checks admin session on every request
 */
class Admin_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_check_auth();
    }

    private function _check_auth()
    {
        if (! $this->session->userdata('admin_logged_in')) {
            $this->session->set_flashdata('error', 'Please login to continue.');
            redirect('admin/login');
        }
    }

    // Render admin view wrapped in layout
    protected function render($view, $data = array())
    {
        $this->load->view('admin/layout_top', $data);
        $this->load->view($view, $data);
        $this->load->view('admin/layout_bottom');
    }
}
