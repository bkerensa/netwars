<?
################################################################################
##                     Netwars v0.2 Beta
##    Netwars is a Browser/Tick Based Space Strategy game
##      inspired by the game Empirequest and made possible 
##      through forking the original code of Deto PA.
##          Developed by:
##          KhalessTheGreat (Matthew Rodley)   
##          Nova            (Benjamin Kerensa)
##
## Netwars is free software: you can redistribute it and/or modify
##    it under the terms of the GNU General Public License as published by
##    the Free Software Foundation, either version 3 of the License, or
##    (at your option) any later version.
##
##    Netwars is distributed in the hope that it will be useful,
##    but WITHOUT ANY WARRANTY; without even the implied warranty of
##    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
##    GNU General Public License for more details.
##
##    You should have received a copy of the GNU General Public License
##    along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
##
################################################################################
$PA["name"] = "WPA";
$PA["party"] = "Wassink Test";
$PA["version"] = "0.1";
$PA["image"] = "pp.jpg";
$PA["plassres"] = "true";
$PA["table"] = "pa_users";
$PA["time"] = "+0";
$PA["newstable"] = "pa_news";
$tablecookie = "pa_users";

# $mode can be either "inet" or "LAN"
# NB! This currently only works with the user registration(not tags)
$mode = "inet";
$motd = 'Welkom bij de enige echte Website van dedicated PA-clone creator Hans Wassink.*';


$fp = fopen("ticker.dat","r");
$ticktime = fread($fp,100);
fclose($fp);

if ($Username!="")
{
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id=$Userid",$db);
    if ($myrow = mysql_fetch_array($result))
    {
        $metal = $myrow["metal"];
        $crystal = $myrow["crystal"];
        $score = $myrow["score"];
        $war = $myrow["war"];
        $wareta = $myrow["wareta"];
        $def = $myrow["def"];
        $defeta = $myrow["defeta"];
        $crystalroid = $myrow["asteroid_crystal"];
        $metalroid = $myrow["asteroid_metal"];
        $ui_roids = $myrow["ui_roids"];
        $roids = $crystalroid + $metalroid + $ui_roids;
        $i_roids = $crystalroid + $metalroid;
        $rank = $myrow["rank"];

        $planetcrystal = 0;
        $planetmetal = 0;
        if ($myrow["c_crystal"]==1 && $myrow["r_imcrystal"]!=1) $planetcrystal = 25;
        if ($myrow["c_crystal"]==1 && $myrow["r_imcrystal"]==1) $planetcrystal = 45;
        if ($myrow["c_metal"]==1 && $myrow["r_immetal"]!=1) $planetmetal = 15;
        if ($myrow["c_metal"]==1 && $myrow["r_immetal"]==1) $planetmetal = 33;
        $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id=$Userid",$db);
        $vars = mysql_fetch_array($result);
    }
    $tmp = time();
    $result2 = mysql_query("UPDATE ".$PA["table"]." SET timer='$tmp' WHERE id=$Userid",$db);
}

Function Logging($filename,$string)
{

    global $PA,$REMOTE_ADDR,$Username,$Userid,$db;
#$fp = fopen("logging/$filename.txt","a");
#fputs($fp,strftime("%d/%m-20%y %H:%M:%S",strtotime($PA["time"]." hours"))." - $REMOTE_ADDR\n$Username\n$string\n--------------\n");
#fclose($fp);
#mysql_query("INSERT INTO pa_logging (to,author,text,stamp) VALUES ('$')",$db);
    mysql_query("INSERT INTO pa_logging (toid,type,author,text,stamp,ip) VALUES ('$Userid','$filename','$Userid','$string','".strtotime($PA["time"]." hours")."','$REMOTE_ADDR')",$db);
}

Function Add_news ($header,$txt,$user)
{
    global $db,$PA,$Userid;
    $result = mysql_query("SELECT nick FROM ".$PA["table"]." WHERE id='$user'",$db);

    $myrow = mysql_fetch_array($result);
    $nick = $myrow["nick"];

#Logging("news","ID:$user - $nick\n$header\n$txt");
    $result3 = mysql_query("INSERT INTO ".$PA["newstable"]." (id,header,news,seen,time) VALUES ('$user','$header','$txt','false','".strtotime($PA["time"]." hours")."')",$db);
    mysql_query("INSERT INTO pa_logging (toid,type,author,text,stamp,subject) VALUES ('$user','news','$Userid','$txt','".strtotime($PA["time"]." hours")."','$header')",$db);
}


Function Attack ($varname,$amount)
{
    global $$varname,$salvagec,$salvagem;
    srand(time());
    $tmp = $$varname;
    $tmp2 = 0;
    $$varname -= floor($amount);
    if ($$varname>=0) $tmp2 = $amount; else $tmp2 = $tmp;
    if ($$varname<0) $$varname = 0;

    if ($varname=="infinitys" && $tmp2>0) {
        $salvagec += $tmp2 * 30 + rand(1,10);
    }
    if ($varname=="wraiths" && $tmp2>0) {
        $salvagec += $tmp2 * 50 + rand(1,10);
        $salvagem += $tmp2 * 50 + rand(1,20);
    }
    if ($varname=="warfrigs" && $tmp2>0) {
        $salvagec += $tmp2 * 300 + rand(1,50);
        $salvagem += $tmp2 * 250 + rand(1,50);
    }
    if ($varname=="astropods" && $tmp2>0) {
        $salvagec += $tmp2 * 250 + rand(1,50);
        $salvagem += $tmp2 * 250 + rand(1,50);
    }
    if ($varname=="cobras" && $tmp2>0) {
        $salvagec += $tmp2 * 300 + rand(1,50);
        $salvagem += $tmp2 * 250 + rand(1,50);
    }
    if ($varname=="scorpions" && $tmp2>0) {
        $salvagec += $tmp2 * 300 + rand(1,50);
        $salvagem += $tmp2 * 250 + rand(1,50);
    }

    //  echo "\$<b>$varname</b> endres fra <b>$tmp</b> til <b>".$$varname."</b> $amount<br>";
}

Function Production_Entry ($name, $description,$eta,$stock,$button)
{
    echo "<td><font face=\"Arial\" size=\"2\"><b>$name</td><td><font face=\"Arial\" size=\"2\"><b>$description</td><td><font face=\"Arial\" size=\"2\"><b>$eta</td>
<td><font face=\"Arial\" size=\"2\"><b>$stock</td><td><font face=\"Arial\" size=\"2\"><b>$button</td><td><font face=\"Arial\" size=\"2\"><b></td>";
    $args = func_num_args();
    if ($args>=6)
    {
        $arg5 = func_get_arg(5);
        echo "<td><font face=\"Arial\" size=\"2\"><b>$arg5</td>";
    }
    echo "<tr>\n";
}


Function DateDiff ($interval, $date1,$date2) {

    // get the number of seconds between the two dates
    $timedifference =  $date2 - $date1;

    switch ($interval) {
    case "w":
        $retval  = bcdiv($timedifference ,604800);
        break;
    case "d":
        $retval  = bcdiv( $timedifference,86400);
        break;
    case "h":
        $retval = bcdiv ($timedifference,3600);
        break;
    case "n":
        $retval  = bcdiv( $timedifference,60);
        break;
    case "s":
        $retval  = $timedifference;
        break;

    }
    return $retval;

}

function DateAdd ($interval,  $number, $date) {

    $date_time_array  = getdate($date);

    $hours =  $date_time_array["hours"];
    $minutes =  $date_time_array["minutes"];
    $seconds =  $date_time_array["seconds"];
    $month =  $date_time_array["mon"];
    $day =  $date_time_array["mday"];
    $year =  $date_time_array["year"];

    switch ($interval) {

    case "yyyy":
        $year +=$number;
        break;
    case "q":
        $year +=($number*3);
        break;
    case "m":
        $month +=$number;
        break;
    case "y":
    case "d":
    case "w":
        $day+=$number;
        break;
    case "ww":
        $day+=($number*7);
        break;
    case "h":
        $hours+=$number;
        break;
    case "n":
        $minutes+=$number;
        break;
    case "s":
        $seconds+=$number;
        break;

    }
    $timestamp =  mktime($hours ,$minutes, $seconds,$month ,$day, $year);
    return $timestamp;
}

$tickdif = DateDiff ("s",$ticktime,time());

if ($Userid!="")
{
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id=$Userid",$db);
    $myrow = mysql_fetch_array($result);
}
?>
