<?php
$game_id = $_GET["id"];

$root = $_SERVER["DOCUMENT_ROOT"];

include $root . "/tools/db-connect.php";
include_once $root . "/tools/server-functions.php";

$db = create_db_connection("faceoff");

$full_list_sql = "SELECT * FROM Game;";

if (isset($game_id)) {

}
else {
    $result = $db->get_result()->fetch_all(MYSQLI_ASSOC);

    if (len($result) <= 0) {
        die("{status: 'failure'}");
    }

    $data_output = [];
    foreach ($result as $row) {
        array_push($data_output, $row);
    }

    $final_output = json_encode($data_output);

    header('Content-type: application/json');
    echo $final_output;
}
?>