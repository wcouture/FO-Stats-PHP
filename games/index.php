<?php 
    $API_FLAG = $_GET["API"];

    $root = $_SERVER["DOCUMENT_ROOT"];

    include $root . "/tools/db-connect.php";

    $sql = "SELECT * FROM Game;";
    $db = create_db_connection("faceoff");
    $results = $db->query($sql);

    if ($results->num_rows <= 0) {
        die("Failed to load game data.");
    }

    $db->close();

    if (isset($API_FLAG)) {
        $data = $results->fetch_all(MYSQLI_ASSOC);
        header("Content-type: application/json");
        echo json_encode($data);
    }
    else {
        $page_title = "Game List";
        $page_css = '<link rel="stylesheet" type="text/css" href="/css/games.css">';
        include_once $root . "/includes/header.php";
?>
<script src="/js/toggle-home-away.js">
</script>
<div class="games-header">
    Games
    <div class="game-key">
        <p onclick="handle_toggle('home')" class="home-key-label" id="home-key">
        Home
        </p>
        <p onclick="handle_toggle('away')" class="away-key-label" id="away-key">
        Away
        </p>
    </div>
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
}
?>