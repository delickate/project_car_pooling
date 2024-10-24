<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RideDetailController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('RideDetailModel');
        $this->load->library('pagination');
        $this->load->database(); // Load database library
    }

    public function index() {
        // Pagination configuration
        $config['base_url'] = site_url('ridedetailcontroller/index');
        $config['total_rows'] = $this->RideDetailModel->count_ride_details();
        $config['per_page'] = 5; // Number of records per page
        $config['uri_segment'] = 3; // URI segment for pagination
        $this->pagination->initialize($config);

        $data['ride_details'] = $this->RideDetailModel->get_all_ride_details($config['per_page'], $this->uri->segment(3));
        $data['pagination'] = $this->pagination->create_links();

        

        $this->load->view('template/header');
        $this->load->view('ride_detail/index', $data);
        $this->load->view('template/footer');
    }

    public function create() {
        if ($this->input->post()) {
            $data = [
                'driver_idfk' => $this->input->post('driver_idfk'),
                'rider_idfk' => $this->input->post('rider_idfk'),
                'from_location_idfk' => $this->input->post('from_location_idfk'),
                'to_location_idfk' => $this->input->post('to_location_idfk'),
                'trip_type' => $this->input->post('trip_type'),
                'vehicle_type_fk' => $this->input->post('vehicle_type_fk'),
                'passenger_limit' => $this->input->post('passenger_limit'),
                'available_limit' => $this->input->post('available_limit'),
                'filled_seates' => $this->input->post('filled_seates'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'time' => $this->input->post('time'),
                'drop_time' => $this->input->post('drop_time'),
                'time_relaxation' => $this->input->post('time_relaxation'),
                'smoking' => $this->input->post('smoking'),
                'same_gander' => $this->input->post('same_gander'),
                'gender' => $this->input->post('gender'),
                'addition_info' => $this->input->post('addition_info'),
                'status' => $this->input->post('status'),
                'is_available' => $this->input->post('is_available'),
            ];
            $this->RideDetailModel->insert_ride_detail($data);
            redirect('ridedetailcontroller/index');
        }

        $data['drivers'] = $this->RideDetailModel->get_users_by_type('driver');
        $data['riders'] = $this->RideDetailModel->get_users_by_type('rider');
        $data['locations'] = $this->RideDetailModel->get_locations();
        $data['vehicle_types'] = $this->RideDetailModel->get_vehicle_types();

        $this->load->view('ride_detail/create', $data);
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = [
                'driver_idfk' => $this->input->post('driver_idfk'),
                'rider_idfk' => $this->input->post('rider_idfk'),
                'from_location_idfk' => $this->input->post('from_location_idfk'),
                'to_location_idfk' => $this->input->post('to_location_idfk'),
                'trip_type' => $this->input->post('trip_type'),
                'vehicle_type_fk' => $this->input->post('vehicle_type_fk'),
                'passenger_limit' => $this->input->post('passenger_limit'),
                'available_limit' => $this->input->post('available_limit'),
                'filled_seates' => $this->input->post('filled_seates'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'time' => $this->input->post('time'),
                'drop_time' => $this->input->post('drop_time'),
                'time_relaxation' => $this->input->post('time_relaxation'),
                'smoking' => $this->input->post('smoking'),
                'same_gander' => $this->input->post('same_gander'),
                'gender' => $this->input->post('gender'),
                'addition_info' => $this->input->post('addition_info'),
                'status' => $this->input->post('status'),
                'is_available' => $this->input->post('is_available'),
            ];
            $this->RideDetailModel->update_ride_detail($id, $data);
            redirect('ridedetailcontroller/index');
        }

        $data['ride_detail'] = $this->RideDetailModel->get_ride_detail($id);
        $data['drivers'] = $this->RideDetailModel->get_users_by_type('driver');
        $data['riders'] = $this->RideDetailModel->get_users_by_type('rider');
        $data['locations'] = $this->RideDetailModel->get_locations();
        $data['vehicle_types'] = $this->RideDetailModel->get_vehicle_types();

        $this->load->view('ride_detail/edit', $data);
    }

    public function delete($id) {
        $this->RideDetailModel->delete_ride_detail($id);
        redirect('ridedetailcontroller/index');
    }
}
