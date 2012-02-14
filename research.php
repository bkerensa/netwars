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

if ($research!="")
{
    if ($research=="imcrystal"  && $myrow["r_imcrystal"]==0 && $crystal>=1000) { $result = mysql_query("UPDATE ".$PA["table"]." SET r_imcrystal=25,crystal=crystal-1000 WHERE id=$Userid",$db); }
    if ($research=="immetal"  && $myrow["r_immetal"]==0 && $metal>=1000) { $result = mysql_query("UPDATE ".$PA["table"]." SET r_immetal=25,metal=metal-1000 WHERE id=$Userid",$db); }
    if ($research=="aaircraft"  && $myrow["aaircraft"]==0 && $metal>=5000 && $crystal>=5000) { $result = mysql_query("UPDATE ".$PA["table"]." SET r_aaircraft=120,metal=metal-5000,crystal=crystal-5000 WHERE id=$Userid",$db); }
    if ($research=="tbeam"  && $myrow["tbeam"]==0 && $metal>=5000 && $crystal>=5000) { $result = mysql_query("UPDATE ".$PA["table"]." SET r_tbeam=120,metal=metal-5000,crystal=crystal-5000 WHERE id=$Userid AND r_aaircraft=1",$db); }
    if ($research=="uscan"  && $myrow["r_uscan"]==0 && $metal>=10000 && $crystal>=10000) { $result = mysql_query("UPDATE ".$PA["table"]." SET r_uscan=180,metal=metal-10000,crystal=crystal-10000 WHERE id=$Userid AND r_tbeam=1",$db); }
    if ($research=="odg"  && $myrow["r_odg"]==0 && $metal>=10000 && $crystal>=10000) { $result = mysql_query("UPDATE ".$PA["table"]." SET r_odg=180,metal=metal-10000,crystal=crystal-10000 WHERE id=$Userid AND r_uscan=1",$db); }
    header("Location: research.php");
    die;
}

require "header.php";

?>
Research:<br><br>
<table border="1" bordercolor="black">
<?
Production_entry("Name:","Description:","ETA:","Research:","Cost:");

$result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id=$Userid",$db);
$myrow = mysql_fetch_array($result);
$r_imcrystal = $myrow["r_imcrystal"];
$r_immetal = $myrow["r_immetal"];
$r_qst = $myrow["r_qst"];
$r_iafs = $myrow["r_iafs"];
$r_aaircraft = $myrow["r_aaircraft"];
$r_tbeam = $myrow["r_tbeam"];
$r_uscan = $myrow["r_uscan"];
$r_odg = $myrow["r_odg"];

if ($r_imcrystal==0) { Production_entry("Improved crystal mining","Increase planet crystal mining.","25","<a href=\"research.php?research=imcrystal\">Research</a>","1000c");}
if ($r_imcrystal>=2) { Production_entry("Improved crystal mining","Increase planet crystal mining.",($r_imcrystal-1),"Researching...","1000c");}
if ($r_imcrystal==1) { Production_entry("Improved crystal mining","Increase planet crystal mining.","25","Done","1000c"); }

if ($r_immetal==0) { Production_entry("Improved metal mining","Increase planet metal mining.","25","<a href=\"research.php?research=immetal\">Research</a>","1000m");}
if ($r_immetal>=2) { Production_entry("Improved metal mining","Increase planet metal mining.",($r_immetal-1),"Researching...","1000m");}
if ($r_immetal==1) { Production_entry("Improved metal mining","Increase planet metal mining.","25","Done","1000m"); }

if ($myrow["c_abase"]==1)
{

    if ($r_aaircraft==0) { Production_entry("Advanced aircraft building","Enable production of warfrigs and astropods.","120","<a href=\"research.php?research=aaircraft\">Research</a>","5000m,5000c");}
    if ($r_aaircraft>=2) { Production_entry("Advanced aircraft building","Enable production of warfrigs and astropods.",($r_aaircraft-1),"Researching...","5000 metal,5000c");}
    if ($r_aaircraft==1) { Production_entry("Advanced aircraft building","Enable production of warfrigs and astropods.","120","Done","5000m,5000c"); }

}

if ($myrow["r_aaircraft"]==1)
{

    if ($r_tbeam==0) { Production_entry("Tractor beam studies","Enable production of the cobra.","120","<a href=\"research.php?research=tbeam\">Research</a>","5000m,5000c");}
    if ($r_tbeam>=2) { Production_entry("Tractor beam studies","Enable production of the cobra.",($r_tbeam-1),"Researching...","5000 metal,5000c");}
    if ($r_tbeam==1) { Production_entry("Tractor beam studies","Enable production of the cobra.","120","Done","5000m,5000c"); }

}

if ($myrow["r_tbeam"]==1)
{

    if ($r_uscan==0) { Production_entry("Unit scan studies","Enable unit scans.","180","<a href=\"research.php?research=uscan\">Research</a>","10000m,10000c");}
    if ($r_uscan>=2) { Production_entry("Unit scan studies","Enable unit scans.",($r_uscan-1),"Researching...","10000 metal,10000c");}
    if ($r_uscan==1) { Production_entry("Unit scan studies","Enable unit scans.","180","Done","10000m,10000c"); }

}

if ($myrow["r_uscan"]==1)
{

    if ($r_odg==0) { Production_entry("ODG studies","Enable Orbital Defense Grid.","180","<a href=\"research.php?research=odg\">Research</a>","10000m,10000c");}
    if ($r_odg>=2) { Production_entry("ODG studies","Enable Orbital Defense Grid.",($r_odg-1),"Researching...","10000 metal,10000c");}
    if ($r_odg==1) { Production_entry("ODG studies","Enable Orbital Defense Grid.","180","Done","10000m,10000c"); }

}

echo "</table>";
require "footer.php";
?>
