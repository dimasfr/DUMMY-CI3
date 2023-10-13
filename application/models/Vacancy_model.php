<?php defined('BASEPATH') or exit('No direct script access allowed');

class Vacancy_model extends CI_Model
{
    private $_table = "t_vacancy";

    public $vacancy_id;
    public $vacancy_name;

    public function rules()
    {
        return [
            [
                'field' => 'vacancy_name',
                'label' => 'Vacancy Name',
                'rules' => 'required'
            ],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["vacancy_id " => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $uniqueId = mt_rand(1, 2147483647); // Generate a random integer
        $twelveDigitUniqueId = str_pad($uniqueId, 12, '0', STR_PAD_LEFT);

        $this->vacancy_id = $twelveDigitUniqueId;
        $this->vacancy_name = $post["vacancy_name"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->vacancy_id = $post["vacancy_id"];
        $this->vacancy_name = $post["vacancy_name"];
        return $this->db->update($this->_table, $this, array('vacancy_id' => $post['vacancy_id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("vacancy_id" => $id));
    }

    public function getData($rowno, $rowperpage, $search = "")
    {

        $this->db->select('*');
        $this->db->from($this->_table);

        if ($search != '') {
            $this->db->like('vacancy_name', $search);
        }

        $this->db->limit($rowperpage, $rowno);
        $query = $this->db->get();

        return $query->result_array();
    }

    // Select total records
    public function getrecordCount($search = '')
    {

        $this->db->select('count(*) as allcount');
        $this->db->from($this->_table);

        if ($search != '') {
            $this->db->like('vacancy_name', $search);
        }

        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['allcount'];
    }
}
