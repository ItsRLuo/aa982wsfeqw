<?php

class Main extends CI_Controller {

	
    
    function __construct() {
    	
    	// Call the Controller constructor.
    	parent::__construct();
    	
    	// Allow session information to be stored.
    	session_start();
    	
    }
    
    // Open the main page view.
    function index() {
    	$data['main']='main/index';
    	$data['title'] = "U of T Theater - Pay for User Information";
    	$this->load->view('template', $data);
    }
    
    // Opens the admin view.
    function admin() {
    	$data['main'] = 'main/admin';
    	$data['title'] = "U of T Theater - Admin";
    	$this->load->view('template', $data);

    }
    
    // Load the view that stores user information.
    function userInformation() {
    	$this->load->model('theater_model');
    	$this->load->model('movie_model');
    	$data['main']='main/userInformation';
    	$data['title'] = 'U of T: Enter User Information';
    	$this->load->view('template', $data);
    	 
    }
 

 
 function overview(){
 	$this->load->library('form_validation');
 		
 	$this->form_validation->set_rules('firstname', 'firstname', 'required');
 	$this->form_validation->set_rules('lastname', 'lastname', 'required');
 	$this->form_validation->set_rules('credit', 'credit', 'required|exact_length[16]|numeric');
 	$this->form_validation->set_rules('date', 'date', 'required|exact_length[5]|callback_checkExpireDate');

 	if ($this->form_validation->run() == FALSE)
 	{
 		$data['main']='main/userInformation';
 		$this->load->view('template', $data);
 	}
	else{
		$this->load->model('theater_model');
		$this->load->model('movie_model');
		$this->load->model('showtime_model');
		
		$viewings = $this->showtime_model->get_specific_showtimes($_SESSION["Movies"], $_SESSION["Theaters"], $_SESSION["Days"]);
		$x = $viewings->row();
		
		$data['x'] = $x;
		 
		$data['main']='main/overview';
		$this->load->view('template', $data);
		
	}
    	 }
 
 public function checkExpireDate($str)
 {
 	$year = "20";
 	$year = ($year.substr($str,0,2));
 	$month = substr($str,3,5);

 	if (is_numeric(substr($str,2,3)) == True){
 		$this->form_validation->set_message('checkExpireDate', 'Input not in correct format');
 		return False;
 	}
 	$checkYear = 0;
 	$this->form_validation->set_message('checkExpireDate', 'Input must be integers');
 	$check = is_numeric($year);
 	if ($check == False){
 		return $check;
 	}
 	$check = is_numeric($month);
 	if ($check == False){
 		return $check;
 	}
 	if ($month > 12){
 		$this->form_validation->set_message('checkExpireDate', 'The month given is not correct');
 		return FALSE;
 	}
 	if ($year < (int)date("Y"))
 	{
 		$this->form_validation->set_message('checkExpireDate', 'The credit card already expired');
 		return FALSE;
 	}
 	if ($year == (int)date("Y")){
 		$checkYear = 1;
 	}
 	if ($checkYear == 1){
 		if($month < (int)date("m"))
 		{
 			$this->form_validation->set_message('checkExpireDate', 'The credit card already expired');
 			return FALSE;
 		}	
 	}
 	
 		return TRUE;
 }
    
    function selectMovieVenueView() {
    	
    	$this->load->model('theater_model');
    	$this->load->model('movie_model');

    	// Get all the available DATES.
    	$curr_timestamp = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    	$dateArray = array();
    	for ($i = 0; $i < 13; $i++) {
    	
    		$curr_timestamp = mktime(0, 0, 0, date("m", $curr_timestamp),
    				date("d", $curr_timestamp) + 1, date("Y", $curr_timestamp));
    	
    		$curr_date = date("D, M d, Y", mktime(0,0,0,date("m", $curr_timestamp),
    				date("d", $curr_timestamp),date("Y", $curr_timestamp)));
    	
    		$dateArray[$curr_date] = $curr_date;
    	}
    	$data["dateArray"] = $dateArray;
    	
    	// Get all the theater names.
    	$theater_names = array("" => "All venues");
    	$query_theater_names = $this->theater_model->get_theater_names();
    	foreach ($query_theater_names->result() as $theater_name) {
    		$theater_names[$theater_name->name] = $theater_name->name;
    	}
    	$data["theater_names"] = $theater_names;
    	
    	// Get all movie names.
    	$movie_names = array("" => "All films");
    	$query_movie_names = $this->movie_model->get_movie_names();
    	foreach ($query_movie_names->result() as $movie_name) {
    		$movie_names[$movie_name->title] = $movie_name->title;
    	}
    	$data["movie_names"] = $movie_names;
    	
    	$data['title'] = 'U of T Theater - Select a Venue';
    	$data['main']='main/selectMovieVenue';
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

		$data['title'] = "U of T Theater - List of Showtimes</title>";
		
		$this->load->view('template', $data);
    }
    
    function selectTicket() {
    	
    	$this->load->model('movie_model');
    	$this->load->model('theater_model');
    	$this->load->model('showtime_model');
    	
    	// Return the movie info string.
    	$movie_info_str = "Movie viewings" ;
    	if ($_POST["Movies"] != "") {
    		$movie_info_str = $movie_info_str . " for " . $_POST["Movies"];
    	}
    	 
    	if ($_POST["Theaters"] != "") {
    		$movie_info_str = $movie_info_str . " at " . $_POST["Theaters"];
    	}
    	$movie_info_str = $movie_info_str . " on " . $_POST["Days"] . ":<br/><br/>";
    	$data['movieInfoStr'] = $movie_info_str;

    	
    	$data['main']='main/selectTicket';
    	$data['title'] = 'U of T Theater - Select a Ticket';
    	$this->load->view('template', $data);
    	
    }
    
    function validate() {
    	
    	$this->load->model('theater_model');
    	$this->load->model('movie_model');
    	$this->load->model('showtime_model');
    	$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');


    	$data["title"] = "U of T Theater - Criteria Filtering";
    	
    	$_SESSION["Days"] = $_POST["Days"];
    	$_SESSION["Theaters"] = $_POST["Theaters"];
    	$_SESSION["Movies"] = $_POST["Movies"];
    	
    	$date = $_POST["Days"];
    	 
    	if (isset($_POST["Movies"])) {
    		$movie = $_POST["Movies"];
    	}
    	 
    	if (isset($_POST["Theaters"])) {
    		$theater = $_POST["Theaters"];
    	}
    	
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules("Movies", "Movies", "callback_checkUnfilledFields");

    	if (($this->form_validation->run("Movies") == TRUE)) {
    		
    		// Return the movie info string.
    		$movie_info_str = "Movie viewings" ;
    		if ($_POST["Movies"] != "") {
    			$movie_info_str = $movie_info_str . " for " . $_POST["Movies"];
    		}
    		 
    		if ($_POST["Theaters"] != "") {
    			$movie_info_str = $movie_info_str . " at " . $_POST["Theaters"];
    		}
    		$movie_info_str = $movie_info_str . " on " . $_POST["Days"] . ":<br/><br/>";
    		$data['movieInfoStr'] = $movie_info_str;
    		
    		$viewings_array = array("None selected");
    		$viewings = $this->showtime_model->get_specific_showtimes($_POST["Movies"], $_POST["Theaters"], $_POST["Days"]);
    		$data['viewings'] = $viewings;
    		
    		$_SESSION['viewings'] = $viewings;
    		$data['main']='main/selectTicket';
    		
    		
    		$this->load->view('template', $data);
    		$x = $_SESSION['viewings'];
    		
    	} 
    	else {
	
	    	// Get all the available DATES.
	    	$curr_timestamp = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	    	$dateArray = array();
	    	for ($i = 0; $i < 13; $i++) {
	    	
	    		$curr_timestamp = mktime(0, 0, 0, date("m", $curr_timestamp),
	    				date("d", $curr_timestamp) + 1, date("Y", $curr_timestamp));
	    	
	    		$curr_date = date("D, M d, Y", mktime(0,0,0,date("m", $curr_timestamp),
	    				date("d", $curr_timestamp),date("Y", $curr_timestamp)));
	    	
	    		$dateArray[$curr_date] = $curr_date;
	    	}
	    	$data["dateArray"] = $dateArray;
	    	
	    	// Get all the theater names.
	    	$theater_names = array("" => "All venues");
	    	$query_theater_names = $this->theater_model->get_theater_names();
	    	foreach ($query_theater_names->result() as $theater_name) {
	    		$theater_names[$theater_name->name] = $theater_name->name;
	    	}
	    	$data["theater_names"] = $theater_names;
	    	
	    	// Get all movie names.
	    	$movie_names = array("" => "All films");
	    	$query_movie_names = $this->movie_model->get_movie_names();
	    	foreach ($query_movie_names->result() as $movie_name) {
	    		$movie_names[$movie_name->title] = $movie_name->title;
	    	}
	    	$data["movie_names"] = $movie_names;
	    	
	    	$data['title'] = 'U of T Theater - Select a Venue';
	    	$data['main']='main/selectMovieVenue';
	    	$this->load->view('template', $data);
    	}
    	
    	
    }
    
	function checkUnfilledFields($str) {
		
		if (empty($str) and empty($_POST["Theaters"])) {
			$this->form_validation->set_message("checkUnfilledFields", "Please select either a movie AND/OR a theater.");
			return false;
		} else {
			return true;
		}
		
		
	}
	
	function selectSeat() {
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules("checkMe", "checkMe", "required");
		$this->load->model('theater_model');
		$this->load->model('movie_model');
		$this->load->model('showtime_model');
		$this->load->model('ticket_model');
		 
		 
		
		
		echo $_SESSION['Days'] . "<br/>";
		echo $_SESSION['Movies'] . "<br/>";
		echo $_SESSION['Theaters'] . "<br/>";
		
		$viewings = $this->showtime_model->get_specific_showtimes($_SESSION["Movies"], $_SESSION["Theaters"], $_SESSION["Days"]);
		$x = $viewings->row($_POST['checkMe']);
		
		$tickets_remaining = $this->ticket_model->get_tickets_by_id($x->tid);
		
		$data['tickets_remaining'] = $tickets_remaining;
		$data['title'] = "U of T Theater - Select a Seat</title>";
		$data['x'] = $x;
		$data['main']='main/selectSeat';
		$this->load->view('template', $data);

	}
	
	function processUserInfo() {
		
		
	}
	
	function ticketInfo() {
		
		// First we load the library and the model
		$this->load->library('table');
		$this->load->model('ticket_model');
		
// 		//Then we call our model's get_tickets function
		$ticketList = $this->ticket_model->get_tickets();
		
// 		//If it returns some results we continue
		if ($ticketList->num_rows() > 0){
		
			//Prepare the array that will contain the data
			$table = array();
		
			$table[] = array('Ticket No.','First Name','Last Name','Credit Card Number',
							'Credit Card Expiry Date', 'Showtime ID', 'Seat No.');
		
			foreach ($ticketList->result() as $row){
				$table[] = array($row->ticket,$row->first,$row->last,$row->creditcardnumber,$row->creditcardexpiration,$row->showtime_id, $row->seat);
			}

// 			//Next step is to place our created array into a new array variable, one that we are sending to the view.
			$data['ticketList'] = $table;
		}
		
// 		//Now we are prepared to call the view, passing all the necessary variables inside the $data array
		$data['main'] = 'admin/ticketInfo';
		$data['title'] = 'U of T Theater - Viewing Selection';
		$this->load->view('template', $data);
	}
	

    
}

