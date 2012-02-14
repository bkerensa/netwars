<?php
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

echo
"
</a> Ticker isn't up<br><br>
<!--
-->Netwars is released under the GPLv3 License";?>
<!-- <img src="http://www.icq.com/scripts/online.dll?icq=126402433&img=5"> -->
<?


echo "<br><br>";

echo "<font size=\"1\">Game status:<br>";
if ($tickdif>60) echo "<font color=\"red\">$tickdif seconds since last tick.</font><br>";
else echo "$tickdif seconds since last tick.<br>";

if ($tablecookie!="")
{

    $result = mysql_query("SELECT id FROM ".$PA["table"],$db);

    $count = mysql_num_rows($result);

    $result = mysql_query("SELECT id FROM ".$PA["table"]." WHERE timer>".(time()-600),$db);

    $count2 = mysql_num_rows($result);

    echo("$count registered accounts.<br>$count2 online users.<br>Current time: ".strftime("%H:%M:%S",strtotime($PA["time"]." hours")));

    mysql_close ($db);
}

require "footer.php";
?>
