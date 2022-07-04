<?php

class Saker_model extends CI_Model
{
    public function getSaker()
    {
        $query = $this->db->query("SELECT * FROM saker")->result();
        return $query;
    }

    public function addSaker($table, $data)
    {
        $this->db->insert($data, $table);
    }

    public function updateSaker($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function destroySaker($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
