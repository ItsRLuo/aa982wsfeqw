<?php
class Ticket_model extends CI_Model {

	function get_tickets()
	{
		$query = $this->db->query("select * from ticket");
		return $query;
	}

	function sqlColumnToArray($col) {

		$result = array();
		while ($row = mysql_fetch_array($col)) {
			$result[] = $row[$key];
		}
		return $result;
	
	}
	
	function get_tickets_by_id($id) {

		$query = $this->db->query("select t.seat from ticket t where t.showtime_id = " . $id);
		echo "<br/><br/>";
		//echo "foo";
		$ticketsRemaining = array(1, 2, 3);
		foreach ($query->result() as $ticket) {
			array_diff($ticketsRemaining, array($ticket->seat));
		}

		return $ticketsRemaining;
	}

	function populate() {
		
		$months = range(1, 12);
		foreach ($months as $month) {
			$month = sprintf("%02d", $month);
		}
		$currYear = intval(idate("y"));
		$years = array();
		for ($i = 0; $i < 50; $i++) {
			$years[$i] = $currYear + $i;
		}

		$this->load->model('showtime_model');
		

		$lastNames = array('Abraham', 'Allan', 'Alsop', 'Anderson', 'Arnold', 'Avery', 'Bailey', 'Baker', 'Ball', 'Bell', 'Berry', 'Black', 'Blake', 'Bond', 'Bower', 'Brown', 'Buckland', 'Burgess', 'Butler', 'Cameron', 'Campbell', 'Carr', 'Chapman', 'Churchill', 'Clark', 'Clarkson', 'Coleman', 'Cornish', 'Davidson', 'Davies', 'Dickens', 'Dowd', 'Duncan', 'Dyer', 'Edmunds', 'Ellison', 'Ferguson', 'Fisher', 'Forsyth', 'Fraser', 'Gibson', 'Gill', 'Glover', 'Graham', 'Grant', 'Gray', 'Greene', 'Hamilton', 'Hardacre', 'Harris', 'Hart', 'Hemmings', 'Henderson', 'Hill', 'Hodges', 'Howard', 'Hudson', 'Hughes', 'Hunter', 'Ince', 'Jackson', 'James', 'Johnston', 'Jones', 'Kelly', 'Kerr', 'King', 'Knox', 'Lambert', 'Langdon', 'Lawrence', 'Lee', 'Lewis', 'Lyman', 'MacDonald', 'Mackay', 'Mackenzie', 'MacLeod', 'Manning', 'Marshall', 'Martin', 'Mathis', 'May', 'McDonald', 'McLean', 'McGrath', 'Metcalfe', 'Miller', 'Mills', 'Mitchell', 'Morgan', 'Morrison', 'Murray', 'Nash', 'Newman', 'Nolan', 'North', 'Ogden', 'Oliver', 'Paige', 'Parr', 'Parsons', 'Paterson', 'Payne', 'Peake', 'Peters', 'Piper', 'Poole', 'Powell', 'Pullman', 'Quinn', 'Rampling', 'Randall', 'Rees', 'Reid', 'Roberts', 'Robertson', 'Ross', 'Russell', 'Rutherford', 'Sanderson', 'Scott', 'Sharp', 'Short', 'Simpson', 'Skinner', 'Slater', 'Smith', 'Springer', 'Stewart', 'Sutherland', 'Taylor', 'Terry', 'Thomson', 'Tucker', 'Turner', 'Underwood', 'Vance', 'Vaughan', 'Walker', 'Wallace', 'Walsh', 'Watson', 'Welch', 'Whited', 'Wilkins', 'Wilson', 'Wright', 'Young');
		$firstNames = array('Emerita', 'Marci', 'Shay', 'Holly', 'Letty', 'Alia', 'Raisa', 'Harriet', 'Roy', 'Jeneva', 'Krissy', 'Steffanie', 'Yolande', 'German', 'Candi', 'Juana', 'Arnetta', 'Tricia', 'Galina', 'Kylie', 'Linwood', 'Rosetta', 'Raven', 'Valery', 'Ai', 'Shantelle', 'See', 'Cristina', 'Booker', 'Kortney', 'Orlando', 'Lavera', 'Jolynn', 'Mervin', 'Mayra', 'Ariane', 'Sherryl', 'Gertrude', 'Tyron', 'Dante', 'Emmie', 'Rea', 'Germaine', 'Seth', 'Sona', 'Lindsy', 'Chelsie', 'Galen', 'Shila', 'Coletta', 'Venetta', 'Moira', 'Chad', 'Dione', 'Thaddeus', 'Maria', 'Lilia', 'Laurie', 'Duncan', 'Herta', 'Lekisha', 'Hassie', 'Maragret', 'Shawnna', 'Delmy', 'Rochel', 'Hayley', 'Jasper', 'Mariano', 'Gilberto', 'Daysi', 'Serina', 'Marilou', 'Sirena', 'Eugenie', 'Eve', 'Markus', 'Virgina', 'Kasey', 'Gilda', 'Jaqueline', 'Treena', 'Edison', 'Cherie', 'Donette', 'Jefferey', 'Jeffie', 'Charlette', 'Scarlett', 'Stacia', 'Catarina', 'Catheryn', 'Jeannine', 'Laverna', 'Shiloh', 'Carisa', 'Bunny', 'Dannielle', 'Edelmira', 'Marylynn');
		
		for ($i = 0; $i < 1000; $i++) {
			$sids = $this->showtime_model->get_showtime_ids();
			if (!$sids) {
				return;
			}
			
			$randFN = $firstNames[array_rand($firstNames)];
			$randLN = $lastNames[array_rand($lastNames)];
			$seat = rand(1, 3);
			$credNum = rand(1000000000000000, 9999999999999999);
				
			$creditCardexp = sprintf("%04d", $months[array_rand($months)] . $years[array_rand($years)]);
			$showID = $sids[array_rand($sids)];

			$this->insertTicket($randFN, $randLN, $credNum, $creditCardexp, $showID, rand(1, 3));

		}

	}
	
	function delete() {
		
		$str = "select ticket from ticket";
		$q = $this->db->query($str);
		
		while ($q) {
			$this->db->query('DELETE FROM ticket LIMIT 1');
			$str = "select ticket from ticket";
			$q = $this->db->query($str);
		}
		
		
	}

	
	function deleteTicket($ticketID) {
		
		$str = "delete from ticket where ticket = $ticketID";
		$this->db->query($str);
		$this->showtime_model->increment_availability($ticketID);
		
	}
	
	function insertTicket($randFN, $randLN, $credNum, $creditCardExp, $showID, $seatNo) {
		
		// Prepare the insertion query string. 
		if (!isset($_SESSION["ticket_id"])) {
			$_SESSION["ticket_id"] = 1;
		}
		
		
		
		$this->set_next_lowest_ticket_num();
		
		$str = "insert into ticket (ticket, first, last, creditcardnumber, 
				creditcardexpiration, showtime_id, seat) values (" . $_SESSION["ticket_id"] . ", '$randFN', 
				'$randLN', '$credNum', '$creditCardExp', $showID, $seatNo)";
		
		// Insert the ticket into the table.
		$this->db->query($str);
		echo "Echo: " . $_SESSION["ticket_id"];
		$this->showtime_model->decrement_availability($_SESSION["ticket_id"]);
		
	}
	
	function get_theater_names() {

	}

	function set_next_lowest_ticket_num() {
		
		$q = $this->db->query("select ticket from ticket");
		$result = array();
		foreach ($q->result() as $item) {
			array_push($result, $item->ticket);
		}
		
		while (in_array($_SESSION["ticket_id"], $result)) {
			$_SESSION["ticket_id"]++;
		}
		
	}
	
	
}
?>