<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    public function get_all()
    {
        $rows = $this->db->get('settings')->result_array();
        $out  = array();
        foreach ($rows as $r) {
            $out[$r['key']] = $r['value'];
        }
        return $out;
    }

    public function set_setting($key, $value)
    {
        $exists = $this->db->where('key', $key)->count_all_results('settings');
        if ($exists > 0) {
            $this->db->where('key', $key)->update('settings', array('value' => $value));
        } else {
            $this->db->insert('settings', array('key' => $key, 'value' => $value));
        }
    }
}
