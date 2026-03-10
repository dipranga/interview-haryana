<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public function get_active()
    {
        return $this->db->where('is_active', 1)->order_by('sort_order', 'ASC')->get('categories')->result_array();
    }

    public function get_all()
    {
        return $this->db->order_by('sort_order', 'ASC')->get('categories')->result_array();
    }

    public function get_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->where('is_active', 1)->get('categories')->row_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('categories', array('id' => $id))->row_array();
    }

    public function insert_category($data)
    {
        $this->db->insert('categories', $data);
        return $this->db->insert_id();
    }

    public function update_category($id, $data)
    {
        $this->db->where('id', $id)->update('categories', $data);
    }

    public function delete_category($id)
    {
        $this->db->where('id', $id)->delete('categories');
    }

    public function generate_slug($name, $exclude_id = NULL)
    {
        $slug = mb_strtolower(trim($name));
        $slug = preg_replace('/[^a-z0-9\s-]/u', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-') ?: 'category-' . time();
        $orig = $slug; $i = 1;
        while (TRUE) {
            $this->db->where('slug', $slug);
            if ($exclude_id) $this->db->where('id !=', $exclude_id);
            if ($this->db->count_all_results('categories') === 0) break;
            $slug = $orig . '-' . $i++;
        }
        return $slug;
    }

    public function count_all()
    {
        return $this->db->count_all('categories');
    }
}
