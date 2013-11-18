$(document).ready(function(str) {
 {
 	var year = "20";
 	year = (year + "" + str.substr(0,2));
 	var month = str.substr(3,5);

 	if (is_numeric(str.substr(2,3)) == true){
 		this.form_validation.set_message('checkExpireDate', 'Input not in correct format');
 		return false;
 	}
 	var checkYear = 0;
 	this.form_validation.set_message('checkExpireDate', 'Input must be integers');
 	var check = isNaN(year);
 	if (check == true){
 		return false;
 	}
 	check = isNaN(month);
 	if (check == true){
 		return false;
 	}
 	if (month > 12){
 		this.form_validation.set_message('checkExpireDate', 'The month given is not correct');
 		return false;
 	}
 	if (year < date("Y"))
 	{
 		this.form_validation.set_message('checkExpireDate', 'The credit card already expired');
 		return false;
 	}
 	if (year == date("Y")){
 		checkYear = 1;
 	}
 	if (checkYear == 1){
 		if(month < date("m"))
 		{
 			this.form_validation.set_message('checkExpireDate', 'The credit card already expired');
 			return false;
 		}	
 	}
 	
 		return true;		
};});