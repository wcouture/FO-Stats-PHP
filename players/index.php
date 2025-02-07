<?php 
    $root = $_SERVER["DOCUMENT_ROOT"];
    $page_title = "Players";

    include_once $root . "/includes/header.php";

    include $root . "/tools/db-connect.php";

    $sql = "SELECT number, name, wins, losses, gbs FROM Player;";
    $db = create_db_connection("faceoff");
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row['number'] . " | " . $row['name'] . " | Wins: " . $row['wins'] . " | Losses: " . $row['losses'] . " | GBs: " . $row['gbs'] . "<br>";
        }
    }
    else {
        echo "No results";
    }
    $db->close();

?>

<?php
include_once $root . "/includes/footer.php";
?>
