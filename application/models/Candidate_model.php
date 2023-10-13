<?php defined('BASEPATH') or exit('No direct script access allowed');

class Candidate_model extends CI_Model
{
    private $_table = "t_candidate";

    public $candidate_id;
    public $email;
    public $phone_number;
    public $full_name;
    public $dob;
    public $pob;
    public $gender;
    public $year_exp;
    public $last_salary;

    public function rules()
    {
        return [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[t_candidate.email]'
            ],

            [
                'field' => 'phone_number',
                'label' => 'Phone Number',
                'rules' => 'required|is_unique[t_candidate.phone_number]'
            ],

            [
                'field' => 'full_name',
                'label' => 'Full Name',
                'rules' => 'required'
            ],

            [
                'field' => 'dob',
                'label' => 'Date of Birth',
                'rules' => 'required'
            ],

            [
                'field' => 'pob',
                'label' => 'Place of Birth',
                'rules' => 'required'
            ],

            [
                'field' => 'gender',
                'label' => 'Gender',
                'rules' => 'required'
            ],

            [
                'field' => 'year_exp',
                'label' => 'Year Experience',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["candidate_id " => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $uniqueId = mt_rand(1, 2147483647); // Generate a random integer
        $twelveDigitUniqueId = str_pad($uniqueId, 12, '0', STR_PAD_LEFT);

        $this->candidate_id = $twelveDigitUniqueId;
        $this->email = $post["email"];
        $this->phone_number = $post["phone_number"];
        $this->full_name = $post["full_name"];
        $this->dob = $post["dob"];
        $this->pob = $post["pob"];
        $this->gender = $post["gender"];
        $this->year_exp = $post["year_exp"];
        $this->last_salary = $post["last_salary"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->candidate_id = $post['candidate_id'];
        $this->email = $post["email"];
        $this->phone_number = $post["phone_number"];
        $this->full_name = $post["full_name"];
        $this->dob = $post["dob"];
        $this->pob = $post["pob"];
        $this->gender = $post["gender"];
        $this->year_exp = $post["year_exp"];
        $this->last_salary = $post["last_salary"];
        return $this->db->update($this->_table, $this, array('candidate_id' => $post['candidate_id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("candidate_id" => $id));
    }

    public function getData($rowno, $rowperpage, $search = "")
    {

        $this->db->select('*');
        $this->db->from($this->_table);

        if ($search != '') {
            $this->db->like('full_name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone_number', $search);
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
            $this->db->like('full_name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone_number', $search);
        }

        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['allcount'];
    }
}
