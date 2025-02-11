<?php
    $root = $_SERVER["DOCUMENT_ROOT"];

    $page_title = "Create Player";
    $tool_name = "Create Player";
    
    include_once $root . "/admin/tool-header.php";
    
    if (isset($_POST["submit"])) {
        include $root . "/tools/db-connect.php";
        $db = create_db_connection("faceoff");

        $player_name = $_POST["player-name"];
        $player_number = $_POST["player-number"];

        $sql = "INSERT INTO Player (number, name) VALUES ('{$player_number}', '{$player_name}');";
        $db->query($sql);

        echo "Successfully created player!<br><a href='/players'>View players</a>";
        return;
    }
?>

<form method="POST" id="tool-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <br>
    <label>Player Name:</label>
    <input type="text" name="player-name" id="player_name" required>
    <label>Player Number:</label>
    <input type="number" name="player-number" id="player_number" required>

    <input type="submit" name="submit" id="submit">
</form>

</body>
<footer></footer>
</html>