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
require "dblogon.php";

require "options.php";

$r_uscan = $myrow['r_uscan'];

function calcres($number)
{
    global $roids;
    srand ((double) microtime() * 1000000);
    $retval = 0;
    $a = 0;
    if ($a!=$number)
    {
        do
        {
            $a++;
            $tmp = rand(0,1+($roids+$retval));
            if ($tmp<20) $retval++;
        }while($a<$number);
    }
    return $retval;
}

if ($waves>0 && $crystal>=$waves*500)
{
    $found = calcres($waves);
    $cost = $waves*500;
    $result = mysql_query("UPDATE ".$PA["table"]." SET crystal=crystal-$cost,ui_roids=ui_roids+$found WHERE id=$Userid AND crystal>=$cost",$db);
    Header("Location: waves.php?msggreen=You found $found asteroids");
    die();
}

if ($waves>0 && $crystal<$waves*500)
{
    Header("Location: waves.php?msgred=You dont have enough crystal!");
    die();
}

if ($sector!=""){
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$sector'",$db);
    if (mysql_num_rows($result)!=1) {
        Header("Location: waves.php?msgred=No such planet!");
        die();
    }
}

if ($sector>0 && $crystal<1000)
{
    Header("Location: waves.php?msgred=Not enough crystal!");
    die();
}
if ($unit>0 && $crystal<1500)
{
    Header("Location: waves.php?msgred=Not enough crystal!");
    die();
}

require "header.php";

if ($sector>0 && $crystal>=1000 && $sector!=$Userid && $sector!="")
{
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$sector'",$db);
    $myrow = mysql_fetch_array($result);

    echo $myrow["nick"]." #".$myrow["id"]."<br>";
    echo "Score: ".$myrow["score"]."<br>";
    echo "Units: ".($myrow["infinitys"]+$myrow["wraiths"]+$myrow["warfrigs"]+$myrow["destroyers"]+$myrow["cobras"]+$myrow["scorpions"])."<br>";
    echo "Metal roids: ".$myrow["asteroid_metal"]."<br>";
    echo "Crystal roids: ".$myrow["asteroid_crystal"]."<br>";
    echo "Uninitiated: ".$myrow["ui_roids"]."<br><br><br>";
    $result = mysql_query("UPDATE ".$PA["table"]." SET crystal=crystal-1000 WHERE id='$Userid'",$db);
    $crystal-=1000;
}

if ($r_uscan==1 && $unit>0 && $crystal>=1500 && $unit!=$Userid && $unit!="")
{
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$unit'",$db);
    $myrow = mysql_fetch_array($result);

    echo $myrow["nick"]." #".$myrow["id"]."<br>";
    echo "<table><td>Infinitys:</td><td>".$myrow["infinitys"]."</td><tr>";
    echo "<td>Wraiths:</td><td>".$myrow["wraiths"]."</td><tr>";
    echo "<td>Warfrigs:</td><td>".$myrow["warfrigs"]."</td><tr>";
    echo "<td>Destroyers:</td><td>".$myrow["destroyers"]."</td><tr>";
    echo "<td>Cobras:</td><td>".$myrow["cobras"]."</td><tr>";
    echo "<td>Astropods:</td><td>".$myrow["astropods"]."</td><tr>";
    echo "<td>Scorpions:</td><td>".$myrow["scorpions"]."</td></table><br><br>";
    $result = mysql_query("UPDATE ".$PA["table"]." SET crystal=crystal-1500 WHERE id='$Userid'",$db);
    $crystal-=1500;
}

echo("<SCRIPT LANGUAGE=\"JavaScript\"><!--
function loginpopup()
{
loginwin = window.open('planets.php?var=sector','loginwin','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=450,height=250,left=' + (window.screen.width-450)/2 + ',top=' + (window.screen.height-400)/2);
loginwin.focus();
}
//--></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\"><!--
function loginpopup2()
{
loginwin = window.open('planets.php?var=unit','loginwin','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=450,height=250,left=' + (window.screen.width-450)/2 + ',top=' + (window.screen.height-400)/2);
loginwin.focus();
}
//--></SCRIPT>");

?>
Waves:<br><br>
<form action="<?echo $PHP_SELF?>" METHOD="POST">
Asteroid waves(500 crystal):<br>
<table>
<td>
<input type="text" name="waves" value="<?echo floor($crystal / 500);?>" size="3"><br>
</td><tr>
<td>
<input type="Submit" value="Search">
</td><tr></table>
</form>
<form action="<?echo $PHP_SELF?>" METHOD="POST" name="form1">
<?
echo "Sector scan(1000 crystal):<br>";
echo "<table><td><font size=\"1\">Planet ID #:<br><A href=\"javascript:loginpopup();\">Find</font></td><tr>";
echo "<td><input type=\"text\" name=\"sector\" size=\"7\"><tr><td><input type=\"Submit\" value=\"Scan\"></td></table>";

if ($r_uscan==1){
    echo "<br>Unit scan(1500 crystal):<br>";
    echo "<table><td><font size=\"1\">Planet ID #:<br><A href=\"javascript:loginpopup2();\">Find</font></td><tr>";
    echo "<td><input type=\"text\" name=\"unit\" size=\"7\"><tr><td><input type=\"Submit\" value=\"Scan\"></td></form></table>";
}

require "footer.php";
?>
