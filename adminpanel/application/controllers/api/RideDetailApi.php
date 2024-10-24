<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RideDetailApi extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('RideDetailModel');
        $this->load->library('form_validation');
        $this->load->helper('url');
        header('Content-Type: application/json');
    }

    public function create() 
    {
    	if ($this->input->server('REQUEST_METHOD') !== 'POST') {
        echo json_encode(['status' => 'error', 'message' => 'Only POST method is allowed.']);
        return;
    	}

    	//print_r($this->input->post()); 
    	//print_r($this->input->post()); die();

    	//log_message('info', 'Input Data: ' . print_r($this->input->post(), true));

        // Set validation rules
        $this->form_validation->set_rules('driver_idfk', 'Driver ID', 'required|integer');
        $this->form_validation->set_rules('rider_idfk', 'Rider ID', 'required|integer');
        $this->form_validation->set_rules('from_location_idfk', 'From Location ID', 'required|integer');
        $this->form_validation->set_rules('to_location_idfk', 'To Location ID', 'required|integer');
        $this->form_validation->set_rules('trip_type', 'Trip Type', 'required|in_list[one-way,round-trip]');
        $this->form_validation->set_rules('vehicle_type_fk', 'Vehicle Type ID', 'required|integer');
        $this->form_validation->set_rules('passenger_limit', 'Passenger Limit', 'required|integer');
        $this->form_validation->set_rules('available_limit', 'Available Limit', 'required|integer');
        $this->form_validation->set_rules('filled_seates', 'Filled Seats', 'required|integer');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('drop_time', 'Drop Time', 'required');
        $this->form_validation->set_rules('time_relaxation', 'Time Relaxation', 'required|integer');
        $this->form_validation->set_rules('smoking', 'Smoking', 'required|in_list[yes,no]');
        $this->form_validation->set_rules('same_gander', 'Same Gender', 'required|in_list[yes,no]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[male,female,any]');
        //$this->form_validation->set_rules('addition_info', 'Additional Info', 'optional');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[active,inactive]');
        $this->form_validation->set_rules('is_available', 'Is Available', 'required|in_list[yes,no]');

        if ($this->form_validation->run() == FALSE) 
        {
            // Validation failed
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        // Prepare data for insertion
        $data = [
            'driver_idfk' 			=> $this->input->post('driver_idfk'),
            'rider_idfk' 			=> $this->input->post('rider_idfk'),
            'from_location_idfk' 	=> $this->input->post('from_location_idfk'),
            'to_location_idfk' 		=> $this->input->post('to_location_idfk'),
            'trip_type' 			=> $this->input->post('trip_type'),
            'vehicle_type_fk' 		=> $this->input->post('vehicle_type_fk'),
            'passenger_limit' 		=> $this->input->post('passenger_limit'),
            'available_limit' 		=> $this->input->post('available_limit'),
            'filled_seates' 		=> $this->input->post('filled_seates'),
            'start_date' 			=> $this->input->post('start_date'),
            'end_date' 				=> $this->input->post('end_date'),
            'time' 					=> $this->input->post('time'),
            'drop_time' 			=> $this->input->post('drop_time'),
            'time_relaxation' 		=> $this->input->post('time_relaxation'),
            'smoking' 				=> $this->input->post('smoking'),
            'same_gander' 			=> $this->input->post('same_gander'),
            'gender' 				=> $this->input->post('gender'),
            'addition_info' 		=> $this->input->post('addition_info'),
            'status' 				=> $this->input->post('status'),
            'is_available' 			=> $this->input->post('is_available'),
        ];

        // Insert data into the database
        if ($this->RideDetailModel->insert_ride_detail($data)) 
        {
            echo json_encode(['status' => 'success', 'message' => 'Ride detail added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add ride detail.']);
        }
    }
}
