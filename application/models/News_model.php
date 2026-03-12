<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // ── Public ───────────────────────────────────────────────────────────

    public function get_latest($limit = 12, $offset = 0)
    {
        return $this->db
            ->select('news.*, categories.name as cat_name, categories.slug as cat_slug, categories.color as cat_color')
            ->from('news')
            ->join('categories', 'categories.id = news.category_id')
            ->where('news.status', 'published')
            ->order_by('news.published_at', 'DESC')
            ->limit($limit, $offset)
            ->get()->result_array();
    }

    public function get_featured($limit = 5)
    {
        return $this->db
            ->select('news.*, categories.name as cat_name, categories.slug as cat_slug, categories.color as cat_color')
            ->from('news')
            ->join('categories', 'categories.id = news.category_id')
            ->where('news.status', 'published')
            ->where('news.is_featured', 1)
            ->order_by('news.published_at', 'DESC')
            ->limit($limit)
            ->get()->result_array();
    }

    public function get_breaking($limit = 8)
    {
        return $this->db
            ->select('news.id, news.title, news.slug, news.published_at')
            ->from('news')
            ->where('news.status', 'published')
            ->where('news.is_breaking', 1)
            ->order_by('news.published_at', 'DESC')
            ->limit($limit)
            ->get()->result_array();
    }

    public function get_by_category($cat_slug, $limit = 12, $offset = 0)
    {
        return $this->db
            ->select('news.*, categories.name as cat_name, categories.slug as cat_slug, categories.color as cat_color')
            ->from('news')
            ->join('categories', 'categories.id = news.category_id')
            ->where('categories.slug', $cat_slug)
            ->where('news.status', 'published')
            ->order_by('news.published_at', 'DESC')
            ->limit($limit, $offset)
            ->get()->result_array();
    }

    public function count_by_category($cat_slug)
    {
        return $this->db
            ->from('news')
            ->join('categories', 'categories.id = news.category_id')
            ->where('categories.slug', $cat_slug)
            ->where('news.status', 'published')
            ->count_all_results();
    }

    public function get_by_slug($slug)
    {
        return $this->db
            ->select('news.*, categories.name as cat_name, categories.slug as cat_slug, categories.color as cat_color, admins.name as author_name')
            ->from('news')
            ->join('categories', 'categories.id = news.category_id')
            ->join('admins', 'admins.id = news.admin_id')
            ->where('news.slug', $slug)
            ->where('news.status', 'published')
            ->get()->row_array();
    }

    public function search($q, $limit = 12, $offset = 0)
    {
        return $this->db
            ->select('news.*, categories.name as cat_name, categories.slug as cat_slug, categories.color as cat_color')
            ->from('news')
            ->join('categories', 'categories.id = news.category_id')
            ->where('news.status', 'published')
            ->group_start()
                ->like('news.title', $q)
                ->or_like('news.summary', $q)
                ->or_like('news.body', $q)
                ->or_like('categories.name', $q)
            ->group_end()
            ->order_by('news.published_at', 'DESC')
            ->limit($limit, $offset)
            ->get()->result_array();
    }

    public function count_search($q)
    {
        $this->db->from('news')
            ->join('categories', 'categories.id = news.category_id')
            ->where('status', 'published')
            ->group_start()
                ->like('title', $q)
                ->or_like('summary', $q)
                ->or_like('body', $q)
                ->or_like('categories.name', $q)
            ->group_end();
        return $this->db->count_all_results();
    }

    public function increment_views($id)
    {
        $this->db->set('views', 'views + 1', FALSE)
                 ->where('id', $id)
                 ->update('news');
    }

    // ── Admin ─────────────────────────────────────────────────────────────

    public function admin_get_all($limit = 50, $offset = 0)
    {
        return $this->db
            ->select('news.*, categories.name as cat_name, admins.name as author_name')
            ->from('news')
            ->join('categories', 'categories.id = news.category_id')
            ->join('admins', 'admins.id = news.admin_id')
            ->order_by('news.created_at', 'DESC')
            ->limit($limit, $offset)
            ->get()->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('news', array('id' => $id))->row_array();
    }

    public function insert_news($data)
    {
        $this->db->insert('news', $data);
        return $this->db->insert_id();
    }

    public function update_news($id, $data)
    {
        $this->db->where('id', $id)->update('news', $data);
    }

    public function delete_news($id)
    {
        $this->db->where('id', $id)->delete('news');
    }

    public function generate_slug($title, $exclude_id = NULL)
    {
        // Simple ASCII slug (works for English; Hindi chars stripped)
        $slug = mb_strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9\s-]/u', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');
        if (empty($slug)) {
            $slug = 'news-' . time();
        }

        $original = $slug;
        $i = 1;
        while (TRUE) {
            $this->db->where('slug', $slug);
            if ($exclude_id) {
                $this->db->where('id !=', $exclude_id);
            }
            $count = $this->db->count_all_results('news');
            if ($count === 0) break;
            $slug = $original . '-' . $i++;
        }
        return $slug;
    }

    public function count_all()
    {
        return $this->db->count_all('news');
    }

    public function count_by_status($status)
    {
        return $this->db->where('status', $status)->count_all_results('news');
    }
}
