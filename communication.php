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

if ($attack!="")
{
    $result = mysql_query("UPDATE ".$PA["table"]." SET war='$attack',wareta='35' WHERE id=$Userid",$db);
    header("Location: military.php");
    die;
}

if ($to!=""){
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$to'",$db);
    if (mysql_num_rows($result)!=1) {
        Header("Location: communication.php?msgred=No such planet!");
        die();
    }
}

if ($to>0 && $to!=$Userid)
{
    Add_news("Mail from $Username #$Userid",nl2br(strip_tags($text)."\n\n(<a href=\"communication.php?toid=$Userid\">Reply</a>)"),$to);
    Header("Location: communication.php?msggreen=Mail sent successfully!");
}

require "header.php";

?>
Communication:<br><br>
<?
echo "Send mail:<br>";
echo("<SCRIPT LANGUAGE=\"JavaScript\"><!--
function loginpopup()
{
loginwin = window.open('planets.php?var=to','loginwin','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=450,height=250,left=' + (window.screen.width-450)/2 + ',top=' + (window.screen.height-400)/2);
loginwin.focus();
}
//--></SCRIPT>");
echo "<table><td><form action=\"$PHP_SELF\" METHOD=\"POST\" name=\"form1\">To <font size=\"1\">(Planet ID #):<br><A href=\"javascript:loginpopup();\">Find</font></td><td><input type=\"text\" name=\"to\" size=\"7\" value=\"$toid\">\n";

echo "</td><tr><td>Text:</td><td><textarea name=\"text\" cols=\"40\" rows=\"5\"></text";
echo "area><br><input type=\"Submit\" value=\"Send\"></form></table>";



require "footer.php";
?>
