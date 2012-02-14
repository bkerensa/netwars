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

$ships = $myrow["infinitys"]+$myrow["wraiths"]+$myrow["warfrigs"]+$myrow["destroyers"]+$myrow["cobras"]+$myrow["scorpions"];

if ($attack>-2 && $attack!=$Userid && $attack!="" && $ships>0)
{
    if ($attack>=0){
        $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$attack'",$db);
        if (mysql_num_rows($result)!=1) {
            header("Location: military.php?msgred=No such planet!");
            die;
        }
        $mr = mysql_fetch_array($result);
        if ($mr["score"]<$score / 7) { Header("Location: military.php?msgred=The planet is out of your range!"); die(); }
    }

    if ($attack>0 && $myrow["war"]==0) { Add_news("Incoming hostile fleet","$Username #$Userid is attacking you, ETA 30 mins.",$attack); $result = mysql_query("UPDATE ".$PA["table"]." SET war='$attack',wareta='35' WHERE id=$Userid",$db); }
    if ($attack<0 && $myrow["war"]>0)
    {
        Add_news("Recall","$Username #$Userid recalled his fleet.",$myrow["war"]);
        if ($wareta>=6) $result = mysql_query("UPDATE ".$PA["table"]." SET war='-1',wareta=35-wareta WHERE id=$Userid",$db);
        else $result = mysql_query("UPDATE ".$PA["table"]." SET war='-1',wareta='30' WHERE id=$Userid",$db);
    }
    header("Location: military.php");
    die;
}

if ($defend>-2 && $defend!=$Userid && $defend!="" && $ships>0)
{
    if ($defend>=0){
        $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$defend'",$db);
        if (mysql_num_rows($result)!=1) {
            header("Location: military.php?msgred=No such planet!");
            die;
        }
        $mr = mysql_fetch_array($result);
        if ($mr["score"]<$score / 7) { Header("Location: military.php?msgred=The planet is out of your range!"); die(); }
    }

    if ($defend>0 && $myrow["war"]==0 && $myrow["def"]==0) { Add_news("Incoming friendly fleet","$Username #$Userid is defending you, ETA 20 mins.",$defend); $result = mysql_query("UPDATE ".$PA["table"]." SET def='$defend',wareta='30' WHERE id=$Userid",$db); }

    if ($defend<0 && $myrow["def"]>0)
    {
        Add_news("Recall","$Username #$Userid recalled his fleet.",$myrow["def"]);
        if ($wareta>=10) $result = mysql_query("UPDATE ".$PA["table"]." SET war='-1',wareta='".(30-$wareta)."',def=0 WHERE id=$Userid",$db);
        else $result = mysql_query("UPDATE ".$PA["table"]." SET war='-1',wareta='20',def=0 WHERE id=$Userid",$db);
    }

    header("Location: military.php");
    die;
}

require "header.php";

?>
Military:<br><br>
<?
$result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE war=$Userid",$db);
if ($myrow = mysql_fetch_array($result))
{
    echo "<font color=\"red\">Hostile incoming fleets:<br>";
    do {
        echo $myrow["nick"]." #".$myrow["id"]." (ETA: ".($myrow["wareta"]-5).")<br>";
    } while ($myrow = mysql_fetch_array($result));
    echo "</font><br><br>";
}

$result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE def=$Userid",$db);
if ($myrow = mysql_fetch_array($result))
{
    echo "<font color=\"green\">Friendly incoming fleets:<br>";
    do {
        echo $myrow["nick"]." #".$myrow["id"]." (ETA: ".($myrow["wareta"]-10).")<br>";
    } while ($myrow = mysql_fetch_array($result));
    echo "</font><br><br>";
}



if ($war<0) echo "Returning... (ETA: ".($wareta).")<br>";

if ($war>0) {
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$war'",$db);
    $myrow = mysql_fetch_array($result);
    $warname = $myrow["nick"];
}

if ($def>0) {
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$def'",$db);
    $myrow = mysql_fetch_array($result);
    $defname = $myrow["nick"];
}

if ($wareta>=5 && $war>0) echo "Attacking $warname #$war... (ETA: ".($wareta-5).")<br>";
if ($wareta<5 && $war>0) echo "Attacking $warname #$war... (ETA: 0)<br>";

if ($wareta>=11 && $def>0) echo "Defending $defname #$def... (ETA: ".($wareta-10).")<br>";
if ($wareta<11 && $def>0) echo "Defending $defname #$def... (ETA: 0)<br>";

if ($war>0) echo("<form action=\"$PHP_SELF\" METHOD=\"POST\"><input type=\"hidden\" name=\"attack\" value=\"-1\"><input type=\"submit\" value=\"Retreat\"></form>");
if ($def>0) echo("<form action=\"$PHP_SELF\" METHOD=\"POST\"><input type=\"hidden\" name=\"defend\" value=\"-1\"><input type=\"submit\" value=\"Retreat\"></form>");

if ($war==0 && $def==0)
{

    echo("<SCRIPT LANGUAGE=\"JavaScript\"><!--
function loginpopup()
{
loginwin = window.open('planets.php?var=attack','loginwin','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=450,height=250,left=' + (window.screen.width-450)/2 + ',top=' + (window.screen.height-400)/2);
loginwin.focus();
}
//--></SCRIPT>

<SCRIPT LANGUAGE=\"JavaScript\"><!--
function loginpopup2()
{
loginwin = window.open('planets.php?var=defend','loginwin','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=450,height=250,left=' + (window.screen.width-450)/2 + ',top=' + (window.screen.height-400)/2);
loginwin.focus();
}
//--></SCRIPT>");


    echo "Launch attack <font size=\"1\">(ETA 30, will attack for 5 ticks)</font>:<br><table><td><font size=\"1\">Planet ID #:<br><A href=\"javascript:loginpopup();\">Find</font></td><tr>";

    echo "<form action=\"$PHP_SELF\" METHOD=\"POST\"  name=\"form1\">";

    echo "<td><input type=\"text\" name=\"attack\" size=\"7\"><tr><td><input type=\"Submit\" value=\"Attack\"></td></table>";

    echo "Defend <font size=\"1\">(ETA 20, will defend for 10 ticks)</font>:<br><table><td><font size=\"1\">Planet ID #:<br><A href=\"javascript:loginpopup2();\">Find</font></td><tr>";


    echo "<td><input type=\"text\" name=\"defend\" size=\"7\"><tr><td><input type=\"Submit\" value=\"Defend\"></td></form></table>";
}


require "footer.php";
?>
