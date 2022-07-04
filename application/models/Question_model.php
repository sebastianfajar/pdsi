<?php

class Question_model extends CI_Model
{
    public function getQuestion()
    {
        $this->db->select('survey_question.*, user.*, saker.*, survey_group.*');
        $this->db->from('survey_question');
        $this->db->join('user', 'survey_question.user_id = user.id');
        $this->db->join('saker', 'survey_question.saker_id = saker.id');
        $this->db->join('survey_group', 'survey_question.group_id = survey_group.id');

        $query = $this->db->get();
        return $query->result();
    }

    public function addQuestion($table, $data)
    {
        $this->db->insert($data, $table);
    }

    public function updateQuestion($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function destroyQuestion($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
