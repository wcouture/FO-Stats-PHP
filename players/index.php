<?php 
    $root = $_SERVER["DOCUMENT_ROOT"];
    $page_title = "Players";

    $page_css = '<link rel="stylesheet" type="text/css" href="/css/players.css">';

    include_once $root . "/includes/header.php";

    include $root . "/tools/db-connect.php";

    $sql = "SELECT number, name, wins, losses, gbs FROM Player;";
    $db = create_db_connection("faceoff");
    $result = $db->query($sql);
?>
<div class="player-list-container">
<div class="page-title-label">Faceoff Players</div>
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
