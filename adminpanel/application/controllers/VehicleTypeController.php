<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VehicleTypeController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('VehicleTypeModel');
        $this->load->library('pagination');
        $this->load->database(); // Load database library
    }

    public function index() {
        // Pagination configuration
        $config['base_url'] = site_url('vehicletypecontroller/index');
        $config['total_rows'] = $this->VehicleTypeModel->count_vehicle_types();
        $config['per_page'] = 5; // Number of records per page
        $config['uri_segment'] = 3; // URI segment for pagination
        $this->pagination->initialize($config);

        $data['vehicle_types'] = $this->VehicleTypeModel->get_all_vehicle_types($config['per_page'], $this->uri->segment(3));
        $data['pagination'] = $this->pagination->create_links();

        
        $this->load->view('template/header');
        $this->load->view('vehicle_types/index', $data);
        $this->load->view('template/footer');
    }

    public function create() {
        if ($this->input->post()) {
            $data = [
                'vehicle_name' => $this->input->post('vehicle_name'),
                'capacity' => $this->input->post('capacity'),
                'status' => $this->input->post('status')
            ];
            $this->VehicleTypeModel->insert_vehicle_type($data);
            redirect('vehicletypecontroller/index');
        }
        $this->load->view('vehicle_types/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = [
                'vehicle_name' => $this->input->post('vehicle_name'),
                'capacity' => $this->input->post('capacity'),
                'status' => $this->input->post('status')
            ];
            $this->VehicleTypeModel->update_vehicle_type($id, $data);
            redirect('vehicletypecontroller/index');
        }

        $data['vehicle_type'] = $this->VehicleTypeModel->get_vehicle_type($id);
        $this->load->view('vehicle_types/edit', $data);
    }

    public function delete($id) {
        $this->VehicleTypeModel->delete_vehicle_type($id);
        redirect('vehicletypecontroller/index');
    }
}
