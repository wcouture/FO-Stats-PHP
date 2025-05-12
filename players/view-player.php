<?php 
$API_FLAG = $_GET["API"];
$root = $_SERVER["DOCUMENT_ROOT"];

$page_title = "Player Details";
$page_css = '<link rel="stylesheet" type="text/css" href="/css/players.css">';

include_once $root . "/includes/header.php";
include $root . "/tools/db-connect.php";
include $root . "/tools/server-functions.php";

$db = create_db_connection("faceoff");

$player_id = $_GET["id"];

$sql = "SELECT SUM(wins) as tot_wins, SUM(losses) as tot_losses, SUM(gbs) as tot_gbs FROM Performance WHERE player_id = {$player_id};";
$results = $db->query($sql);
$row = $results->fetch_assoc();

$wins = $row["tot_wins"] ?? 0;
$losses = $row["tot_losses"] ?? 0;
$gbs = $row["tot_gbs"] ?? 0;

$sql = "SELECT * FROM Player WHERE player_id = {$player_id};";

$results = $db->query($sql);
$row = $results->fetch_assoc();

$name = $row["name"];
$number = $row["number"];
?>

<div class="player-page-container">
    <div class="player-page-name">
        <?php echo "#" . $number. " " . $name;?>
    </div>
    <div class="player-details-container">
        <div class="player-details-header">
            Overall Stats:
        </div>
        <div class="player-details">
            <?php
                if ($wins + $losses > 0)
                    $percent = floatval($wins) / floatval($wins + $losses) * 100;
                echo "Wins: " . $wins . " | Losses: " . $losses . " | GBs: " . $gbs . "<br>{$percent} %";
            ?>
        </div>
    </div>
    <div class="performances-header">
        Performances:
    </div>
    <div class="player-performances-container">
        <?php 
            $sql = "SELECT * FROM Performance WHERE player_id = {$player_id}";
            $results = $db->query($sql);
            if ($results->num_rows <= 0) {
                echo "No performances recorded";
                //console_print("No recorded performances");
            }
            else {
                while ($row = $results->fetch_assoc()) {
                    include ($root . "/players/performance-card.php");
                }
            }
        ?>
        

    </div>
</div>

<?php 
include_once $root . "/includes/footer.php";
?>