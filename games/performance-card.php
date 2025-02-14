<?php
    if (!$homepage)
        $row = $performances[$i];

    $wins = $row["wins"];
    $losses = $row["losses"];
    $gbs = $row["gbs"];

    $percent = 0;
    if ($wins + $losses > 0) {
        $percent = floatval($wins) / floatval($losses + $wins) * 100;
        $percent = round($percent, 2);
    }

    $game_id = $row["game_id"];
    $player_id = $row["player_id"];

    $sql = "SELECT date, opponent FROM Game WHERE game_id = {$game_id};";
    $game_results = $db->query($sql);
    
    if ($game_results->num_rows <= 0) {
        echo "failed loading game data: {$game_id}";
        return;
    }

    $game = $game_results->fetch_assoc();
    $game_opp = $game["opponent"];
    $game_date = $game["date"];

    $sql = "SELECT name FROM Player WHERE player_id = {$player_id};";
    $results = $db->query($sql);
    if ($results->num_rows <= 0) {
        die("Failed loading player data: {$player_id}");
        return;
    }
    $player = $results->fetch_assoc();
    $player_name = $player["name"];
?>

<a href="/players/view-player?id=<?php echo $player_id; ?>" class="player-performance-card">
    <div class="performance-name-label">
        <?php echo $player_name; ?>
        <div class="game-date-label">
            <?php 
            if ($homepage)
                echo $game_opp . " | ";
            echo $game_date; 
            ?>
        </div>
    </div>
    <div class="performance-stats-container">
        <div class="performance-wins">Wins: <?php echo $wins; ?></div>
        <div class="performance-losses">Losses: <?php echo $losses; ?></div>
        <div class="performance-gbs">GBs: <?php echo $gbs; ?></div>
        <div class="performance-percent">Win %: <?php echo round($percent, 2); ?></div>
    </div>
</a>