<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ApplyController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("apply_model");
        $this->load->model("vacancy_model");
        $this->load->model("candidate_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('apply');
    }

    public function getTable($rowno = 0)
    {
        // Search text
        $search_text = "";
        if ($this->input->post('search') != NULL) {
            $search_text = $this->input->post('search');
            $this->session->set_userdata(array("search" => $search_text));
        }

        // Row per page
        $rowperpage = 6;

        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        // All records count
        $allcount = $this->vacancy_model->getrecordCount($search_text);

        // Get records
        $users_record = $this->vacancy_model->getData($rowno, $rowperpage, $search_text);

        // Pagination Configuration
        $config['base_url'] = base_url() . 'vacancy/getTable';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;
        $data['search'] = $search_text;

        // Load view
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getCandidate()
    {
        $data = $this->candidate_model->getAll();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function apply()
    {
        $apply = $this->apply_model;
        $validation = $this->form_validation;
        $validation->set_rules($apply->rules());

        $data = array('status' => true);
        if ($apply->getById()) {
            $data = array('status' => false, 'msg' => 'Already Applying');
        } else {
            if ($validation->run()) {
                $apply->save();
            } else {
                $data = array('status' => false, 'msg' => 'Error Detected');
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
