<?php
    $root = $_SERVER["DOCUMENT_ROOT"];

    $page_title = "Add Performance";
    $tool_name = "Add Performance";
    
    include_once $root . "/admin/tool-header.php";
    
    if (isset($_POST["submit"])) {
        include $root . "/tools/db-connect.php";
        $db = create_db_connection("faceoff");

        $player_id = $_POST["player-select"];
        $game_id = $_POST["game-select"];
        $wins = $_POST["performance-wins"];
        $losses = $_POST["performance-losses"];
        $gbs = $_POST["performance-gbs"];

        $sql = "INSERT INTO Performance (player_id, game_id, wins, losses, gbs) VALUES ('{$player_id}', '{$game_id}', {$wins}, {$losses}, {$gbs});";
        $db->query($sql);

        $sql = "SELECT wins, losses, gbs FROM Player WHERE player_id = {$player_id};";
        $player_data = $db->query($sql);
        if ($player_data->num_rows <= 0) {
            die("Failed to get player data");
        }
        $player_data = $player_data->fetch_assoc();

        $wins = $wins + $player_data["wins"];
        $losses = $losses + $player_data["losses"];
        $gbs = $gbs + $player_data["gbs"];

        $sql = "UPDATE Player SET wins = {$wins}, losses = {$losses}, gbs = {$gbs} WHERE player_id = {$player_id};";
        $db->query($sql);

        echo "Successfully added player peformance!<br><a href='/players'>View Players</a><br><a href='/games'>View Games</a>";
        return;
    }
    include $root . "/tools/db-connect.php";
    $db = create_db_connection("faceoff");
    $sql = "SELECT name, player_id FROM Player;";

    $players = $db->query($sql);
    if ($players->num_rows <= 0) {
        die("Failed retrieving players");
    }

    $sql = "SELECT * FROM Game;";
    $games = $db->query($sql);
    if ($games->num_rows <= 0) {
        die("Failed retrieving games");
    }
?>

<form method="POST" id="tool-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <br>
    <label>Player:</label>
    <select name="player-select" id="player-select">
    <?php
        while ($player = $players->fetch_assoc()) {
            echo "<option value=" . $player["player_id"] . ">" . $player["name"] . "</option>";
        }
    ?>
    </select>
    <label>Game:</label>
    <select name="game-select" id="game-select">
    <?php
        while ($game = $games->fetch_assoc()) {
            echo "<option value=" . $game["game_id"] . ">" . $game["opponent"] . "</option>";
        }
    ?>
    </select>
    <label>Wins:</label>
    <input type="number" name="performance-wins" id="performance-wins" required>
    <label>Losses:</label>
    <input type="number" name="performance-losses" id="performance-losses" required>
    <label>GBs:</label>
    <input type="number" name="performance-gbs" id="performance-gbs" required>

    <input type="submit" name="submit" id="submit">
</form>

</body>
<footer></footer>
</html>