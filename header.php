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

if ($Username!=""){
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE nick='$Username' AND password='$Password' AND closed=0",$db);
    if (mysql_num_rows($result)==1) {  }
    else
    {
        Setcookie("Username","");
        Setcookie("Password","");
        Setcookie("Userid","");
        Setcookie("Access","");
        $Username = "";
        $Userid = "";
        $Access = "";
        Header("Location: index.php");
        die();
    }
}
?>
<html>
<!--       Copyright 2001       -->
<!--   WASSINK   -->
<body bgcolor="black" text="white" link="white" vlink="white" alink="white">
<title>Wassink PA</title>
<link rel="stylesheet" href="stylesheet.css">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache,must-revalidate">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT">
<table width="700" border="0" bordercolor="white">
<td>
<font face="Verdana"><b>
<center><table bgcolor="#1230" width="700">
<td valign="up"><font size="2">
<a href="about.php">About</a>
<a href="index.php">Main</a>
<a href="http://www.ewsnl.com/~wassink/portal/forum.php" target="_BlANK">Forum</a>
<? if ($Username=="")
{
    echo("<a href=\"login.php\">Login</a> ");
    echo("<a href=\"registrer.php\">Signup</a> ");
}
else {
    echo("<a href=\"logout.php\">Logout</a> ");
    echo("<a href=\"endre.php\">Preferences</a> ");

    $result = mysql_query("SELECT * FROM ".$PA["newstable"]." WHERE id=$Userid AND seen='false'",$db);
    if ($myrow = mysql_fetch_array($result))
    {
        echo "<a href=\"news.php\"><b>NEWS</b></a> ";
    } else
    {
        echo "<a href=\"news.php\">News</a> ";
    }

    echo("<a href=\"universe.php\">Universe</a> ");
    echo("<a href=\"resources.php\">Resources</a> ");
    echo("<br><br>");
    echo("<a href=\"communication.php\">Communication</a> ");
    echo("<a href=\"construct.php\">Construction</a> ");
    echo("<a href=\"production.php\">Production</a> ");
    echo("<a href=\"research.php\">Research</a> ");
    echo("<a href=\"waves.php\">Waves</a> ");
    echo("<a href=\"military.php\">Military</a> ");
    echo("<br>Crystal: ".number_format($crystal,0,".",".")." Metal: ".number_format($metal,0,".",".")." Score: ".number_format($score,0,".",".")." Rank: #$rank");
}

?>

</td>
<td valign="up" align="right" width="150"><font size="1">
<?
#  Showing the time for last tick:
echo("Last tick: ".strftime("%H:%M:%S",$ticktime));

#  MySQL query to find the current leader. This query can be
#  removed to optimize amount of queries. For instance, the ticker
#  can output the current leader to a text-file.
$result = mysql_query("SELECT nick FROM ".$PA["table"]." ORDER BY score DESC LIMIT 0,1",$db);
$myrow = mysql_fetch_array($result);
if ($HTTP_COOKIE_VARS["Username"]!="")
{
    echo("<br><br>Logged in:<br>$Username - #$Userid");
    echo("<br><br>Current leader:<br>".$myrow["nick"]);
}
?>
</font></td>
</table>

<?
if ($HTTP_COOKIE_VARS["Username"]!=""){
    echo("<center><br><font color=\"green\" size=\"1\"><u>Message of the day:</u><br>$motd</font></center>");
}
?>
</center>
<font face="Arial" size="2"><b>
<?
if ($Username!="")
{
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE war=$Userid",$db);
    if ($myrow = mysql_fetch_array($result))
    {
        do {
            if( $myrow["wareta"]>=5) echo "<font color=\"red\">Hostile incoming fleet: ".$myrow["nick"]." #".$myrow["id"]." (ETA: ".($myrow["wareta"]-5).")</font><br>";
            else echo "<font color=\"red\">Hostile incoming fleet: ".$myrow["nick"]." #".$myrow["id"]." (ETA: 0)</font><br>";
        } while ($myrow = mysql_fetch_array($result));
    }

    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE def=$Userid",$db);
    if ($myrow = mysql_fetch_array($result))
    {
        do {
            if ($myrow["wareta"]>=10) echo "<font color=\"green\">Friendly incoming fleet: ".$myrow["nick"]." #".$myrow["id"]." (ETA: ".($myrow["wareta"]-10).")</font><br>";
            else echo "<font color=\"green\">Friendly incoming fleet: ".$myrow["nick"]." #".$myrow["id"]." (ETA: 0)</font><br>";
        } while ($myrow = mysql_fetch_array($result));
    }

    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id=$Userid",$db);
    $myrow = mysql_fetch_array($result);

}
echo "<br>\n";
if ($msgred!="") {echo "<font color=\"red\">$msgred</font><br><br>\n";}
if ($msggreen!="") {echo "<font color=\"green\">$msggreen</font><br><br>\n";}
?>
