<?php

class SQLcontroller extends CI_Controller {

	
    
    function __construct() {
    	
    	// Call the Controller constructor.
    	parent::__construct();
    	
    	// Allow session information to be stored.
    	session_start();
    	
    }
    
    function populateMainTables()
    {
    	#input everything to tables
    	$this->load->model('movie_model');
    	$this->load->model('theater_model');
    	$this->load->model('showtime_model');
    
    	$this->movie_model->populate();
    	$this->theater_model->populate();
    	$this->showtime_model->populate();
    
    	redirect('main/admin', 'refresh');
    
    }
    
    function deleteMainTables()
    {
    	#Delete the tables
    	$this->load->model('movie_model');
    	$this->load->model('theater_model');
    	$this->load->model('showtime_model');
    	 
    	$this->movie_model->delete();
    	$this->theater_model->delete();
    	$this->showtime_model->delete();
    
    	redirect('main/admin', 'refresh');
    
    }
    
    function populateTicketTables() {
    	$this->load->model('ticket_model');
    	$this->ticket_model->populate(10);
//     	redirect('main/admin', 'refresh');
    	$data['main'] = 'main/admin';
    	$data['title'] = "U of T Theater - Admin";
    	$this->load->view('template', $data);
		
    }
    
    function deleteTicketTables() {
    	$this->load->model('ticket_model');
    	$this->ticket_model->delete();
    	redirect('main/admin', 'refresh');
    }
    
}
?>