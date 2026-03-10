<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function find_by_email($email)
    {
        return $this->db
            ->where('email', $email)
            ->where('is_active', 1)
            ->get('admins')
            ->row_array();
    }

    public function find_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('admins')
            ->row_array();
    }

    public function update_last_login($id)
    {
        $this->db->where('id', $id)->update('admins', array(
            'last_login' => date('Y-m-d H:i:s'),
        ));
    }

    public function update_password($id, $new_password)
    {
        $this->db->where('id', $id)->update('admins', array(
            'password' => password_hash($new_password, PASSWORD_DEFAULT),
        ));
    }
}
