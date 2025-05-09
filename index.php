<?php
    $root = $_SERVER["DOCUMENT_ROOT"];
    $page_title = "Home";
    $page_css = '<link rel="stylesheet" type="text/css" href="/css/home.css"><br><link rel="stylesheet" type="text/css" href="/css/games.css">';
    include_once($root . "/includes/header.php");
    include_once($root . "/tools/db-connect.php");

    $db = create_db_connection("faceoff");
    $sql = "SELECT SUM(wins) as tot_wins, SUM(losses) as tot_losses, SUM(gbs) as tot_gbs FROM Performance;";
    $results = $db->query($sql);

    if ($results->num_rows <= 0) {
        echo "Failed loading player data";
    }
    else {
        $row = $results->fetch_assoc();

        $total_wins = $row["tot_wins"] ?? 0;
        $total_losses = $row["tot_losses"] ?? 0;
        $total_gbs = $row["tot_gbs"] ?? 0;
        $total_percent = 0;

        if ($total_wins + $total_losses > 0) {
            $total_percent = floatval($total_wins) / floatval($total_wins + $total_losses) * 100;
        }
    }
    

?>
<div class="padding-row"></div>
<!-- Padding row between header and main contents -->

<!-- Main image and title row -->
<div class="box" id="title-box">
    <div class="home-title">
        Florida State
    </div>
    <div class="home-subtitle">
        Lacrosse Face-Off<br>Statistics
    </div>
    <div class="season-stats">
        Season Unit Totals:<br>
        Wins: <?php echo $total_wins; ?> | Losses: <?php echo $total_losses; ?> | GBs: <?php echo $total_gbs; ?><br>
        Win %: <?php echo round($total_percent, 2); ?>
    </div>
</div>


<!-- Recent games -->
<div class="section-header">
    Recent and Upcoming Games:
</div>
<div class="row"> 
    <?php 
        // Print recent and upcoming games here
        $compare_date = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 16, date("Y")));

        $sql = "SELECT * FROM Game WHERE date >= '{$compare_date}' LIMIT 5;";
        $games = $db->query($sql);

        if ($games->num_rows <=0) {
            echo "Failed to load recent games.";
        }
        else {
            while ($game = $games->fetch_assoc() ) {
                $row = $game;
                include $root . "/games/game-card.php";
            }
        }
    ?>
</div>

<div class="section-header">
    Top Performances:
</div>
<div class="row">
    <?php
        $sql = "SELECT * FROM `Performance` WHERE wins > 0 ORDER BY wins DESC, (wins / (wins + losses)) DESC LIMIT 5;";
        $performances = $db->query($sql);

        if ($performances->num_rows <= 0) {
            echo "failed to retrieve top performances";
        }
        else {
            $homepage = true;
            while ($row = $performances->fetch_assoc()) {
                include $root . "/games/performance-card.php";
            }
        }
    ?>
</div>


<!-- Stat leaders -->
<div class="section-header">
    Stat Leaders:
</div>
<div class="gb-stat-disclaimer">(*GBs off of faceoff only)</div>
<div class="row" > 
    <?php 
        // Print stat leaders here
        // Wins
        $sql = "SELECT wins, name, number, player_id FROM Player ORDER BY wins DESC;";
        $result = $db->query($sql);

        if ($result->num_rows <= 0) {
            echo "Failed to load stat leader.";
        }
        else {
            $player = $result->fetch_assoc();
            
?>
    <a href="/players/view-player?id=<?php echo $player["player_id"];?>" class="player-performance-card" style="font-size: 32pt;">
        <div class="stat-leader-name">
            <?php echo "#" . $player["number"] . " " . $player["name"];?>
        </div>
        <div class="performance-stats-container" style="font-size: 24pt;">
            Wins: <?php echo $player["wins"]; ?>
        </div>
    </a>

<?php
        }

        // GBs
        $sql = "SELECT gbs, name, number, player_id FROM Player ORDER BY gbs DESC;";
        $result = $db->query($sql);

        if ($result->num_rows <= 0) {
            echo "Failed to load stat leader.";
        }
        else {
            $player = $result->fetch_assoc();
?>
    <a href="/players/view-player?id=<?php echo $player["player_id"];?>" class="player-performance-card" style="font-size: 32pt;">
        <div class="stat-leader-name">
            <?php echo "#" . $player["number"] . " " . $player["name"];?>
        </div>
        <div class="performance-stats-container" style="font-size: 24pt;">
            GBs: <?php echo $player["gbs"]; ?>
        </div>
    </a>

<?php
        }
        // Percent
        $sql = "SELECT * FROM Player;";
        $players = $db->query($sql);

        if ($players->num_rows <= 0) {
            echo "Failed to load stat leader";
        }
        else {
            $max_player = null;
            $max_percent = 0;
            while($player = $players->fetch_assoc()) {
                $wins = $player["wins"];
                $losses = $player["losses"];

                $percent = 0;
                if ($wins + $losses > 0) {
                    $percent = round(floatval($wins) / floatval($wins + $losses) * 100, 2);
                }
                
                if ($percent > $max_percent) {
                    $max_percent = $percent;
                    $max_player = $player;
                }
            }

            ?>
    <a href="/players/view-player?id=<?php echo $max_player["player_id"];?>" class="player-performance-card" style="font-size: 32pt;">
        <div class="stat-leader-name">
            <?php echo "#" . $max_player["number"] . " " . $max_player["name"];?>
        </div>
        <div class="performance-stats-container" style="font-size: 24pt;">
            Win %: <?php echo $max_percent; ?>
        </div>
    </a>

<?php
        }
    ?>
</div>

<?php
include_once $root . "/includes/footer.php";
?>