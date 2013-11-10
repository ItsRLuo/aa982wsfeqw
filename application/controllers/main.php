<?php



class Main extends CI_Controller {

    
    function __construct() {
    	// Call the Controller constructor
    	parent::__construct();
    	
    	$this->currYear = intval(date("Y"));
    	$this->months = array("Select a month", "January", "February", "March", "April", "May", "June",
    			"July", "August", "September", "October", "November", "December");
    	$this->day = array_merge(array("Select a day"), range(1, 31));
    	$this->year = array_merge(array("Select a year"), range($this->currYear, $this->currYear + 50));
    }
        
    function index() {
    	$data['main']='main/index';
    	$this->load->view('template', $data);
    }
    
    function buyTicketView() {
    	

    	$this->load->model('theater_model');
    	$this->load->model('movie_model');
    	$data['main']='main/buyTicket';
    	$this->load->view('template', $data);
    	
    }
    
	function showShowtimes()
    {

		//First we load the library and the model
		$this->load->library('table');
		$this->load->model('showtime_model');
		
		//Then we call our model's get_showtimes function
		$showtimes = $this->showtime_model->get_showtimes();

		//If it returns some results we continue
		if ($showtimes->num_rows() > 0){
		
			//Prepare the array that will contain the data
			$table = array();	
	
			$table[] = array('Movie','Theater','Address','Date','Time','Available');
		
		   foreach ($showtimes->result() as $row){
				$table[] = array($row->title,$row->name,$row->address,$row->date,$row->time,$row->available);
		   }
			//Next step is to place our created array into a new array variable, one that we are sending to the view.
			$data['showtimes'] = $table; 		   
		}
		
		//Now we are prepared to call the view, passing all the necessary variables inside the $data array
		$data['main']='main/showtimes';
		$this->load->view('template', $data);
    }
    
    function populate()
    {
	    $this->load->model('movie_model');
	    $this->load->model('theater_model');
	    $this->load->model('showtime_model');
	     
	    $this->movie_model->populate();
	    $this->theater_model->populate();
	    $this->showtime_model->populate();
	     
	    //Then we redirect to the index page again
	    redirect('', 'refresh');
	     
    }
    
    function delete()
    {
	    $this->load->model('movie_model');
	    $this->load->model('theater_model');
	    $this->load->model('showtime_model');
    	
	    $this->movie_model->delete();
	    $this->theater_model->delete();
	    $this->showtime_model->delete();
	     
    	//Then we redirect to the index page again
    	redirect('', 'refresh');
    
    }
    
    function selectTicket() {
    	
    	$this->load->model('movie_model');
    	$this->load->model('theater_model');
    	$this->load->model('showtime_model');
    	
    	$data['main']='main/selectTicket';
    	$this->load->view('template', $data);
    	
    }
    
    function validate() {
    	$this->load->model('movie_model');
    	$this->load->model('theater_model');
    	$this->load->model('showtime_model');
    	$this->load->library("form_validation");
    	
    	$this->form_validation->set_rules('Year', 'Year', 'greater_than[2020]');
    	
		if ($this->form_validation->run() == TRUE) {	
			redirect('main/selectTicket');
		} else {
			
		}
    }
    
//     function checkMonth($month) {
//     	return $month == "2013";
//     }
    
}

