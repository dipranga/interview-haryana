<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('News_model', 'Category_model', 'Banner_model'));
    }

    public function index()
    {
        $data['sliders']       = $this->Banner_model->get_active('homepage_slider');
        $data['featured']      = $this->News_model->get_featured(6);
        $data['breaking']      = $this->News_model->get_breaking(8);
        $data['latest']        = $this->News_model->get_latest(4);
        $data['sidebar_banners'] = $this->Banner_model->get_active('sidebar');

        // Latest news per first 4 categories
        $all_cats = $this->Category_model->get_active();
        $top_cats = array_slice($all_cats, 0, 4);
        $data['cat_news'] = array();
        foreach ($top_cats as $cat) {
            $data['cat_news'][$cat['slug']] = array(
                'cat'  => $cat,
                'news' => $this->News_model->get_by_category($cat['slug'], 4),
            );
        }

        $data['page_title'] = $this->settings['site_name'];
        $this->render('home/index', $data);
    }

    public function about_us()
    {
        $data['page_title'] = 'About Us - ' . $this->settings['site_name'];
        $this->render('home/about_us', $data);
    }
}
