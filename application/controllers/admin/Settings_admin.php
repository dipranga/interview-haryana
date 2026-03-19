<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_admin extends Admin_Controller
{
    private $logo_path;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->library('upload');
        $this->logo_path = FCPATH . 'assets/images/';
    }

    public function index()
    {
        $data['settings']   = $this->Settings_model->get_all();
        $data['page_title'] = 'Site Settings';
        $this->render('admin/settings/index', $data);
    }

    public function update()
    {
        $skip = array('csrf_token');
        foreach ($this->input->post() as $key => $value) {
            if ( ! in_array($key, $skip)) {
                $this->Settings_model->set_setting($key, $value);
            }
        }
        $this->session->set_flashdata('success', 'Settings saved!');
        redirect('admin/settings');
    }

    public function upload_logo()
    {
        if ( ! isset($_FILES['site_logo']) || $_FILES['site_logo']['error'] !== UPLOAD_ERR_OK) {
            $this->session->set_flashdata('error', 'Please select an image file to upload.');
            redirect('admin/settings');
            return;
        }

        if ( ! is_dir($this->logo_path)) {
            mkdir($this->logo_path, 0755, TRUE);
        }

        $config = array(
            'upload_path'   => $this->logo_path,
            'allowed_types' => 'jpg|jpeg|png|gif|webp|svg',
            'max_size'      => 2048,       // 2 MB
            'encrypt_name'  => FALSE,      // Keep name readable
            'file_name'     => 'logo',     // Always save as "logo.*"
        );
        $this->upload->initialize($config);

        if ($this->upload->do_upload('site_logo')) {
            $file_name = $this->upload->data('file_name');

            // Remove any old logo files with different extensions
            foreach (glob($this->logo_path . 'logo.*') as $old_file) {
                if (basename($old_file) !== $file_name) {
                    @unlink($old_file);
                }
            }

            $this->Settings_model->set_setting('site_logo', $file_name);
            $this->session->set_flashdata('success', 'Logo uploaded successfully!');
        } else {
            $this->session->set_flashdata('error', 'Upload failed: ' . $this->upload->display_errors('', ''));
        }

        redirect('admin/settings');
    }

    public function remove_logo()
    {
        $current = $this->Settings_model->get_all();
        if (!empty($current['site_logo'])) {
            $file = $this->logo_path . $current['site_logo'];
            if (file_exists($file)) {
                @unlink($file);
            }
        }
        $this->Settings_model->set_setting('site_logo', '');
        $this->session->set_flashdata('success', 'Logo removed. Site name text will now show in the header.');
        redirect('admin/settings');
    }

    public function change_password()
    {
        if ( ! $this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
            return;
        }
        $data['page_title'] = 'Change Password';
        $this->render('admin/settings/change_password');   
    }
}
