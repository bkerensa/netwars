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

if ($building!="")
{
    if ($building=="crystal"  && $myrow["c_crystal"]==0) { $result = mysql_query("UPDATE ".$PA["table"]." SET c_crystal='10' WHERE id=$Userid",$db); }
    if ($building=="metal"  && $myrow["c_metal"]==0 && $crystal>=500) { $result = mysql_query("UPDATE ".$PA["table"]." SET c_metal='20',crystal='".($crystal - 500)."' WHERE id=$Userid",$db); }
    if ($building=="airport"  && $myrow["c_airport"]==0 && $crystal>=2500 && $metal>=1000 && $myrow["c_metal"]==1) { $result = mysql_query("UPDATE ".$PA["table"]." SET c_airport='20',crystal='".($crystal - 2500)."',metal='".($metal - 1000)."' WHERE id=$Userid",$db); }
    if ($building=="abase"  && $myrow["c_abase"]==0 && $crystal>=5000 && $metal>=3000 && $myrow["c_metal"]==1) { $result = mysql_query("UPDATE ".$PA["table"]." SET c_abase='40',crystal='".($crystal - 5000)."',metal='".($metal - 3000)."' WHERE id=$Userid",$db); }
    if ($building=="destfact"  && $myrow["c_destfact"]==0 && $crystal>=10000 && $metal>=10000 && $myrow["c_metal"]==1) { $result = mysql_query("UPDATE ".$PA["table"]." SET c_destfact='120',crystal='".($crystal - 10000)."',metal='".($metal - 10000)."' WHERE id=$Userid",$db); }
    if ($building=="scorpfact"  && $myrow["c_scorpfact"]==0 && $crystal>=20000 && $metal>=20000 && $myrow["c_metal"]==1) { $result = mysql_query("UPDATE ".$PA["table"]." SET c_scorpfact='120',crystal='".($crystal - 20000)."',metal='".($metal - 20000)."' WHERE id=$Userid",$db); }
    if ($building=="odg"  && $myrow["c_odg"]==0 && $crystal>=20000 && $metal>=20000 && $myrow["r_odg"]==1) { $result = mysql_query("UPDATE ".$PA["table"]." SET c_odg='120',crystal='".($crystal - 20000)."',metal='".($metal - 20000)."' WHERE id=$Userid AND r_odg=1",$db); }
    header("Location: construct.php");
    die;
}

require "header.php";

?>
Construction:<br><br>
<table border="1" bordercolor="black">
<?
Production_entry("Name:","Description:","ETA:","Build:","Cost:");

$result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id=$Userid",$db);
$myrow = mysql_fetch_array($result);
$c_crystal = $myrow["c_crystal"];
$c_metal = $myrow["c_metal"];
$c_airport = $myrow["c_airport"];
$c_abase = $myrow["c_abase"];
$c_destfact = $myrow["c_destfact"];
$c_scorpfact = $myrow["c_scorpfact"];
$r_odg = $myrow["r_odg"];
$c_odg = $myrow["c_odg"];
$r_aaircraft = $myrow["r_aaircraft"];

#
# Very bad code: could have been optimized by making a small function, but this way works too :)
#

if ($c_crystal==0) { Production_entry("Crystal refinery","Enables mining of crystal.","10","<a href=\"construct.php?building=crystal\">Build</a>","Free");}
if ($c_crystal>=2) { Production_entry("Crystal refinery","Enables mining of crystal.",($c_crystal-1),"Building...","Free");}
if ($c_crystal==1) { Production_entry("Crystal refinery","Enables mining of crystal.","10","Done","Free"); }

if ($c_metal==0) { Production_entry("Metal refinery","Enables mining of metal.","20","<a href=\"construct.php?building=metal\">Build</a>","500c");}
if ($c_metal>=2) { Production_entry("Metal refinery","Enables mining of metal.",($c_metal-1),"Building...","500c");}
if ($c_metal==1) { Production_entry("Metal refinery","Enables mining of metal.","20","Done","500c"); }

if ($c_metal==1) {
    if ($c_airport==0) { Production_entry("Spaceport","Enables building of Infinitys.","20","<a href=\"construct.php?building=airport\">Build</a>","2500c 1000m");}
    if ($c_airport>=2) { Production_entry("Spaceport","Enables building of Infinitys.",($c_airport-1),"Building...","2500c 1000m");}
    if ($c_airport==1) { Production_entry("Spaceport","Enables building of Infinitys.","20","Done","2500c 1000m"); }
}

if ($c_airport==1) {
    if ($c_abase==0) { Production_entry("Advanced Spaceport","Enables building of advanced ships.","40","<a href=\"construct.php?building=abase\">Build</a>","5000c 3000m");}
    if ($c_abase>=2) { Production_entry("Advanced Spaceport","Enables building of advanced ships.",($c_abase-1),"Building...","5000c 3000m");}
    if ($c_abase==1) { Production_entry("Advanced Spaceport","Enables building of advanced ships.","40","Done","5000c 3000m"); }
}

if ($r_aaircraft==1) {
    if ($c_destfact==0) { Production_entry("Destroyer factory","Enables building of destroyers.","120","<a href=\"construct.php?building=destfact\">Build</a>","10000c 10000m");}
    if ($c_destfact>=2) { Production_entry("Destroyer factory","Enables building of destroyers.",($c_destfact-1),"Building...","10000c 10000m");}
    if ($c_destfact==1) { Production_entry("Destroyer factory","Enables building of destroyers.","120","Done","10000c 10000m"); }
}

if ($c_destfact==1) {
    if ($c_scorpfact==0) { Production_entry("Scorpion factory","Enables building of scorpions.","120","<a href=\"construct.php?building=scorpfact\">Build</a>","20000c 20000m");}
    if ($c_scorpfact>=2) { Production_entry("Scorpion factory","Enables building of scorpions.",($c_scorpfact-1),"Building...","20000c 20000m");}
    if ($c_scorpfact==1) { Production_entry("Scorpion factory","Enables building of scorpions.","120","Done","20000c 20000m"); }
}

if ($r_odg==1) {
    if ($c_odg==0) { Production_entry("ODG factory","Enables building of ODG units.","120","<a href=\"construct.php?building=odg\">Build</a>","20000c 20000m");}
    if ($c_odg>=2) { Production_entry("ODG factory","Enables building of ODG units.",($c_odg-1),"Building...","20000c 20000m");}
    if ($c_odg==1) { Production_entry("ODG factory","Enables building of ODG units.","120","Done","20000c 20000m"); }
}

echo "</table>";
require "footer.php";
?>
