<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model
{
    public function get_active($position = 'homepage_slider')
    {
        return $this->db->where('is_active', 1)->where('position', $position)->order_by('sort_order', 'ASC')->get('banners')->result_array();
    }

    public function get_all()
    {
        return $this->db->order_by('sort_order', 'ASC')->get('banners')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('banners', array('id' => $id))->row_array();
    }

    public function insert_banner($data)
    {
        $this->db->insert('banners', $data);
        return $this->db->insert_id();
    }

    public function update_banner($id, $data)
    {
        $this->db->where('id', $id)->update('banners', $data);
    }

    public function delete_banner($id)
    {
        $this->db->where('id', $id)->delete('banners');
    }

    public function count_all()
    {
        return $this->db->count_all('banners');
    }
}
