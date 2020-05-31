<html>
<head>
    <meta charset =utf-8  http-equiv="refresh" content="60; url=turn.php">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    body {
        background-image: url(img.jpg);
        background-size: 100% auto;
    }
</style>
<title>Dicing Room</title>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6" style="margin-top: 150px;margin-left:100px">
<?php
$errFlag=1;
if(isset($_COOKIE['Cookie'])) {

    $errFlag = 0;
    $data = mysqli_connect('localhost', "root", '', 'CV');
    if (!$data) {
        $errFlag = 1;
        header('HTTP/1.1 302 Redirect');
        header('/loginPage.php?alert=database'); // cannot connect to mysql database
    }

    $time = date('y/m/d H:i:s', time());
    $cookie = $_COOKIE['Cookie'];
    $result = mysqli_query($data, "select `user_id` from `tokens` where `auth_token`='$cookie'");
    $tmpId = mysqli_fetch_row($result);
    if ($tmpId[0]) {
    } else {
        $errFlag = 1;
    }
    //getting game id
    $result=mysqli_query($data,"select `game_id` from `game` where (`player1_id`='$tmpId[0]' or `player2_id`='$tmpId[0]') and (`game_status`='t1' or `game_status`='t2' )");
    if(!$result){
        echo mysqli_error($data) . ' line 29';
        $errFlag = 1;
    }
    $gameId=mysqli_fetch_row($result);
    if(!$gameId[0]){
        $errFlag = 1;
    }
    $result=mysqli_query($data,"select `player1_score` , `player2_score` from `game` where `game_id`='$gameId[0]'");
    $Scores=mysqli_fetch_row($result);
    if($Scores[0]>99){
        $result=mysqli_query($data,"update `game` set `game_status`='w1',`game_ended_in`='$time' where `game_id`='$gameId[0]'");
        if(!$result){$errFlag=1;echo mysqli_error($data);};
    }elseif ($Scores[1]>99){
        $result=mysqli_query($data,"update `game` set `game_status`='w2',`game_ended_in`='$time' where `game_id`='$gameId[0]'");
        if(!$result){$errFlag=1;echo mysqli_error($data);};
    }
    //select user position
    $result=mysqli_query($data,"select `player1_id` , `player2_id` from `game` where `game_id`='$gameId[0]'");
    if(!$result){
        echo mysqli_error($data) . ' line 49';
        $errFlag = 1;
    }
    $possiblePId=mysqli_fetch_row($result);
    if($possiblePId[0]==$tmpId[0]){
        $userNumber=1;
    }elseif ($possiblePId[1]==$tmpId[0]){
        $userNumber=2;
    }
    //another user
    if($userNumber==1){
        $anotherUser='t2';
    }elseif($userNumber==2){
        $anotherUser='t1';
    }
    if(!isset($anotherUser)){$errFlag=1;}

//time update
    if(!$errFlag){
        $result = mysqli_query($data, "update `gameLobby` set `last_update`='$time' where `player_id`='$tmpId[0]'");
        if (!$result) {
            echo mysqli_error($data) . ' line 32';
            $errFlag = 0;
        }

    //userScore
    if($userNumber==1){
        $score=$Scores[0];
    }elseif ($userNumber==2){
        $score=$Scores[1];
    }
    echo 'Your score is:'.$score."<br>";
 }
if(!$errFlag) {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'toss') {
            $toss = rand(1, 6);
            echo 'You rolled ' . $toss."<br>";
            if ($toss == 1) {
                $result = mysqli_query($data, "update `game` set `current_bet`='0' where `game_id`='$gameId[0]'");
                if (!$result) {
                    $errFlag = 1;
                    echo mysqli_error($data);
                };
                $result = mysqli_query($data, "update `game` set `game_status`='$anotherUser' where `game_id`='$gameId[0]'");
                if (!$result) {
                    $errFlag = 1;
                    echo mysqli_error($data);
                };
                header('HTTP/1.1 302 Redirect');
                header('/game.php?roll=1');
            } else {
                $result = mysqli_query($data, "select `current_bet` from `game` where `game_id`='$gameId[0]'");
                if (!$result) {
                    $errFlag = 1;
                    echo mysqli_error($data);
                };
                $bet = mysqli_fetch_row($result)[0];
                $bet += $toss;
                echo 'Your current bet:' . $bet;
                $result = mysqli_query($data, "update `game` set `current_bet`='$bet' where `game_id`='$gameId[0]'");
                if (!$result) {
                    $errFlag = 1;
                    echo mysqli_error($data);
                };
            }
        } else {
            if ($userNumber == 1) {
                $result = mysqli_query($data, "select `current_bet` from `game` where `game_id`='$gameId[0]'");
                if (!$result) {
                    $errFlag = 1;
                    echo mysqli_error($data);
                };
                $bet = mysqli_fetch_row($result)[0];
                $score = $score + $bet;
                echo "score is" . $score;
                $result = mysqli_query($data, "update `game` set `player1_score`='$score',`current_bet`=0 where `game_id`='$gameId[0]'");
                if (!$result) {
                    $errFlag = 1;
                    echo mysqli_error($data);
                };
            } elseif ($userNumber == 2) {
                $result = mysqli_query($data, "select `current_bet` from `game` where `game_id`='$gameId[0]'");
                if (!$result) {
                    $errFlag = 1;
                    echo mysqli_error($data);
                };
                $bet = mysqli_fetch_row($result)[0];
                $score = $score + $bet;
                echo "score is" . $score;
                $result = mysqli_query($data, "update `game` set `player2_score`='$score',`current_bet`=0 where `game_id`='$gameId[0]'");
                if (!$result) {
                    $errFlag = 1;
                    echo mysqli_error($data);
                };
            }
            $result = mysqli_query($data, "update `game` set `game_status`='$anotherUser' where `game_id`='$gameId[0]'");
            if (!$result) {
                $errFlag = 1;
                echo mysqli_error($data);
            };
            header('HTTP/1.1 302 Redirect');
            header('/game.php');
        }
    }
}

}

if($errFlag){
    header('HTTP/1.1 302 Redirect');
    header('Location: game.php');
}
?>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6" style="margin-top: 0px;margin-left:0px">
<a href="turn.php?action=toss">Toss the dice!</a>
<a href="turn.php?action=stop">End your turn!</a>

</body>
</html>
