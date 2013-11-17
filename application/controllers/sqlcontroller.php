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
    	$this->load->model('movie_model');
    	$this->load->model('theater_model');
    	$this->load->model('showtime_model');
    
    	$this->movie_model->populate();
    	$this->theater_model->populate();
    	$this->showtime_model->populate();
    
    	//Then we redirect to the index page again
//     	redirect('/main/admin.php', 'refresh');
    	header('Location: /A2/index.php/main/admin');
    
    }
    
    function deleteMainTables()
    {
    	$this->load->model('movie_model');
    	$this->load->model('theater_model');
    	$this->load->model('showtime_model');
    	 
    	$this->movie_model->delete();
    	$this->theater_model->delete();
    	$this->showtime_model->delete();
    
    	//Then we redirect to the index page again
    	header('Location: /A2/index.php/main/admin');
    
    }
    
    function populateTicketTables() {
    	$this->load->model('ticket_model');
    	$this->ticket_model->populate(10);
//     	$data['main']='main/admin.php';
//     	$data['title'] = "U of T Theater - Admin - List of Tickets Sold";
//     	$this->load->view('template', $data);
//     	redirect('/main/admin.php', 'refresh');
    	header('Location: /A2/index.php/main/admin');
    }
    
    function deleteTicketTables() {
    	$this->load->model('ticket_model');
    	$this->ticket_model->delete();
//     	redirect('/main/admin.php', 'refresh');
    	header('Location: /A2/index.php/main/admin');
    }
    
}
?>