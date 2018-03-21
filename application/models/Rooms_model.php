<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Version: 2.5.2
*
* Author:  Ben Edmunds
* 		   ben.edmunds@gmail.com
*	  	   @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Last Change: 3.22.13
*
* Changelog:
* * 3-22-13 - Additional entropy added - 52aa456eef8b60ad6754b31fbdcc77bb
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class rooms_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_rooms($inputs =null ){
		
		$rooms = null;
		$page = isset($inputs['page']) ? $inputs['page'] : 0;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 10;
		$query = " SELECT * FROM rooms ".
				 " WHERE room_status = 'a' ".
				 " ORDER BY room_created DESC ".
				 " LIMIT $page, $per_page "; 

		$rooms = $this->db->query($query)->result_array();
		return $rooms;

	}

	public function getRoom($pid=null){

		if($pid != null) {

			$room = null;
			$query = null;

			$query = " SELECT * FROM rooms ".
				     " WHERE room_id = '$pid' ";
			return $this->db->query($query)->row_array();
		}else{
			return false;
		}

	}


}
