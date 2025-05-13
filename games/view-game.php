<?php 
$API_FLAG = $_GET["API"];

$root = $_SERVER["DOCUMENT_ROOT"];

include $root . "/tools/db-connect.php";
include $root . "/tools/server-functions.php";

$game_id = $_GET["id"];

$sql = "SELECT * FROM Game WHERE game_id = {$game_id};";
$db = create_db_connection("faceoff");
$results = $db->query($sql);
$row = $results->fetch_assoc();

$game_opp = $row["opponent"];
$game_date = $row["date"];
$game_home = $row["home"];
if ($game_home == 1) {
    $game_home = "V.S.";
}
else {
    $game_home = "AT";
}

$sql = "SELECT * FROM Performance WHERE game_id = {$game_id};";
$results = $db->query($sql);

$wins = 0;
$losses = 0;
$gbs = 0;

$performances = array();

while ($row = $results->fetch_assoc()) {
    array_push($performances, $row);

    $wins += $row["wins"];
    $losses += $row["losses"];
    $gbs += $row["gbs"];
}

if (isset($API_FLAG)) {
    $output = [
        "opponent" => $game_opp,
        "date" => $game_date,
        "home" => $game_home,
        "wins" => $wins,
        "losses" => $losses,
        "gbs" => $gbs,
        "performance" => $performances
    ];

    header('Content-type: application/json');

    echo json_encode($output);
    return;
}


$page_title = "Game Details";
$page_css = '<link rel="stylesheet" type="text/css" href="/css/games.css">';

include_once $root . "/includes/header.php";
?>

<div class="game-page-container">
    <div class="game-page-name">
        <?php echo $game_home . " " . $game_opp;?>
    </div>
    <div class="game-details-container">
        <div class="game-details-header">
            Overall Stats:
        </div>
        <div class="game-details">
            <?php
                $percent = 0;
                if ($wins + $losses > 0)
                    $percent = round(floatval($wins) / floatval($wins + $losses) * 100, 2);
                echo "Wins: " . $wins . " | Losses: " . $losses . " | GBs: " . $gbs . "<br>{$percent} %";
            ?>
        </div>
    </div>
    <div class="performances-header">
        Performances:
    </div>
    <div class="player-performances-container">
        <?php 
            
            if ($results->num_rows <= 0) {
                echo "No performances recorded";
                //console_print("No recorded performances");
            }
            else {
                $len = count($performances);
                $i = 0;
                while ($i < $len) {
                    include ($root . "/games/performance-card.php");
                    $i++;
                }
            }
        ?>
        

    </div>
</div>

<?php 
include_once $root . "/includes/footer.php";
?>