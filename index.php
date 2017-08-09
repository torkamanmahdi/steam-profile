<center>
<form action="" method="get">
    <input type="text" name="id" placeholder="Enter Your Steam ID">
    <input type="submit" value="submit">
</form>
<?php
# get steam id
$id = $_GET['id'];
# player profile
$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=F2284CA26A84165A514B872C0CD862F8&steamids=$id";
$json = file_get_contents($url);
$data = json_decode($json,true);
$user = $data['response']['players'];
echo "<img src ='".$user[0]['avatarfull']."'>";
echo '<br>'."Name : ";
echo ($user[0]['realname']);
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
</center>
