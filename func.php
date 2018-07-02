<?php
$con = mysqli_connect("localhost", "root", "", "cpamarket");
if(!$con){
    die("Can Not Connect to Database");
}


function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));  // We merge several array together
	$max = count($characters) - 1; // We subtract the total amount of result of the array by - 1 so as to get accurate result
	
	for ($i = 0; $i < $length; $i++) { // We make use of for loop to get the amount of character we need
		$rand = mt_rand(0, $max);   // This search for the random between 0 and the total array count in the $characters 
		$str .= $characters[$rand]; // This concatinate the string until we get the exact ammount of character we need
	}
	return $str;
}

function con(){
    static $con;
    if($con === NULL){
        //$con = mysqli_connect("sql112.byetcluster.com", "19669630_7", "Y.95v4S]1p", "ezyro_19669630_cpa");
        $con = mysqli_connect("localhost", "root", "", "cpamarket");
    }
    return $con;
}

function check_user($user, $pass){
    $con = con();
    $valid = FALSE;
    $sql = mysqli_query($con, "SELECT myname, mypass FROM checkin WHERE myname = '$user' AND mypass = '$pass'");
    
    $fetch = mysqli_fetch_row($sql);
    if($fetch > 0){
        $valid = TRUE;
    }
    return $valid;
}

// SSanitizing input before inserting into database
function sanitize_input($value){
    $con = con();
    $value = trim($value);
    $value = mysqli_real_escape_string($con, $value);
    $value = stripslashes($value);
    $value = htmlentities($value);
    $value = strip_tags($value);
    
    return $value;
}

function sanitize_input_wysiwyg($value){
    $con = con();
    $value = trim($value);
    $value = mysqli_real_escape_string($con, $value);
    $value = stripslashes($value);
    
    return $value;
}
// Checking to know if a value already exist in the Database before adding it into the DB
function check_value_status($tb_name, $field_name, $id, $value){
    $con = db();
    $alreadyExist = TRUE;
    $sql = mysqli_query($con, " SELECT $id FROM $tb_name WHERE $field_name = '$value'");
    
    $result = mysqli_num_rows($sql);
    if($result < 1){
        $alreadyExist = FALSE;
    }
    
    return $result;
}
function category_exist($field, $value){
    $con = db();
    $sql = mysqli_query($con, " SELECT COUNT(1) FROM offer_type WHERE $field = '$value'");
    
    $result = mysqli_num_rows($sql);
    if($result > 0){
        $alreadyExist = TRUE;
    }  else {
        $alreadyExist = FALSE;
    }
    
    return $result;
}
// Get the catigories
function get_categories(){
    $con = db();
    $cat = array();
    $sql = mysqli_query($con, "SELECT id, name FROM offer_type" );

    while ($row = mysqli_fetch_assoc($sql)){
    $cat[] = $row;
    }
    return $cat;

}
