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

require("dblogon.php");

require("options.php");

?>
<html>
<!--       Copyright 2001       -->
<!--   twistd.org/planetarion   -->
<body bgcolor="black" text="white" link="white" vlink="white" alink="white">
<SCRIPT LANGUAGE="JavaScript"><!--
function a(p) { opener.document.form1.<?echo $var ?>.value=p; opener.focus(); self.close(); }
// --></SCRIPT>
<title><?echo $PA["name"]." ".$PA["version"]?></title>
<link rel="stylesheet" href="stylesheet.css">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache,must-revalidate">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT">
<b>Find planet:<form method="post"><input type="text" size="10" name="search">
<input type="hidden" name="var" value="<?echo $var?>"><input type="submit" value="Search"></form>
<?

$count = 0;
if ($search!="") {
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE nick LIKE '%$search%' ORDER BY nick",$db);
    echo("<table>");
    while($myrow=mysql_fetch_array($result))
    {
        if ($count<2) echo("<td><a href=\"javascript:a(".$myrow["id"].");\">".$myrow["nick"]."</a></td>");
        if ($count==2) echo("<td><a href=\"javascript:a(".$myrow["id"].");\">".$myrow["nick"]."</a></td><tr>");
        $count++;
        if ($count==3) $count = 0;
    }
    echo("</table>");
}

require("footer.php");

?>
