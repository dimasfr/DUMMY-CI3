<?php defined('BASEPATH') or exit('No direct script access allowed');

class Apply_model extends CI_Model
{
    private $_table = "t_vacancy_apply";

    public $apply_id;
    public $vacancy_id;
    public $candidate_id;

    public function rules()
    {
        return [
            [
                'field' => 'vacancy_id',
                'label' => 'Vacancy',
                'rules' => 'required'
            ],

            [
                'field' => 'candidate_id',
                'label' => 'Candidate',
                'rules' => 'required'
            ],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById()
    {
        $post = $this->input->post();
        return $this->db->get_where($this->_table, ["vacancy_id" => $post["vacancy_id"], "candidate_id" => $post["candidate_id"]])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $uniqueId = mt_rand(1, 2147483647); // Generate a random integer
        $twelveDigitUniqueId = str_pad($uniqueId, 12, '0', STR_PAD_LEFT);

        $this->apply_id = $twelveDigitUniqueId;
        $this->vacancy_id = $post["vacancy_id"];
        $this->candidate_id = $post["candidate_id"];
        return $this->db->insert($this->_table, $this);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("apply_id" => $id));
    }
}
