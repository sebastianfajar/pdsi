<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu` FROM `user_sub_menu` JOIN `user_menu`ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";
        return $this->db->query($query)->result_array();
    }

    public function getAllMenu($id)
    {
        $query = $this->db->get('user_menu');
        return $query->result_array($id);
    }

    public function deleteMenu($id)
    {
        return $this->db->delete('user_menu', ['id' => $id]);
    }

    public function deleteSubMenu($id)
    {
        return $this->db->delete('user_sub_menu', ['id' => $id]);
    }
}
