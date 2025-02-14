<?php
    include_once $root . "/tools/server-functions.php";
    $opponent = $row["opponent"];
    $date = $row["date"];
    $home = intval($row["home"]) == 1;

    $upcoming = false;
    $today = date('Y-m-d');
    $compare_date = $days_ago = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
    
    $wins = 0;
    $losses = 0;
    $gbs = 0;
    $percent = 0;
    
    $game_id = $row["game_id"];

    if ($date >= $compare_date) {
        $upcoming = true;
    }
    else {
        // Accumulate game stats
        

        $sql = "SELECT wins, losses, gbs FROM Performance WHERE game_id = {$game_id};";
        $db2 = create_db_connection("faceoff");
        
        $performances = $db2->query($sql);
        if ($performances->num_rows <= 0) {
            console_print("failed to retrieve performance data for game: " . $opponent . " | " . $game_id);
            $upcoming = true;
        }
        else {
            while ($perf = $performances->fetch_assoc()) {
                $wins += $perf["wins"];
                $losses += $perf["losses"];
                $gbs += $perf["gbs"];
            }
    
            if ($wins + $losses > 0) {
                $percent = floatval($wins) / floatval($wins + $losses) * 100;
            }
        }
    }

    

?>

<a href="/games/view-game?id=<?php echo $game_id; ?>" class="games-card <?php if ($home) echo "home";?>">
    <div class="games-card-opponent">
        <?php echo $opponent; ?>
        <div class="games-card-date"><?php echo $date;?></div>
    </div>
    <div class="games-card-stats">
        <?php
            if ($upcoming) { ?>
        <div>Coming soon...</div>
            <?php
            }
            else {?>
        <div>Wins: <?php echo $wins;?></div>
        <div>Losses: <?php echo $losses;?></div>
        <div>GBs: <?php echo $gbs;?></div>
        <div><?php echo round($percent, 2); ?> %</div>
        <?php } ?>
    </div>
</a>