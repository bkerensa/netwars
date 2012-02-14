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

function calccost($number)
{
    global $i_roids;
    $retval = 0;
    $a = 0;
    if ($a!=$number)
    {
        do
        {
            $a++;
            $cost = 75*($i_roids+$a);
            $retval += $cost;
        }while($a<$number);
    } else $retval = 75*($i_roids+$a);
    return $retval;

}

/*
   #
   # Uncomment this part to enable donations:
   #

   if ($donatecrystal=="") $donatecrystal = "0";
   if ($donatemetal=="") $donatemetal = "0";

   if ($donateto>0) {
   $result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id='$donateto'",$db);
   if (mysql_num_rows($result)!=1) {
   Header("Location: resources.php");
   die("");
   }
   }

   if ($donateto!="" && $donateto>0 && $donatecrystal>=0 && $donatemetal>=0 && $crystal>=$donatecrystal && $metal>=$donatemetal && $donateto!=$Userid)
   {
   $result = mysql_query("UPDATE ".$PA["table"]." SET crystal=crystal-$donatecrystal,metal=metal-$donatemetal WHERE id=$Userid AND crystal>=$donatecrystal AND metal>=$donatemetal",$db);
   if ($result!=0) $result = mysql_query("UPDATE ".$PA["table"]." SET crystal=crystal+$donatecrystal,metal=metal+$donatemetal WHERE id=$donateto",$db);
   header("Location: resources.php");
   $string = "You recieved a donation of ";
   if ($donatecrystal>0) $string =$string."$donatecrystal crystal ";
   if ($donatemetal>0 && $donatecrystal>0) $string = $string."and $donatemetal metal ";
   if ($donatemetal>0 && $donatecrystal<1) $string = $string."$donatemetal metal ";
   $string = $string."from $Username.";
   add_news("Donation",$string,$donateto);
   die;
   }
   */

if ($init>0 && $ui_roids>0)
{
    $cost = calccost(0);

    if ($metal<$cost) $msgred = "You do not have enough metal!";

    $a = 0;
    while($metal>=$cost && $init>$a && $ui_roids>0){
        $a++;
        $cost = calccost(0);
        $metal -= $cost;
        $ui_roids--;
        $i_roids++;
        if ($roidtype=="metal") $result = mysql_query("UPDATE ".$PA["table"]." SET metal=metal-$cost,asteroid_metal=asteroid_metal+1,ui_roids=ui_roids-1 WHERE id=$Userid AND metal>=$cost",$db);
        if ($roidtype=="crystal") $result = mysql_query("UPDATE ".$PA["table"]." SET metal=metal-$cost,asteroid_crystal=asteroid_crystal+1,ui_roids=ui_roids-1 WHERE id=$Userid AND metal>=$cost",$db);
        if ($a==1) $msggreen = "You initiated $a $roidtype asteroid.";
        else $msggreen = "You initiated $a $roidtype asteroids.";
    }

    Header("Location: resources.php?msggreen=$msggreen&msgred=$msgred");
    die();
}

require "header.php";

?>
Resources:<br><br>

<?

echo "Asteroids ($roids total):<br><table><td><b>Type:</td><td><b>Asteroids:</td><td><b>Planet income:</td><td><b>Total income:</td><tr>\n";

echo "<td><b>Metal</td><td><b>$metalroid</td><td><b>$planetmetal</td>";
echo "<td><b>".($planetmetal + $metalroid * 6)."</td>";
echo "<tr>\n";

echo "<td><b>Crystal</td><td><b>$crystalroid</td><td><b>$planetcrystal</td>";
echo "<td><b>".($planetcrystal + $crystalroid * 6)."</td>";
echo "<tr>\n";

echo "<td><b>Uninitiated</td><td><b>$ui_roids</td>";

echo "</table><br>";

//$initcost = number_format((100 * pow(1.2,$i_roids)));
//$initcost2 = number_format((100 * pow(1.2,$i_roids+2)));
//echo "Cost to initiate next roid: $initcost metal (x2 = ".($initcost*2).") 2 xtra roids: $initcost2<br><br><br>";
if ($ui_roids>0)
{
    echo "Cost to initiate next asteroid: ".calccost(0)." metal<br><br><table><td width=\"65\"><b>Initiate<br>roid(s):</td>";
#  echo "<a href=\"resources.php?init=metal\">Initiate metal asteroid</a><br>\n";
#  echo "<a href=\"resources.php?init=crystal\">Initiate crystal asteroid</a><br><br>\n";
    echo "<td><form action=\"resources.php\" method=\"post\">";
    echo "<select name=\"roidtype\"><option value=\"crystal\">Crystal</option><option value=\"metal\">Metal</option></select></td><tr>";
    echo "<td></td><td><input type=\"text\" name=\"init\" size=\"7\"></td><tr>";
    echo "<td></td><td><input type=\"submit\" value=\"Initiate\"></td><tr>";
    echo "</form></table>";
}

#
# Remove the die(""); to enable donations
#


die("");
echo "Donate:<br>";

echo "<table><form action=\"$PHP_SELF\" METHOD=\"POST\"><td width=\"65\"><font size=\"1\">Planet ID #:</font></td><td><input type=\"text\" name=\"donateto\" size=\"7\"><tr>";


echo "<td>Metal:</td><td><input type=\"text\" size=\"7\" name=\"donatemetal\" value=\"$metal\"></td><tr>\n";
echo "<td>Crystal:</td><td><input type=\"text\" size=\"7\" name=\"donatecrystal\" value=\"$crystal\"></td><tr>\n";
echo "<td></td><td><input type=\"Submit\" value=\"Donate\"></td></form>";

require "footer.php";
?>
