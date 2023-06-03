<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("HTTP/1.1 200 OK");

$data_request = json_decode(file_get_contents('php://input'), true);

//store request payload
$req_outletpin = $data_request['outletPin'];
$req_outletid = $data_request['outletId'];
$req_product = $data_request['product'];


$product_arr = array();


//db connection

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
//========


// check outlet pin ========
$sql = "
	select outlet_pin from outlet where outlet_id = '" . $req_outletid . "'  and outlet_pin = '" . $req_outletpin . "'
	";
$result = $conn->query($sql);
$hasilcek = $result->fetch_assoc();

$cekpin = ($hasilcek['outlet_pin'] ? 1 : 0);
//===============

if ($cekpin == 1) {
	//insert order ============

	//insert group
	$cur_datetime = date('Y-m-d H:i:s');

	$sql = "
INSERT INTO order_group (created_date, created_by, status) 
VALUES ('" . $cur_datetime . "', '" . $req_outletid . "', '0')";

	$result = $conn->query($sql);

	if ($result) {
		// Get the auto-incremented ID
		$insertedId = mysqli_insert_id($conn);
	} else {
		// Handle the query error
		echo "Query failed: " . mysqli_error($conn);
	}


	//insert detail
	foreach ($req_product as $row) {
		$product = mysqli_real_escape_string($conn, $row['pricePlanCode']);
		$qty = mysqli_real_escape_string($conn, $row['qty']);

		$query = "INSERT INTO order_detail (order_id, product_id, quantity) VALUES ('$insertedId','$product', '$qty')";
		$result = $conn->query($query);

	
	}


	//==============
}

$arr_data = array(
	'test' => $cekpin,
	'product' => $req_product,
);

$arr = array(
	'code' => 200,
	'message' => "Order successfully submitted",
	'data' => $arr_data
);

//=== RETURN FINAL ARRAY ===
echo json_encode($arr);