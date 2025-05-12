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

    

    if (isset($API_FLAG)) {
        $output = [];

        while ($game_row = $results->fetch_assoc()) {
            $g_id = $game_row["game_id"];
            $sql = "SELECT SUM(wins) as tot_wins, SUM(losses) as tot_losses FROM Performance WHERE game_id = {$g_id};";
            $game_result = $db->query($sql);
            $row = $game_result->fetch_assoc();

            $game = [
                "game_id" => $g_id,
                "date" => $game_row["date"],
                "home" => $game_row["home"],
                "opponent" => $game_row["opponent"],
                "wins" => $row["tot_wins"],
                "losses" => $row["tot_losses"]
            ];

            array_push($output, $game);
        }
        $db->close();
        header("Content-type: application/json");
        echo json_encode($output);
    }
    else {
        $db->close();
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