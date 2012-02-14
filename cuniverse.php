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

ob_start();

?>
<html>
<body bgcolor="black" text="white" link="white" vlink="white" alink="white">
<SCRIPT LANGUAGE="JavaScript"><!--
function a(p) { self.close(); }
// --></SCRIPT>
<title><?echo $PA["name"]." ".$PA["version"]?></title>
<link rel="stylesheet" href="stylesheet.css">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache,must-revalidate">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT">
<meta HTTP-EQUIV="Refresh" content="60">
<?

$result = mysql_query("SELECT * FROM pa_users ORDER BY rank");
echo("<table><td>Rank:</td><td>ID #:</td><td>Tag:</td><td>Nick:</td><td>Score:</td><td>Size:</td><tr>");

while($myrow = mysql_fetch_array($result))
{
    echo "<td>".$myrow["rank"].".</td><td>".$myrow["id"]."</td><td>".$myrow["tag"]."</td><td>".$myrow["nick"]."</td><td>".number_format($myrow["score"],0,".",".")."</td><td>".$myrow["size"]."</td><tr>\n";
}

echo("</table>");

$fp = fopen('temp.tmp','w');
fputs($fp,ob_get_contents());
fclose($fp);



?>
