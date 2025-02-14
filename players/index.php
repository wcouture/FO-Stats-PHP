<?php 
    $root = $_SERVER["DOCUMENT_ROOT"];
    $page_title = "Player List";

    $page_css = '<link rel="stylesheet" type="text/css" href="/css/players.css"><link rel="stylesheet" type="text/css" href="/css/games.css">';

    include_once $root . "/includes/header.php";

    include $root . "/tools/db-connect.php";

    $sql = "SELECT * FROM Player;";
    $db = create_db_connection("faceoff");
    $result = $db->query($sql);
?>

<div class="page-title-label">Faceoff Players</div>
<div class="player-list-container">
  <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                include $root . "/players/player-card.php";
            }
        }
        else {
            echo "No results";
        }
        $db->close();
    ?>
</div>


<?php
include_once $root . "/includes/footer.php";
?>
