<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('News_model', 'Category_model', 'Banner_model'));
    }

    public function index()
    {
        $data['total_news']       = $this->News_model->count_all();
        $data['published_news']   = $this->News_model->count_by_status('published');
        $data['draft_news']       = $this->News_model->count_by_status('draft');
        $data['total_categories'] = $this->Category_model->count_all();
        $data['total_banners']    = $this->Banner_model->count_all();
        $data['recent_news']      = $this->News_model->admin_get_all(8, 0);
        $data['page_title']       = 'Dashboard';
        $this->render('admin/dashboard', $data);
    }
}
