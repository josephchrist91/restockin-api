<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("HTTP/1.1 200 OK");

$data_request = json_decode(file_get_contents('php://input'), true);

//store request payload
$req_distpin = $data_request['distPin'];
$req_distid = $data_request['distId'];
$req_productgroup = $data_request['productGroup'];


$product_arr = array();


//db connection
//=================================================
//===  ONLY EDIT FOR CHANGING CREDENTIALS  =======
//================================================
$host = "localhost";
$db_name = "restockin";
$username = "root";
$password = "";

function db_connect($host, $user, $pass, $db)
{
	$mysqli = new mysqli($host, $user, $pass, $db);
	$mysqli->set_charset("utf8");
	if ($mysqli->connect_error)
		die('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());

	return $mysqli;
}

$conn = db_connect($host, $username, $password, $db_name);
//============================
//============================
//============================


// check distributor pin ========
$sql = "
	select dist_pin from distributor where dist_id = '" . $req_distid . "'  and dist_pin = '" . $req_distpin . "'
	";
$result = $conn->query($sql);
$hasilcek = $result->fetch_assoc();

$cekpin = ($hasilcek['dist_pin'] ? 1 : 0);
//===============

if ($cekpin == 1) {
	//insert order ============

	//insert group
	$cur_datetime = date('Y-m-d H:i:s');

	$sql = "
	UPDATE order_group SET approved_by = '" . $req_distid . "', approved_date = '" . $cur_datetime . "' 
	WHERE order_id = '" . $req_productgroup . "'
";

	$result = $conn->query($sql);


	//==============
}

$arr_data = array(
	'test' => $cekpin,
	'product' => $req_productgroup,
);

$arr = array(
	'code' => 200,
	'message' => "Order successfully approved",
	'data' => $arr_data
);

//=== RETURN FINAL ARRAY ===
echo json_encode($arr);