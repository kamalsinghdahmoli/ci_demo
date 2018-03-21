<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller{
	public $data;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language','directory','file'));

	
		$this->load->model('rooms_model');

	  if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
	}

	public function index() {
		// set the flash data error message if there is one
	$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
    $config = array();
    $config["base_url"] = base_url()."rooms";
    $total_row = $this->db->select('room_id')->from('rooms')->where('room_status','a')->count_all_results();
    $config["total_rows"] = $total_row;
    $config["per_page"] = 30;
    $config['num_links'] = 8;
    $config['page_query_string'] = TRUE;
    $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
    $config['full_tag_close'] ="</ul>";
    $config['num_tag_open'] = "<li>";
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="javascript:void();">';
    $config['cur_tag_close'] = "</a></li>";
    $config['next_tag_open'] = "<li>";
    $config['next_tagl_close'] = "</li>";
    $config['prev_tag_open'] = "<li>";
    $config['prev_tagl_close'] = "</li>";
    $config['first_tag_open'] = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_tag_open'] = "<li>";
    $config['last_tagl_close'] = "</li>";
    $this->pagination->initialize($config);
    $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    $inputs['page'] = $page;
    $inputs['per_page'] = $config['per_page'];
    $rooms =  $this->rooms_model->get_rooms($inputs);

	
	$this->data['rooms'] = $rooms;
	
      $this->data['page_name']  = 'rooms';
        $this->data['page_title'] = get_phrase('rooms');
        $this->load->view('backend/index.php', $this->data);
 }

	public function create_room(){
		// set the flash data error message if there is one
	$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	$config = array(
             array(
                    'field' => 'room_name', 
                    'label' => 'Room Name',
                    'rules' => 'trim|required',
                ),
             array(
                    'field' => 'room_number',
                    'label' => 'Room number',
                    'rules' => 'trim|required',
                ), 
        );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() === TRUE)
    {		
     
			$cdata = array(
				   
			       'room_name' => $this->input->post('room_name'),
			       'room_number' => $this->input->post('room_number'),
			       'room_status' => 'a',
			       'room_created' => date('Y-m-d H:i:s'),
			       'room_updated' => date('Y-m-d H:i:s'),
			);
			
			$this->db->insert('rooms', $cdata);
			$this->data['message'] = "room added successfully";
    }

        $this->data['page_name']  = 'create_room';
        $this->data['page_title'] = get_phrase('create_room');
        $this->load->view('backend/index.php', $this->data);
		//$this->template->adminTemplate($this->data);
	}


	public function update_room($pid=null){

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$config = array(
            array(
                    'field' => 'roomname', 
                    'label' => 'Room Name',
                    'rules' => 'trim',
                ),
            array(
                    'field' => 'roomslug',
                    'label' => 'Room slug',
                    'rules' => 'trim',
                ), 
        );

        $this->form_validation->set_rules($config);
 		if ($this->form_validation->run() === TRUE){

            $cdata = array(
                   
                   'room_name' => $this->input->post('roomname'),
                   'room_number' => $this->input->post('roomnumber'),
                   'room_status' => 'a',
                   'room_created' => date('Y-m-d H:i:s'),
                   'room_updated' => date('Y-m-d H:i:s'),
            );

			$this->db->where('room_id', $pid);
			$this->db->update('rooms', $cdata);
			$this->data['message'] = "Room Updated Successfully";
		}

		$room = $this->rooms_model->getRoom($pid);
		
		$this->data['room'] = $room;
        $this->data['page_name']  = 'update_room';

         $this->data['page_title'] = get_phrase('update_room');
        $this->load->view('backend/index.php', $this->data);
	}
	 
	
	public function search(){

    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
    $rname = $this->input->get('rname');
    $config = array();
    $config["base_url"] = base_url()."admin/rooms/search?rname=".$rname;
    $total_row = $this->db->select('post_id')->from('rooms')->where('room_status', 'a')->like('room_name' , $rname)->count_all_results();

    $config["total_rows"] = $total_row;
    $config["per_page"] = 30;
    $config['num_links'] = 4;
    $config['page_query_string'] = TRUE;
    $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
    $config['full_tag_close'] ="</ul>";
    $config['num_tag_open'] = "<li>";
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="javascript:void();">';
    $config['cur_tag_close'] = "</a></li>";
    $config['next_tag_open'] = "<li>";
    $config['next_tagl_close'] = "</li>";
    $config['prev_tag_open'] = "<li>";
    $config['prev_tagl_close'] = "</li>";
    $config['first_tag_open'] = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_tag_open'] = "<li>";
    $config['last_tagl_close'] = "</li>";
    $this->pagination->initialize($config);           
    $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    $inputs['page'] = $page;
    $inputs['per_page'] = $config['per_page'];
    $inputs['rname'] = $rname;

    $this->data['rname'] = $rname;
    $this->db->select('*');
    $this->db->like('post_title' , $rname);
    $this->db->where('rooms.room_status', 'a');

    $rooms = $this->db->get('rooms',$config['per_page'], $page)->result_array();

    if (count($rooms) > 0) {
      $this->data['message'] = "Search results for ".'"'.$rname.'"';
    }else{
       $this->data['message'] = " OMG! Results Not Found";
    }

    $this->data['rooms'] = $rooms;
    $this->data['title'] = "";
    $this->data['view'] = 'admin/rooms/home_view';
    $this->template->adminTemplate($this->data);
  }
   



}