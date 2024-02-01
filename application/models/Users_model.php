<?php
class Users_model extends CI_Model
{
    public function register($data)
    {
        $this->db->insert('user', $data);
        return $this->db->affected_rows();
    }
}
