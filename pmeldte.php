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

$result = mysql_query("SELECT * FROM ".$PA["table"]." ORDER BY nick",$db);

if ($myrow = mysql_fetch_array($result)) {
    echo "<u>Underlined</u> - User is online<table><td></td><td><b>Nick:</td><tr>";
    $count = 0;
    do {
        $count++;
        if (time()-$myrow["timer"]<600) echo "<td><font face=\"Arial\" size=\"2\"><b>$count.</td><td><b><font face=\"Arial\" size=\"2\"><u>".$myrow["nick"]."</u></td>";
        else echo "<td><font face=\"Arial\" size=\"2\"><b>$count.</td><td><b><font face=\"Arial\" size=\"2\">".$myrow["nick"]."</td>";
        /*    if ($myrow["access"]>=10) echo "<td><a href=\"chuser.php?id=".$myrow["id"]."\">>Deltaker</a></td>";
           if ($myrow["access"]<=9) echo "<td><a href=\"chadmin.php?id=".$myrow["id"]."\">>Admin</a></td>";
           echo "<td><a href=\"endre.php?Adminuserid=".$myrow["id"]."\">Endre</a></td>"; */
        echo "<tr>";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
}

else echo("No accounts found!");

require "footer.php";
?>
