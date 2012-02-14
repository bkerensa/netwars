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

require "header.php";

?>
<SCRIPT LANGUAGE="JavaScript"><!--
function universepopup()
{
    loginwin = window.open('http://www.ewsnl.com/~wassink/index.php','loginwin','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=430,height=520,left=' + (window.screen.width-450)/2 + ',top=' + (window.screen.height-550)/2);
    loginwin.focus();
}
//--></SCRIPT>
<?

echo("<!-- See the <a href=\"javascript:universepopup();\">complete universe</a>. Join #deto @ irc.planetarion.com and '/msg Deto|TB !help' to get access to the official Target Bot. -->");

$a1 = 0;
$a = 0;
/*
   if ($from=="") $a = 0; else $a = $from;

   $a1 = $a;
   */

if ($a==0) $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE rank>0 ORDER BY rank ASC LIMIT ".($a).",99",$db);
else $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE rank>0 ORDER BY rank ASC LIMIT ".($a-1).",100",$db);
$result2 = mysql_query("SELECT id FROM ".$PA["table"]." WHERE rank>0 ORDER BY rank ASC",$db);

echo("<!-- ".($a+100)."  -->");

$nr = mysql_num_rows($result2);

/*
   $i = 0;
   echo("<font size=\"1\">");
   while($i<$nr) {
   echo("<a href=\"universe.php?from=$i\">$i - ".($i+99)."</a> ");
   $i += 100;
   }
   */

echo("</font>");
if ($myrow = mysql_fetch_array($result)) {

#echo "<br><br><u>Underlined</u> - User is online";
    echo "<table><td><b>Rank:</td><td><b>ID #:</td><td><b>Tag:</td><td><b>Nick:</td><td><b>Score:</td><td><b>Size:</td><tr>";#<td><b>Last seen:</td><tr>";
$count = $a1;
if ($count>0)$count--;
do {
    $myrow["tag"] = strip_tags($myrow["tag"]);
    $count++;
    /*if (time()-$myrow["timer"]<600) echo "<td><font face=\"Arial\" size=\"2\"><b>$count.</td><td><font face=\"Arial\" size=\"2\"><b>".$myrow["id"]."</td><td><font face=\"Arial\" size=\"2\"><b>".$myrow["tag"]."</td><td><b><font face=\"Arial\" size=\"2\"><u>".$myrow["nick"]."</u></td><td><b><font face=\"Arial\" size=\"2\">".number_format($myrow["score"],0,".",".")."</td><td><b><font face=\"Arial\" size=\"2\">".$myrow["size"]."</td>\n";
    else */echo "<td><font face=\"Arial\" size=\"2\"><b>".$myrow["rank"].".</td><td><font face=\"Arial\" size=\"2\"><b>".$myrow["id"]."</td><td><font face=\"Arial\" size=\"2\"><b>".$myrow["tag"]."</td><td><b><font face=\"Arial\" size=\"2\">".$myrow["nick"]."</td><td><b><font face=\"Arial\" size=\"2\">".number_format($myrow["score"],0,".",".")."</td><td><b><font face=\"Arial\" size=\"2\">".$myrow["size"]."</td>\n";
    echo "<tr>";
} while ($myrow = mysql_fetch_array($result));
echo "</table>";
}

else echo("<br><br>No accounts found!");

require "footer.php";
?>
