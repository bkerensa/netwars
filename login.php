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

if ($submit)
{
    $loggedin = "false";
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE nick='$nick' AND password='$pw'",$db);
    $myrow = mysql_fetch_array($result);
    if ($myrow['closed']==1) { require "header.php"; die("Your account is closed, probably due to multi-playing. Contact planetarion@twistd.org if you believe your account was closed in error."); }

    if (mysql_num_rows($result)>=1){
        $Userid = $myrow["id"];
        Logging("login","$nick");
        setcookie("Username",$nick);
        setcookie("Password",$pw);
        setcookie("Userid",$myrow["id"]);
        setcookie("Access",$myrow["access"]);
        $loggedin = "true";
    }
    else setcookie("Username","");
    if ($loggedin=="true") Header("Location: index.php");
    else Header("Location: index.php?msgred=Wrong+login+or+password!");
    die;
}
require "header.php";

if (!$submit) {
    ?>
    <table>
    <form method="post" action="<?php echo $PHP_SELF?>">
    <td><font face="Arial" size="2"><b>Login:</td><td><input type="Text" name="nick"><tr>
    <td><font face="Arial" size="2"><b>Password:</td><td><input type="Password" name="pw"><tr>
    <td></td><td><input type="Submit" name="submit" value="Login"><tr>
    </form>
    </table>
    <font size="1"><a href="sendpass.php">Lost your password?</a>
    <?
}

require "footer.php";
?>
