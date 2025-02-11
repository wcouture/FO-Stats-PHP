<?php
    $root = $_SERVER["DOCUMENT_ROOT"];

    $page_title = "Add Performance";
    $tool_name = "Add Performance";
    
    include_once $root . "/admin/tool-header.php";
    
    if (isset($_POST["submit"])) {
        include $root . "/tools/db-connect.php";
        $db = create_db_connection("faceoff");

        $game_date = $_POST["game-date"];
        $game_opp = $_POST["game-opponent"];
        $game_is_home = $_POST["is-home"] == "on";

        $sql = "INSERT INTO Game (date, opponent, home) VALUES ('{$game_date}', '{$game_opp}', {$game_is_home});";
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