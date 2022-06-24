<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getAllRole()
    {
        $query = $this->db->get('user_role');
        return $query->result_array();
    }

    public function deleteRole($id)
    {
        return $this->db->delete('user_role', ['id' => $id]);
    }

    public function getAllSurvei($id)
    {
        $query = $this->db->get('t_survei');
        return $query->result_array($id);
    }

    public function deleteManage($id)
    {
        return $this->db->delete('t_survei', ['id' => $id]);
    }
}
