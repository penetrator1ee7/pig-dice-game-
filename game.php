<html>
<head>
    <meta charset =utf-8 http-equiv="Refresh" content="15">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<style>
    body {
        background-image: url(img.jpg);
        background-size: 100% auto;
    }
</style>
<title>Waiting Room</title>
<body>
<div class="container">
    <div class="row justify-content-center">
<div class="col-6" style="margin-top: 150px;margin-left:100px">
    <?php
    if(isset($_GET['roll'])){echo 'You rolled 1';}
    ?>
    <br>
</div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6" >
<?php
$errFlag=1;
setcookie('game',1,time()+60*5);
if(isset($_COOKIE['Cookie'])){

    $errFlag = 0;
    $data = mysqli_connect('localhost', "root", '', 'CV');
    if (!$data) {
        $errFlag = 1;
        header('HTTP/1.1 302 Redirect');
        header('Location: loginPage.php?alert=database'); // cannot connect to mysql database
    }

    $time = date('y/m/d H:i:s', time());
    $cookie=$_COOKIE['Cookie'];
    $result=mysqli_query($data,"select `user_id` from `tokens` where `auth_token`='$cookie'");
    $tmpId=mysqli_fetch_row($result);
    if($tmpId[0]){
        echo "You are authorised for game. \n";
    }else{
        header('HTTP/1.1 302 Redirect');
        header('Location: loginPage.php');
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
        header('HTTP/1.1 302 Redirect');
        header('Location: loginPage.php');
    }
//time update
    if(!$errFlag){
        $result = mysqli_query($data, "update `gameLobby` set `last_update`='$time' where `player_id`='$tmpId[0]'");
        if (!$result) {
            echo mysqli_error($data) . ' line 32';
            $errFlag = 1;
        }
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
    }elseif ($possiblePId[1]==$tmpId[0]) {
        $userNumber = 2;
    }
///afk protection
if($userNumber==1){
    $result=mysqli_query($data,"select `player2_id` from `game` where `game_id`='$gameId[0]'");
    if(!$result){$errFlag=1;echo mysqli_error($data);};
    $id2=mysqli_fetch_row($result);
    $result=mysqli_query($data,"select `last_update` from `gamelobby` where `player_id`='$id2[0]'");
    if(!$result){$errFlag=1;echo mysqli_error($data);};
    $user2update=mysqli_fetch_row($result);
    if(strtotime($user2update[0])+60+1.5<time()){
        $result=mysqli_query($data,"update `game` set `game_status`='w1',`game_ended_in`='$time' where `game_id`='$gameId[0]'");
        if(!$result){$errFlag=1;echo mysqli_error($data);};
    }
}else{
    $result=mysqli_query($data,"select `player1_id` from `game` where `game_id`='$gameId[0]'");
    if(!$result){$errFlag=1;echo mysqli_error($data);};
    $id1=mysqli_fetch_row($result);
    $result=mysqli_query($data,"select `last_update` from `gamelobby` where `player_id`='$id1[0]'");
    if(!$result){$errFlag=1;echo mysqli_error($data);};
    $user1update=mysqli_fetch_row($result);
    if(strtotime($user1update[0])+60+1.5<time()){
        $result=mysqli_query($data,"update `game` set `game_status`='w2',`game_ended_in`='$time' where `game_id`='$gameId[0]'");
        if(!$result){$errFlag=1;echo mysqli_error($data);};
    }
}
//the game itself
    $result=mysqli_query($data,"select `game_status` from `game` where `game_id`='$gameId[0]'");
    if (!$result) {
        echo mysqli_error($data) . ' line 32';
        $errFlag = 0;
    }
    $game_status=mysqli_fetch_row($result);
?>
    </div>
</div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6" >
<?php
if($game_status[0]=='t'.$userNumber){
    header('HTTP/1.1 302 Redirect');
    header('Location: turn.php');
}else{echo"Please wait until your opponent finishes his turn.";};
}


if($errFlag){
    header('HTTP/1.1 302 Redirect');
    header('Location: userPage.php?alert=errFlag');
}

?>

<br><br><br>
<?php
$result=mysqli_query($data,"select `player1_score`,`player2_score` from `game` where `game_id`='$gameId[0]'");
$stats=mysqli_fetch_row($result);
if($userNumber==1){
    echo '<br>'.'Your current score is :'.$stats[0].'<br>';
    echo 'Your opponent score is :'.$stats[1];
}
if($userNumber==2){
    echo '<br>'.'Your current score is :'.$stats[1].'<br>';
    echo 'Your opponent score is :'.$stats[0];
}
?>
        </div>
    </div>
</div>
</body>
</html>
