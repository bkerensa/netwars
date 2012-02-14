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

if ($QUERY_STRING=="deleteall")
{
    $result = mysql_query("DELETE FROM ".$PA["newstable"]." WHERE id=$Userid",$db);
    Header("Location: news.php");
    die();
}
if ($deletet!="")
{
    $result = mysql_query("DELETE FROM ".$PA["newstable"]." WHERE id=$Userid AND time=$deletet",$db);
    Header("Location: news.php");
    die();
}

$result = mysql_query("UPDATE ".$PA["newstable"]." SET seen='true' WHERE id=$Userid",$db);

require "header.php";

$result = mysql_query("SELECT * FROM ".$PA["newstable"]." WHERE id=$Userid ORDER BY time DESC LIMIT 0,10",$db);

if ($myrow = mysql_fetch_array($result)) {
    echo "<table>";
    $count = 0;
    do {
        $count++;
        echo "<td><b>[".strftime("%d/%m-20%y %H:%M:%S",$myrow["time"])."]</font> ".$myrow["header"]."</b> (<a href=\"news.php?deletet=".$myrow["time"]."\">Delete</a>)</td><tr>\n";
        echo "<td>".$myrow["news"]."</td><tr>\n";
        echo "<tr>";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table><a href=\"$PHP_SELF?deleteall\">Delete all news</a>";
}

else echo("No news!");

require "footer.php";
?>
