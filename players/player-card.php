<?php
    $p_id = $row['player_id'];
    $p_name = $row['name'];
    $p_number = $row['number'];

    $sql = "SELECT SUM(wins) as tot_wins, SUM(losses) as tot_losses, SUM(gbs) as tot_gbs FROM Performance WHERE player_id = {$p_id};";
    $results = $db->query($sql);
    if ($results->num_rows < 1) {
        console_print("Failed to retrieve player performance data.");
    }
    $row = $results->fetch_assoc();

    $p_wins = $row["tot_wins"] ?? 0;
    $p_losses = $row["tot_losses"] ?? 0;
    $p_gbs = $row["tot_gbs"] ?? 0;

    $p_percent = 0;
    if ($p_wins + $p_losses > 0) 
        $p_percent = floatval($p_wins) / (floatval($p_losses) + floatval($p_wins)) * 100;
    $p_gb = $row['gbs'];
?>
<a href="/players/view-player?id=<?php echo $p_id; ?>" class="player-card">
    <div class="player-name-label">
        <?php echo $p_name; ?>
    </div>
    <div class="player-stats-container">
        <div class="player-wins">Wins: <?php echo $p_wins; ?></div>
        <div class="player-losses">Losses: <?php echo $p_losses; ?></div>
        <div class="player-gbs">GBs: <?php echo $p_gbs; ?></div>
        <div class="player-percent">Win %: <?php echo round($p_percent, 2); ?></div>
    </div>
</a>