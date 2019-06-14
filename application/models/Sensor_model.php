<?php
class Sensor_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	
	//get the temperature data
	public function get_temp(){
		$this->db->from('temp_readings');
		$this->db->order_by("time","asc");
		$query = $this->db->get();
		$from = $this->input->post('ftime');
		
		$to = $this->input->post('ttime');
		$this->db->where('time >=',$from);
		$this->db->where('time <=',$to);
		$temp_values = $query->result_array();
		#print_r($temp_values);

		//create an array with the y as the temp values and label as the date
		$result = array();
		foreach($temp_values as $row){
			array_push($result,array("y" => $row['temp'],"label" => $row['time']));
		}

	#	print_r($result);

		return $result;
	}
}
 
?>
