<?php
    $p_id = $row['player_id'];
    $p_name = $row['name'];
    $p_number = $row['number'];
    $p_wins = $row['wins'] ?? 0;
    $p_losses = $row['losses'] ?? 0;
    $p_percent = 0;
    if ($p_wins + $p_losses > 0) 
        $p_percent = floatval($p_wins) / (floatval($p_losses) + floatval($p_wins)) * 100;
    $p_gb = $row['gbs'];
?>
<a class="player-card-link" href="/players/view-player?id=<?php echo $p_id;?>">
<div class="player-card">
    <!-- <div class="player-link-container">
        <i class="fa-regular fa-circle-right"></i></a>
    </div> -->
    <div class="player-number-label">
        <?php echo '#'.$p_number; ?>
    </div>    
    <div class="player-name-label">
        <?php echo $p_name; ?>
    </div>
    <div class="player-wins-label">
        <?php echo "Wins: ".$p_wins; ?>
    </div>
    <div class="player-losses-label">
        <?php echo "Losses: ".$p_losses; ?>
    </div>
    <div class="player-percent-label">
        <?php echo "Win %: ".round($p_percent, 2)."%"; ?>
    </div>
    <div class="player-gb-label">
        <?php echo "GBs: ".$p_gb; ?>
    </div>
</div>
</a>