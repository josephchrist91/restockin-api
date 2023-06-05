<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("HTTP/1.1 200 OK");

$data_request = json_decode(file_get_contents('php://input'), true);

//store request payload
// $req_outletpin = $data_request['outletPin'];
$req_distid = $data_request['distId'];
// $req_product = $data_request['product'];


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


// get pending order ========
$sql = "
select * from order_detail where order_id IN	
(select order_id from order_group where status = '0' and dist_id = '" . $req_distid . "')
	";
$result = $conn->query($sql);

$rows = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row; // Add each row to the array
    }
} else {
    echo "No results found.";
}

//===============


$arr_data = array(
    'product' => $rows,
);

$arr = array(
    'code' => 200,
    'message' => "List of pending orders from this distributor",
    'data' => $arr_data
);

//=== RETURN FINAL ARRAY ===
echo json_encode($arr);