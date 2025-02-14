<?php 
    $root = $_SERVER["DOCUMENT_ROOT"];
    $page_title = "Games";
    $page_css = '<link rel="stylesheet" type="text/css" href="/css/games.css">';
    include_once $root . "/includes/header.php";

    include $root . "/tools/db-connect.php";

    $sql = "SELECT * FROM Game;";
    $db = create_db_connection("faceoff");
    $results = $db->query($sql);

    if ($results->num_rows <= 0) {
        die("Failed to load game data.");
    }

    $db->close();
?>

<div class="games-header">
    Games
</div>
<div class="games-list-container">
    <?php
    while ($row = $results->fetch_assoc()) {
        include $root . "/games/game-card.php";
    }
    ?>
</div>

<?php
    include_once $root . "/includes/footer.php";
?>