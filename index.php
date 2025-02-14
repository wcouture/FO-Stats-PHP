<?php
    $root = $_SERVER["DOCUMENT_ROOT"];
    $page_title = "Home";
    $page_css = '<link rel="stylesheet" type="text/css" href="/css/home.css"><br><link rel="stylesheet" type="text/css" href="/css/players.css"><br><link rel="stylesheet" type="text/css" href="/css/games.css">';
    include_once($root . "/includes/header.php");
    include_once($root . "/tools/db-connect.php");
?>
<!-- Padding row between header and main contents -->
<div class="row">
</div>

<!-- Main image and title row -->
<div class="row">
    <!-- <div class="box" id="main-image-box">
        <div class="main-image-container">
            <img style="width: 100%; height: auto;" src="/images/fostats-home-image2.png">
        </div>
    </div> -->
    <div class="box" id="title-box">
        <div class="home-title">
            Florida State
        </div>
        <div class="home-subtitle">
            Lacrosse Face-Off<br>Statistics
        </div>
    </div>
</div>


<!-- Recent games -->
<div class="section-header">
    Recent and Upcoming Games:
</div>
<div class="row" style="width: 65%; margin: 15px; justify-content: flex-start; gap: 20px;"> 
    <?php 
        // Print recent and upcoming games here
        $compare_date = $days_ago = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 30, date("Y")));

        $sql = "SELECT * FROM Game WHERE date >= {$compare_date};";
        $db = create_db_connection("faceoff");
        $games = $db->query($sql);

        if ($games->num_rows <=0) {
            echo "Failed to load recent games.";
        }
        else {
            $count = 0;
            while ($count < 4 && $game = $games->fetch_assoc() ) {
                $count++;
                $row = $game;
                include $root . "/games/game-card.php";
            }
        }
    ?>
</div>


<!-- Stat leaders -->
<div class="section-header">
    Stat Leaders:
</div>
<div class="row" style="width: 65%; margin: 15px; justify-content: center; gap: 80px;"> 
    <?php 
        // Print stat leaders here
        // Wins
        $sql = "SELECT MAX(wins), wins, name, number, player_id FROM Player;";
        $result = $db->query($sql);

        if ($result->num_rows <= 0) {
            echo "Failed to load stat leader.";
        }
        else {
            $player = $result->fetch_assoc();
            
?>
    <a href="/players/view-player?id=<?php echo $player["player_id"];?>" class="player-performance-card" style="font-size: 32pt;">
        <div class="performance-game-label">
            <?php echo $player["number"] . " " . $player["name"];?>
        </div>
        <div class="performance-stats-container" style="font-size: 24pt;">
            Wins: <?php echo $player["wins"]; ?>
        </div>
    </a>

<?php
        }

        // GBs
        $sql = "SELECT MAX(gbs), gbs, name, number, player_id FROM Player;";
        $result = $db->query($sql);

        if ($result->num_rows <= 0) {
            echo "Failed to load stat leader.";
        }
        else {
            $player = $result->fetch_assoc();
?>
    <a href="/players/view-player?id=<?php echo $player["player_id"];?>" class="player-performance-card" style="font-size: 32pt;">
        <div class="performance-game-label">
            <?php echo $player["number"] . " " . $player["name"];?>
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
    <a href="/players/view-player?id=<?php echo $player["player_id"];?>" class="player-performance-card" style="font-size: 32pt;">
        <div class="performance-game-label">
            <?php echo $max_player["number"] . " " . $max_player["name"];?>
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