<?php

class Main extends CI_Controller {

	
    
    function __construct() {
    	// Call the Controller constructor
    	parent::__construct();
    	session_start();
    }
        
    function index() {
    	$data['main']='main/index';
    	$data['title'] = 'U of T Theater - Home Page';
    	$this->load->view('template', $data);
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
		$data['title'] = 'U of T Theater - Showtimes';
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
    	$this->load->view('template', $data);
    	
    	$data['main']='main/selectTicket';
    	$data['title'] = 'U of T Theater - Select a Ticket';
    	
    	$this->load->view('template', $data);
    	
    }

    public function movie_and_theater_both_not_empty($str)  {
    	
    	if (empty($str) and empty($_POST["Theaters"]))  
    	{
    		$this->form_validation->set_message("movie_and_theater_both_not_empty", "%s You must provide a venue AND/OR a movie!");
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }
    
    function strbool($s)
    {
    	if ($s == true) {
    		return "true";
    	} else {
    		return "false";
    	}
    }
    
    function validate() {
    	
    	$this->load->model('theater_model');
    	$this->load->model('movie_model');
    	$this->load->model('showtime_model');
    	$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');

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
    	
    	$this->form_validation->set_rules('Movies', 'Movies', 'callback_movie_and_theater_both_not_empty');
    	
    	if (($this->form_validation->run() == TRUE)) {
    		
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
    		redirect('main/selectMovieVenueView');
    	}
    	
    }

	
	function selectSeat() {
		$this->load->model('theater_model');
		$this->load->model('movie_model');
		$this->load->model('showtime_model');
		
		echo $_POST['checkMe'] . "<br/>";
		echo $_SESSION['Days'] . "<br/>";
		echo $_SESSION['Movies'] . "<br/>";
		echo $_SESSION['Theaters'] . "<br/>";
		
		$viewings = $this->showtime_model->get_specific_showtimes($_SESSION["Movies"], $_SESSION["Theaters"], $_SESSION["Days"]);
		$x = $viewings->row($_POST['checkMe']);
		echo $x->title . "<br/>";
		echo $x->name . "<br/>";
		echo $x->address . "<br/>";
		echo $x->date . "<br/>";
		echo $x->time . "<br/>";
		echo $x->available . "<br/>";
		
		$data['main']='main/selectSeat';
		$this->load->view('template', $data);
	}
	

}

