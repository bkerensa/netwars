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

if ($nick!="")
{
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE nick='$nick'",$db);
    if ($myrow = mysql_fetch_array($result)){
        mail($myrow["email"],$PA["name"]." - Password",
             $PA["name"]." ".$PA["version"].
             "\n\nPassword for $nick.\n".
             "Your password: ".$myrow["password"]
             ,"From: whappit@hotmail.com");
        echo "Password sent to $nick.";
    } else echo "Couldn't find $nick!";
}

else {
    ?>
    Type your nick below and you'll get your password e-mailed:<br><br>
<table>
<form method="post" action="<?php echo $PHP_SELF?>">
<td><font face="Arial" size="2"><b>Nick:</td><td><input type="Text" name="nick"><tr>
<td></td><td><input type="Submit" name="submit" value="Give me my password"><tr>
</form>
</table>
<?
}

require "footer.php";
?>
