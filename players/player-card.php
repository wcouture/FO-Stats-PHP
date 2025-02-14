<?php
    $p_id = $row['player_id'];
    $p_name = $row['name'];
    $p_number = $row['number'];
    $p_wins = $row['wins'] ?? 0;
    $p_losses = $row['losses'] ?? 0;
    $p_gbs = $row['gbs'] ?? 0;
    $p_percent = 0;
    if ($p_wins + $p_losses > 0) 
        $p_percent = floatval($p_wins) / (floatval($p_losses) + floatval($p_wins)) * 100;
    $p_gb = $row['gbs'];
?>
<a href="/players/view-player?id=<?php echo $p_id; ?>" class="player-performance-card">
    <div class="performance-game-label">
        <?php echo $p_name; ?>
    </div>
    <div class="performance-stats-container">
        <div class="performance-wins">Wins: <?php echo $p_wins; ?></div>
        <div class="performance-losses">Losses: <?php echo $p_losses; ?></div>
        <div class="performance-gbs">GBs: <?php echo $p_gbs; ?></div>
        <div class="performance-percent">Win %: <?php echo round($p_percent, 2); ?></div>
    </div>
</a>