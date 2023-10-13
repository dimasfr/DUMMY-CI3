<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CandidateController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("candidate_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('candidate');
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
        $rowperpage = 5;

        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        // All records count
        $allcount = $this->candidate_model->getrecordCount($search_text);

        // Get records
        $users_record = $this->candidate_model->getData($rowno, $rowperpage, $search_text);

        // Pagination Configuration
        $config['base_url'] = base_url() . 'candidate/getTable';
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


    public function add()
    {
        $candidate = $this->candidate_model;
        $validation = $this->form_validation;
        $validation->set_rules($candidate->rules());

        $data = array('status' => true);
        if ($validation->run()) {
            $candidate->save();
            $this->session->set_flashdata('success', 'Saved');
        } else {
            $data = array('status' => false);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function edit()
    {
        $candidate = $this->candidate_model;

        $data = array('status' => true);
        if ($candidate->update()) {
            $this->session->set_flashdata('success', 'Saved');
        } else {
            $data = array('status' => false);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        $data = array('status' => false);
        if ($this->candidate_model->delete($id)) {
            $data = array('status' => true);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function downloadReport()
    {
        require_once(APPPATH . 'third_party/fpdf/fpdf.php');
        // Fetch data from your data source (e.g., database)
        $data = $this->candidate_model->getAll();

        $pdf = new FPDF();
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', 'B', 16);

        // Add title
        $pdf->Cell(0, 10, 'Candidate Data', 0, 1, 'C');

        // Add data from the database
        foreach ($data as $row) {
            $pdf->Cell(0, 10, 'Email: ' . $row->email, 0, 1);
            $pdf->Cell(0, 10, 'Phone Number: ' . $row->phone_number, 0, 1);
            $pdf->Cell(0, 10, 'Full Name: ' . $row->full_name, 0, 1);
            $pdf->Cell(0, 10, 'Date of Birth: ' . $row->dob, 0, 1);
            $pdf->Cell(0, 10, 'Place of Birth: ' . $row->pob, 0, 1);
            $pdf->Cell(0, 10, 'Gender: ' . $row->gender, 0, 1);
            $pdf->Cell(0, 10, 'Years of Experience: ' . $row->year_exp, 0, 1);
            $pdf->Cell(0, 10, 'Last Salary: ' . $row->last_salary, 0, 1);
            $pdf->Ln(10); // Add some space between records
        }

        // Output the PDF content as a base64 encoded string
        ob_start();
        $pdf->Output();
        $pdfContent = ob_get_clean();
        ob_end_clean();

        // Encode the PDF content as base64
        $pdfBase64 = base64_encode($pdfContent);

        // Return the base64 encoded content as JSON
        header('Content-Type: application/json');
        echo json_encode(['pdfBase64' => $pdfBase64]);
    }
}
