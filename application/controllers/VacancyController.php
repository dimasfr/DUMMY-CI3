<?php

defined('BASEPATH') or exit('No direct script access allowed');

class VacancyController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("vacancy_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('vacancy');
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
        $allcount = $this->vacancy_model->getrecordCount($search_text);

        // Get records
        $users_record = $this->vacancy_model->getData($rowno, $rowperpage, $search_text);

        // Pagination Configuration
        $config['base_url'] = base_url() . 'apply/getTable';
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
        $candidate = $this->vacancy_model;
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
        $candidate = $this->vacancy_model;

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
        if ($this->vacancy_model->delete($id)) {
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
        $data = $this->vacancy_model->getAll();

        $pdf = new FPDF();
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', 'B', 16);

        // Add title
        $pdf->Cell(0, 10, 'Vacancy List', 0, 1, 'C');

        // Add data from the database
        $no = 1;
        foreach ($data as $row) {
            $pdf->Cell(0, 10, $no++ . '. ' . $row->vacancy_name, 0, 1);
            $pdf->Ln(1); // Add some space between records
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
