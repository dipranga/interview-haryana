<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller
{
    private $per_page = 12;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('News_model', 'Category_model', 'Tag_model', 'Banner_model'));
    }

    public function show($slug)
    {
        $news = $this->News_model->get_by_slug($slug);
        if ( ! $news) {
            show_404();
        }
        $this->News_model->increment_views((int)$news['id']);
        $news['tags'] = $this->Tag_model->get_by_news_id((int)$news['id']);

        $related = $this->News_model->get_by_category($news['cat_slug'], 4);
        $related = array_filter($related, function($n) use ($news) {
            return $n['id'] != $news['id'];
        });

        $data['news']      = $news;
        $data['related']   = array_values($related);
        $data['breaking']  = $this->News_model->get_breaking(8);
        $data['page_title'] = $news['title'] . ' | ' . $this->settings['site_name'];
        $this->render('news/show', $data);
    }

    public function category($slug)
    {
        $cat = $this->Category_model->get_by_slug($slug);
        if ( ! $cat) {
            show_404();
        }
        $page   = max(1, (int)$this->input->get('page'));
        $offset = ($page - 1) * $this->per_page;
        $total  = $this->News_model->count_by_category($slug);

        $data['cat']      = $cat;
        $data['news']     = $this->News_model->get_by_category($slug, $this->per_page, $offset);
        $data['total']    = $total;
        $data['page']     = $page;
        $data['per_page'] = $this->per_page;
        $data['breaking'] = $this->News_model->get_breaking(8);
        $data['page_title'] = $cat['name'] . ' | ' . $this->settings['site_name'];
        $this->render('news/category', $data);
    }

    public function search()
    {
        $q      = trim($this->input->get('q'));
        $page   = max(1, (int)$this->input->get('page'));
        $offset = ($page - 1) * $this->per_page;

        $data['query']    = $q;
        $data['results']  = $q ? $this->News_model->search($q, $this->per_page, $offset) : array();
        $data['total']    = $q ? $this->News_model->count_search($q) : 0;
        $data['page']     = $page;
        $data['per_page'] = $this->per_page;
        $data['breaking'] = $this->News_model->get_breaking(8);
        $data['page_title'] = 'खोज: ' . $q . ' | ' . $this->settings['site_name'];
        $this->render('news/search', $data);
    }

    public function tag($slug)
    {
        $data['tag_slug']   = $slug;
        $data['breaking']   = $this->News_model->get_breaking(8);
        $data['page_title'] = 'Tag: ' . $slug . ' | ' . $this->settings['site_name'];
        $this->render('news/tag', $data);
    }
}
