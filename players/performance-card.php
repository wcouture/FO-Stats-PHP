<?php
    $wins = $row["wins"];
    $losses = $row["losses"];
    $gbs = $row["gbs"];

    $percent = 0;
    if ($wins + $losses > 0)
        $percent = floatval($wins) / floatval($wins + $losses) * 100;

    $game_id = $row["game_id"];

    $sql = "SELECT date, opponent, home FROM Game WHERE game_id = {$game_id};";
    $game_results = $db->query($sql);
    
    if ($game_results->num_rows <= 0) {
        echo "failed loading game data: {$game_id}";
        return;
    }

    $game = $game_results->fetch_assoc();
    $game_opp = $game["opponent"];
    $game_date = $game["date"];
    $home = intval($game["home"]) != 1;
?>

<a href="/games/view-game?id=<?php echo $game_id;?>" class="player-performance-card <?php if ($home) echo "home";?>">
    <div class="performance-game-label">
        <?php echo $game_opp; ?>
        <div class="game-date-label">
            <?php echo $game_date; ?>
        </div>
    </div>
    <div class="performance-stats-container">
        <div class="performance-wins">Wins: <?php echo $wins; ?></div>
        <div class="performance-losses">Losses: <?php echo $losses; ?></div>
        <div class="performance-gbs">GBs: <?php echo $gbs; ?></div>
        <div class="performance-percent">Win %: <?php echo round($percent, 2); ?></div>
    </div>
</a>