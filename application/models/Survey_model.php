<?php

class Survey_model extends CI_Model
{
    public function get_group()
    {
        $this->db->select('survey_group.*, saker.name');
        $this->db->from('survey_group');
        $this->db->join('saker', 'saker.id = survey_group.saker_id');

        $query = $this->db->get();
        return $query->result();
    }

    public function addGroupLayanan($table, $data)
    {
        $this->db->insert($data, $table);
    }

    public function updateGroupLayanan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function destroyGroupLayanan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
