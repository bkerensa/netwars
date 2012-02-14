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

if ($submit) {

    if ($nick=="") { echo "Nick not specified!"; require "footer.php"; die; }
    if ($navn=="") { echo "Name not specified!"; require "footer.php"; die; }
    if ($bosted=="") { echo "City not specified!"; require "footer.php"; die; }
    if ($telefon=="") { echo "Phone not specified!"; require "footer.php"; die; }
    if ($email=="") { echo "E-Mail not specified!"; require "footer.php"; die; }
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE name='$navn'",$db);
    if ($myrow = mysql_fetch_array($result)) { echo "User '$navn' already registered!"; require "footer.php"; die; }
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE nick='$nick'",$db);
    if ($myrow = mysql_fetch_array($result)) { echo "User '$nick' already registered!"; require "footer.php"; die; }
    $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE email='$email'",$db);
    if ($myrow = mysql_fetch_array($result)) { echo "User with e-mail '$email' already registered!"; require "footer.php"; die; }

    $garbage = substr(md5(time()),0,10);

    $sql = "INSERT INTO ".$PA["table"]." (nick,name,city,phone,email,password) VALUES ('$nick','$navn','$bosted','$telefon','$email','$garbage')";
    Logging("register",$sql);

    $result = mysql_query($sql);

    if ($result && $mode=="inet") {
        echo "Account created! Your password is sent by e-mail.<br>\n";
        mail($email,$PA["name"]." - Account",$PA["name"]." account:\n\nUsername: $nick\nPassword: $garbage\n\nYou can edit the password under 'Preferences' after you log in.\n\nWhy dont you come to #WPA at irc.netgamers.org to have a chat? :)\n\n-".$PA["name"]." crew\nhttp://www.ewsnl.com/~wassink/pa/","From: j.wassink@student.unimaas.nl");
    }
    if ($result && $mode=="LAN") {
        echo "Account created! Your password is:<br>\n";
        echo("$garbage\n");
    }

}
else {
    ?>
    This game is now <a href="postcard.php">postcardware</a>.<br><br>
    <i>
    Deto-Planetarion is still in its testing period, and might have bugs/problems etc.<br>
    You will not get your asteroids/ships/resources back if you lose them because<br>
    of a bug or any other problem.<br>
    </i>
    <br>
    Note: All multi-accounts will be deleted!
    <table>
    <form method="post" action="<?php echo $PHP_SELF?>">
    <td><font face="Arial" size="2"><b>Nick:</td><td><input type="Text" name="nick"><tr>
    <td><font face="Arial" size="2"><b>Name:</td><td><input type="Text" name="navn"><tr>
    <td><font face="Arial" size="2"><b>City:</td><td><input type="Text" name="bosted"><tr>
    <td><font face="Arial" size="2"><b>Phone:</td><td><input type="Text" name="telefon"><tr>
    <td><font face="Arial" size="2"><b>E-Mail:</td><td><input type="Text" name="email">(Must be real!)<tr>
        <td></td><td><input type="Submit" name="submit" value="Sign me up"><tr>
        </form>
        </table>
        <?php
    }

require "footer.php";
?>
