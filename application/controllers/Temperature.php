<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temperature extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('sensor_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
	}

	public function index(){
		$data['temp'] = $this->sensor_model->get_temp();
		$data['title'] = "This is just a test.....More coding is needed for the index";

		$this->load->view('reading_temp',$data);
	}

	public function get_temp(){
		$data['temp'] = $this->sensor_model->get_temp();
		#print_r($data['temp']);
		$data['json_temp'] = json_encode(array_column($data['temp'],'temp'));
		$data['json_time'] = json_encode(array_column($data['temp'],'time'));
		$data['title'] = "Below is a plot of the temperature reading based on the input above";

		if($this->input->post("submit_temp_range")){
			$data['temp'] = $this->sensor_model->get_temp();
		}

		$this->load->view('reading_temp',$data);
	}
	
	public function view()
	{

		$data['temp'] = $this->sensor_model->get_temp();
		$data['title'] = "Below is a plot of all the temperature reading from the temperature sensor";
		$this->load->view('reading_temp',$data);
	}
}
