<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simple Steam Authentication</title>
    <style>
        body{
            text-align:center;
            color: rgba(255,255,255,0.65);
            background-color: #24292e;
            line-height: 2;
        }
        .container {
            width: 1170px;
            margin: 0 auto;
        }
        input {
            padding: 10px;
            width: 70%;
            margin: 0 auto;
        }
        span {
            background: #fff;
            color: black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Simple Steam Authentication</h1>
        <form action="" method="get">
            <input type="text" name="id" placeholder="Enter Your Steam ID">
        </form>
    </div>
    <br>
    <span>Person info :</span>
    <br>
    <?php
    # get steam id
    $id = $_GET['id'];
    # player profile    
    $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=A448F0F2C258268E1DF30681AD693CDB&steamids=$id";
    $json = file_get_contents($url);
    $data = json_decode($json,true);
    $user = $data['response']['players'];
    echo "<img src ='".$user[0]['avatarfull']."'>";
    echo '<br>'."Name : ";
    echo ($user[0]['personaname']);
    $status = ($user[0]['personastate']);
    echo '<br> Last Time Online : '.date("Y-m-d", $user[0]['lastlogoff']);
    echo '<br> Nick Name : '.($user[0]['personaname']);
    # switch status player
    switch ($status) {
        case 1:
            echo '<div style="background:dodgerblue;padding: 5px;">'."Online".'</div>';
            break;
        case 2:
            echo '<div style="background:red;padding: 5px;">'."Busy".'</div>';
            break;
        case 3:
            echo '<div style="background:cornflowerblue;padding: 5px;">'."Away".'</div>';
            break;
        case 4:
            echo '<div style="background:lightblue;padding: 5px;">'."Snooze".'</div>';
            break;
        case 5:
            echo "looking to trade";
            break;
        case 6:
            echo "looking to play";
            break;
        default:
            echo '<br>'."OFFLINE";
            break;
    }
    ?>
    <br>
    <span>3 Friend List :</span>
    <br>
    <?php
        $myurl= "http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=A448F0F2C258268E1DF30681AD693CDB&steamid=$id&relationship=friend";
        $jsonn = file_get_contents($myurl);
        $dataa = json_decode($jsonn,true);
        $userr = $dataa['friendslist']['friends'];
        echo 'Friend 1 : '.($userr[0]['steamid']);
        echo "<br>";
        echo 'Friend 2 : '.($userr[1]['steamid']);
        echo "<br>";
        echo 'Friend 3 : '.($userr[2]['steamid']);
    ?>
    <br>
    <span>Last Game Played :</span>
    <?php
        $urll="http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=A448F0F2C258268E1DF30681AD693CDB&steamid=$id&format=json";
        $jsonnn = file_get_contents($urll);
        $dataaa = json_decode($jsonnn,true);
        $userrr = $dataaa['response']['games'];
        echo "<br>" .'Game 1 : '.($userrr[0]['name']);
    ?>
    <br>
    <span>Last Match Number ID :</span>
    <?php
        $urlll="https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=A448F0F2C258268E1DF30681AD693CDB&steamid=$id&matches_requested=1";
        $jsonnnn = file_get_contents($urlll);
        $dataaaa = json_decode($jsonnnn,true);
        $userrrr = $dataaaa['result']['matches'];
        echo "<br>" .'Matches : '.($userrrr[0]['match_id']);
    ?>
</body>
</html>
