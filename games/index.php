<?php 
    $root = $_SERVER["DOCUMENT_ROOT"];
    $page_title = "Games";
    include_once $root . "/includes/header.php";

    include $root . "/tools/db-connect.php";

    $sql = "SELECT * FROM Game;";
    $db = create_db_connection("faceoff");
    $results = $db->query($sql);

    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            echo $row['date'] . " | " . $row['opponent'];
        }
    }
    else {
        echo "No recent or upcoming games.";
    }

    $db->close();
?>

<?php
    include_once $root . "/includes/footer.php";
?>