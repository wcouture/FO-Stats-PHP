<?php
    $root = $_SERVER["DOCUMENT_ROOT"];

    $page_title = "Create Game";
    $tool_name = "Create Game";
    
    include_once $root . "/admin/tool-header.php";
    
    if (isset($_POST["submit"])) {
        include $root . "/tools/db-connect.php";
        $db = create_db_connection("faceoff");

        $game_date = $_POST["game-date"];
        $game_opp = $_POST["game-opponent"];
        $game_is_home = intval($_POST["is-home"]) ?? 0;

        $sql = 'INSERT INTO Game (date, opponent, home) VALUES ("'.$game_date.'", "'.$game_opp.'", '.$game_is_home.');';
        $db->query($sql);

        echo "Successfully created game!<br><a href='/games'>View games</a>";
        return;
    }
?>

<form method="POST" id="tool-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <br>
    <label>Game Gate:</label>
    <input type="date" name="game-date" id="game-date" required>
    <label>Opponent:</label>
    <input type="text" name="game-opponent" id="game-opponent" required>
    <label>Is Home? <input type="checkbox" name="is-home" id="is-home" value="1"></label>

    <input type="submit" name="submit" id="submit">
</form>

</body>
<footer></footer>
</html>