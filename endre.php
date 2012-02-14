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

if ($createtag!="") {
    $r = mysql_query("SELECT * FROM pa_tags WHERE tag='$createtag'");
    if (mysql_num_rows($r)==0) {
        $garbage = "tag".substr(md5(time()),0,7);
        mysql_query("INSERT INTO pa_tags (tag,password) VALUES ('$createtag','$garbage')");
        mail($myrow["email"],$PA["name"]." - Tag",$PA["name"]." tag: $createtag\nPassword: $garbage\n\n-".$PA["name"]." crew\nhttp://www.ewsnl.com/~wassink/pa/","From: j.wassink@student.unimaas.nl");
        Header("Location: endre.php?msggreen=Tag created. Password is sent by e-mail.");
        Logging("tag","$Username created tag: $createtag");
        die();
    }
}
if ($selecttag!="") {
    $r = mysql_query("SELECT * FROM pa_tags WHERE password='$selecttag'");
    if (mysql_num_rows($r)==1) {
        $mr = mysql_fetch_array($r);
        mysql_query("UPDATE ".$PA["table"]." SET tag='".$mr["tag"]."' WHERE id=$Userid");
        Header("Location: endre.php?msggreen=Tag selected.");
        die();
    }
}

if ($Access>=10 && $Adminuserid!="") $Userid=$Adminuserid;

if ($Username=="")
    die("<br>Not logged in!<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">");

if ($endreperson=="True"){
    $sql = "UPDATE ".$PA["table"]." SET city='$bosted',phone='$tlf',password='$passord' WHERE id=$Userid;";

    $result = mysql_query($sql,$db);

    setcookie("Password",$passord);
    $Password = $passord;
}

require "header.php";

echo "Preferences:<br>\n";
$result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id=$Userid",$db);

if ($myrow = mysql_fetch_array($result))
{
    ?>
    <table>
    <form method="post" action="<?php echo $PHP_SELF?>">
    <td><font face="Arial" size="2"><b>City:</td><td><input type="Text" name="bosted" value="<?echo $myrow["city"]?>" size="28"><tr>
    <td><font face="Arial" size="2"><b>Phone:</td><td><input type="Text" name="tlf" value="<?echo $myrow["phone"]?>" size="28"><tr>
    <td><font face="Arial" size="2"><b>Password:</td><td><input type="Password" name="passord" value="<?echo $myrow["password"]?>" size="28"><tr>
    <td><font face="Arial" size="2"><b>Tag:</td><td><font face="Arial" size="2"><b><?echo $myrow["tag"]?><tr>
    <td></td><td><input type="Submit" name="submit" value="Change information"><tr>
    <input type="hidden" name="endreperson" value="True">
    <input type="hidden" name="Adminuserid" value="<? echo $Adminuserid?>">
    </form><tr>
    <td></td><tr><tr><tr><tr height="70">
    <td></td><td>
    <form method="post" action="slettbruker.php">
    <input type="Submit" name="submit" value="Delete my account!">
    </form>
    </table>
    <br><br>
    <table>
    <td><font face="Arial" size="2"><b>Select tag:</td><td><form method="post"><input type="text" size="10" name="selecttag" value="password"><input type="submit" value="Do it"></td><tr>
    </form><tr><tr>
    <td><font face="Arial" size="2"><b>Create tag:</td><td><form method="post"><input type="text" size="10" name="createtag" value="[TAG]"><input type="submit" value="Do it"></td><tr>
    </form>

    </table>
    <?
}
else die("ID not found!");
mysql_close ($db);

require "footer.php";
?>
