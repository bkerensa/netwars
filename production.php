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

if ($QUERY_STRING!="")
{
    if ($buildinfinitys>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_infinitys='$buildinfinitys',p_infinityst='10',crystal=crystal-".($buildinfinitys*200)." WHERE id=$Userid AND c_airport=1 AND  p_infinitys=0 AND crystal>=".($buildinfinitys*200),$db); }
    if ($buildwraiths>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_wraiths='$buildwraiths',p_wraithst='20',metal=metal-".($buildwraiths*2000)." WHERE id=$Userid AND c_abase=1 AND p_wraiths=0 AND metal>=".($buildwraiths*2000),$db); }
    if ($buildwarfrigs>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_warfrigs='$buildwarfrigs',p_warfrigst='40',crystal=crystal-".($buildwarfrigs*1500).",metal=metal-".($buildwarfrigs*1500)." WHERE id=$Userid AND c_abase=1 AND  p_warfrigs=0 AND crystal>=".($buildwarfrigs*1500)." AND metal>=".($buildwarfrigs*1500),$db); }
    if ($buildastropods>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_astropods='$buildastropods',p_astropodst='40',crystal=crystal-".($buildastropods*800).",metal=metal-".($buildastropods*800)." WHERE id=$Userid AND r_aaircraft=1 AND p_astropods=0 AND crystal>=".($buildastropods*800)." AND metal>=".($buildastropods*800),$db); }
    if ($builddestroyers>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_destroyers='$builddestroyers',p_destroyerst='60',crystal=crystal-".($builddestroyers*3000).",metal=metal-".($builddestroyers*2000)." WHERE id=$Userid AND r_aaircraft=1 AND p_destroyers=0 AND crystal>=".($builddestroyers*3000)." AND metal>=".($builddestroyers*2000),$db); }
    if ($buildcobras>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_cobras='$buildcobras',p_cobrast='60',crystal=crystal-".($buildcobras*3000)." WHERE id=$Userid AND r_tbeam=1 AND p_cobras=0 AND crystal>=".($buildcobras*3000),$db); }
    if ($buildscorpions>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_scorpions='$buildscorpions',p_scorpionst='100',metal=metal-".($buildscorpions*6000).",crystal=crystal-".($buildscorpions*1000)." WHERE id=$Userid AND c_scorpfact=1 AND p_scorpions=0 AND metal>=".($buildscorpions*6000)." AND crystal>=".($buildscorpions*1000),$db); }//  if ($buildwraiths>0  && $myrow["p_wraiths"]==0 && $crystal>=($buildwraiths*500) && $metal>=($buildwraiths*750)) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_wraiths='$buildwraiths',p_wraithst='20',crystal='".($crystal-($buildwraiths*500))."',metal='".($metal-($buildwraiths*750))."' WHERE id=$Userid",$db); }
    if ($buildrcannons>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_rcannons='$buildrcannons',p_rcannonst='20',metal=metal-".($buildrcannons*800)." WHERE id=$Userid AND c_odg=1 AND p_rcannons=0 AND metal>=".($buildrcannons*800),$db); }
    if ($buildavengers>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_avengers='$buildavengers',p_avengerst='30',metal=metal-".($buildavengers*700).",crystal=crystal-".($buildavengers*700)." WHERE id=$Userid AND c_odg=1 AND p_avengers=0 AND metal>=".($buildavengers*700)." AND crystal>=".($buildavengers*700),$db); }
    if ($buildlstalkers>0) { $result = mysql_query("UPDATE ".$PA["table"]." SET p_lstalkers='$buildlstalkers',p_lstalkerst='60',metal=metal-".($buildlstalkers*3000).",crystal=crystal-".($buildlstalkers*3000)." WHERE id=$Userid AND c_odg=1 AND p_lstalkers=0 AND metal>=".($buildlstalkers*3000)." AND crystal>=".($buildlstalkers*3000),$db); }
    header("Location: production.php");
    die;
}

require "header.php";

?>
Production:<br><br>
<table border="1" bordercolor="black">
<?
Production_entry("Name:","Description:","ETA:","Cost:","Stock:","Production:");

$result = mysql_query("SELECT * FROM ".$PA["table"]." WHERE id=$Userid",$db);
$myrow = mysql_fetch_array($result);
$p_infinitys = $myrow["p_infinitys"];
$p_infinityst = $myrow["p_infinityst"];
$p_wraiths = $myrow["p_wraiths"];
$p_wraithst = $myrow["p_wraithst"];
$p_cobras = $myrow["p_cobras"];
$p_cobrast = $myrow["p_cobrast"];
$p_warfrigs = $myrow["p_warfrigs"];
$p_warfrigst = $myrow["p_warfrigst"];
$p_astropods = $myrow["p_astropods"];
$p_astropodst = $myrow["p_astropodst"];
$p_destroyers = $myrow["p_destroyers"];
$p_destroyerst = $myrow["p_destroyerst"];
$p_scorpions = $myrow["p_scorpions"];
$p_scorpionst = $myrow["p_scorpionst"];
$p_rcannons = $myrow["p_rcannons"];
$p_rcannonst = $myrow["p_rcannonst"];
$p_avengers = $myrow["p_avengers"];
$p_avengerst = $myrow["p_avengerst"];
$p_lstalkers = $myrow["p_lstalkers"];
$p_lstalkerst = $myrow["p_lstalkerst"];
$lstalkers = $myrow["lstalkers"];
$avengers = $myrow["avengers"];
$rcannons = $myrow["rcannons"];
$warfrigs = $myrow["warfrigs"];
$scorpions = $myrow["scorpions"];
$cobras = $myrow["cobras"];
$destroyers = $myrow["destroyers"];
$infinitys = $myrow["infinitys"];
$wraiths = $myrow["wraiths"];
$astropods = $myrow["astropods"];

if ($myrow["c_airport"]==1)
{
    echo "<td></td><td><b>Ships:</td><tr>";

    if ($p_infinitys==0)
    {
        $temp[1] = floor($crystal / 200);
        $tmp = min($temp);
        Production_entry("Infinitys","<font size=\"1\">Infinity class escorts form a significant proportion of small fleets. Their versatility makes them a favoured vessel for scouting, patrolling and raiding. The main asset of the Infinity is its great speed, enabling it to catch the light, fast crafts favoured by pirates.","10","200c","$infinitys","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildinfinitys\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
    } else Production_entry("Infinitys","<font size=\"1\">Infinity class escorts form a significant proportion of small fleets. Their versatility makes them a favoured vessel for scouting, patrolling and raiding. The main asset of the Infinity is its great speed, enabling it to catch the light, fast crafts favoured by pirates.","$p_infinityst","200c","$infinitys","Building $p_infinitys");
}

if ($myrow["c_abase"]==1)
{
    if ($p_wraiths==0)
    {
        $temp[2] = 999999999;
        $temp[1] = floor($metal / 2000);
        $tmp = min($temp);
        Production_entry("Wraiths","<font size=\"1\">Wraiths were created in an effort to balance the manoeuverability of escort class ships with the power of a laser armament. The Wraith is built around an astropod class hull with major reconfiguration of the central laser cores to direct power to a prow-mounted cannon. The speed and price of these ships make them great value to any fleet commander.","20","2000m","$wraiths","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildwraiths\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
    } else Production_entry("Wraiths","<font size=\"1\">Wraiths were created in an effort to balance the manoeuverability of escort class ships with the power of a laser armament. The Wraith is built around an astropod class hull with major reconfiguration of the central laser cores to direct power to a prow-mounted cannon. The speed and price of these ships make them great value to any fleet commander.","$p_wraithst","2000m","$wraiths","Building $p_wraiths");

    if ($vars["r_aaircraft"]==1){

        if ($p_warfrigs==0)
        {
            $temp[1] = floor($crystal / 1500);
            $temp[2] = floor($metal / 1500);
            $tmp = min($temp);
            Production_entry("Warfrigates","<font size=\"1\">The warfrigate forms the mainstay of any fleet. The uncomplicated design of this class ensures its enduring ability, enabling vessels to be built at space ports normally unable to master the expertise to construct a capital ship. The main abilities of a frigate is its durability. Being able to serve in any fight as an allround ship has proved hugely popular, indeed many battles have been swung by frigates. In the words of ltd Warf of planet Kumpara: \"A fleet would not be a fleet without frigates\".","40","1500c 1500m","$warfrigs","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildwarfrigs\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
        } else Production_entry("Warfrigates","<font size=\"1\">The warfrigate forms the mainstay of any fleet. The uncomplicated design of this class ensures its enduring ability, enabling vessels to be built at space ports normally unable to master the expertise to construct a capital ship. The main abilities of a frigate is its durability. Being able to serve in any fight as an allround ship has proved hugely popular, indeed many battles have been swung by frigates. In the words of ltd Warf of planet Kumpara: \"A fleet would not be a fleet without frigates\".","$p_warfrigst","1500c 1500m","$warfrigs","Building $p_warfrigs");

        if ($p_astropods==0)
        {
            $temp[1] = floor($crystal / 800);
            $temp[2] = floor($metal / 800);
            $tmp = min($temp);
            Production_entry("Astropods","<font size=\"1\">Hundreds, perhaps thousands, of astropods participated in the universal War. The vast majority were chartered merchantmen pressed into service capturing asteroids. The astropod is a specially designed ship used to capture asteroids during combat, they have been specially designed so they can do this a hundreds of times, astropods have weak amour and carry no weapons. The crews of these small vessels, despite being untrained in the arts of battle, struggled valiantly against often impossible odds and paid a heavy price in blood for their efforts.","40","800c 800m","$astropods","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildastropods\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
        } else Production_entry("Astropods","<font size=\"1\">Hundreds, perhaps thousands, of astropods participated in the universal War. The vast majority were chartered merchantmen pressed into service capturing asteroids. The astropod is a specially designed ship used to capture asteroids during combat, they have been specially designed so they can do this a hundreds of times, astropods have weak amour and carry no weapons. The crews of these small vessels, despite being untrained in the arts of battle, struggled valiantly against often impossible odds and paid a heavy price in blood for their efforts.","$p_astropodst","800c 800m","$astropods","Building $p_astropods");
    }

    if ($vars["r_tbeam"]==1){

        if ($p_cobras==0)
        {
            $temp[1] = floor($crystal / 3000);
            $temp[2] = 999999999;
            $tmp = min($temp);
            Production_entry("Cobras","<font size=\"1\">The cobra is a fairly specialized ship which uses a small tractor beam. The tractor beam locates the astropod by picking up its subspace resulode and then attaching itself to the ship. The cobra then slams its engines into reverse and then takes the ship into warp space where it holds the ships turn. Another advantage is that the ship remains neutral in offensive operations, and thus is not harmed.","60","3000c","$cobras","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildcobras\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
        } else Production_entry("Cobras","<font size=\"1\">The cobra is a fairly specialized ship which uses a small tractor beam. The tractor beam locates the astropod by picking up its subspace resulode and then attaching itself to the ship. The cobra then slams its engines into reverse and then takes the ship into warp space where it holds the ships turn. Another advantage is that the ship remains neutral in offensive operations, and thus is not harmed..","$p_cobrast","3000c","$cobras","Building $p_cobras");

    }

    if ($vars["c_destfact"]==1){

        if ($p_destroyers==0)
        {
            $temp[1] = floor($crystal / 3000);
            $temp[2] = floor($metal / 2000);
            $tmp = min($temp);
            Production_entry("Destroyers","<font size=\"1\">The destroyer class was developed as the demand for a more powerful ship was high. A belief in the strength of attack craft as the ultimate weapons in space warfare pervaded the fleets of the universe and plans were made for a modification of the destroyer class but as of up until today little has been said about the building of an even more powerful ship. The destroyers main gun is an ion particle accelerator , managing to blast holes in any of the lesser ships. It's best suited with protection from the smaller faster ships due to the time that the ion accelerator takes to charge. This is never the less a very powerful ship which comes in use to any of the major fleets.","60","3000c 2000m","$destroyers","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"builddestroyers\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
        } else Production_entry("Destroyers","<font size=\"1\">The destroyer class was developed as the demand for a more powerful ship was high. A belief in the strength of attack craft as the ultimate weapons in space warfare pervaded the fleets of the universe and plans were made for a modification of the destroyer class but as of up until today little has been said about the building of an even more powerful ship. The destroyers main gun is an ion particle accelerator , managing to blast holes in any of the lesser ships. It's best suited with protection from the smaller faster ships due to the time that the ion accelerator takes to charge. This is never the less a very powerful ship which comes in use to any of the major fleets.","$p_destroyerst","3000c 2000m","$destroyers","Building $p_destroyers");

    }

    if ($vars["c_scorpfact"]==1){

        if ($p_scorpions==0)
        {
            $temp[1] = floor($metal / 6000);
            $temp[2] = floor($crystal / 1000);
            $tmp = min($temp);
            Production_entry("Scorpions","<font size=\"1\">The scorpion class has been developed by some of he best known manufactures around the universe, the ship was originally modelled on a destroyer class hull, but later it was decided that a bigger would have to be made. The scorpion class has a 3 ion particle execrators which are focused into beam, making the ship the most powerful  of the cruisers, its main weakness being its lack of armour of a large ship and its high cost. Due to its slow speed it was decided that the scorpions amour should be less thick, so it maintains a reasonable a speed, but a blow to the back of the ship can wreck havoc in its sensitive computer system.","100","1000c 6000m","$scorpions","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildscorpions\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
        } else Production_entry("Scorpions","<font size=\"1\">The scorpion class has been developed by some of he best known manufactures around the universe, the ship was originally modelled on a destroyer class hull, but later it was decided that a bigger would have to be made. The scorpion class has a 3 ion particle execrators which are focused into beam, making the ship the most powerful  of the cruisers, its main weakness being its lack of armour of a large ship and its high cost. Due to its slow speed it was decided that the scorpions amour should be less thick, so it maintains a reasonable a speed, but a blow to the back of the ship can wreck havoc in its sensitive computer system.","$p_scorpionst","1000c 6000m","$scorpions","Building $p_scorpions");

    }

    if ($vars["c_odg"]==1){
        echo "<tr><td></td><td><b>Orbital Defense Grid:</td><tr>";
        if ($p_rcannons==0)
        {
            $temp[1] = floor($metal / 800);
            $temp[2] = floor($metal / 800);
            $tmp = min($temp);
            Production_entry("Reaper cannons","<font size=\"1\">The reaper cannon is a general purpose cannon which can be seen cluttering a planet from many light years away. They are small extremely useful cannons which have been described as the sherman tank of the 22nd century. With  its low cost and fast tracking abilities it can target the light fast ships, which if there are enough of them in the Grid can make a mess of infinitys and it even start targeting astropods. Surely any commander would never leave his planet without his reaper cannons being at his empire's home at all times.","20","800m","$rcannons","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildrcannons\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
        } else Production_entry("Reaper cannons","<font size=\"1\">The reaper cannon is a general purpose cannon which can be seen cluttering a planet from many light years away. They are small extremely useful cannons which have been described as the sherman tank of the 22nd century. With  its low cost and fast tracking abilities it can target the light fast ships, which if there are enough of them in the Grid can make a mess of infinitys and it even start targeting astropods. Surely any commander would never leave his planet without his reaper cannons being at his empire's home at all times.","$p_rcannonst","800m","$rcannons","Building $p_rcannons");

        if ($p_avengers==0)
        {
            $temp[1] = floor($metal / 700);
            $temp[2] = floor($crystal / 700);
            $tmp = min($temp);
            Production_entry("Avengers","<font size=\"1\">Using a mounted Tachyon Particle Disrupter, it charges up a concentrated ball of tachyon energy and fire it at great speed that will once it hits it target release all the built-up energy causing the hull of ship to be literally torn apart. But due to charging time involved and the energy dispersing over travel it is only able to hit medium speed moving vessels due to their lower speed than fighters, and the hull of heavier class ship are only partially affected due to their heavier armour integrity. ","30","700m 700c","$avengers","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildavengers\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
        } else Production_entry("Avengers","<font size=\"1\">Using a mounted Tachyon Particle Disrupter, it charges up a concentrated ball of tachyon energy and fire it at great speed that will once it hits it target release all the built-up energy causing the hull of ship to be literally torn apart. But due to charging time involved and the energy dispersing over travel it is only able to hit medium speed moving vessels due to their lower speed than fighters, and the hull of heavier class ship are only partially affected due to their heavier armour integrity. ","$p_avengerst","700m 700c","$avengers","Building $p_avengers");

        if ($p_lstalkers==0)
        {
            $temp[1] = floor($metal / 3000);
            $temp[2] = floor($crystal / 3000);
            $tmp = min($temp);
            Production_entry("Lucius Stalkers","<font size=\"1\">The Lucius Stalkers are large slow firing cannons that use physical rounds instead of energy weapons. It uses massive electromagnets and speeds up a 40-mm hyper velocity round, to such a great speed that it is capable of penetrating the toughest armour. But unfortunately loading time of round is slow and the power drain of activating the immensely powerful magnets causes a great strain on the reactor. So a recharge period is necessary, so due to these limitations it is only capable of targeting slow moving vessels. But it can easily penetrate their hulls.","60","3000m 3000c","$lstalkers","<form action=\"$PHP_SELF\" METHOD=\"GET\"><input type=\"text\" size=\"3\" name=\"buildlstalkers\" value=\"$tmp\"><input type=\"submit\" value=\"Build\"></form>");
        } else Production_entry("Lucius Stalkers","<font size=\"1\">The Lucius Stalkers are large slow firing cannons that use physical rounds instead of energy weapons. It uses massive electromagnets and speeds up a 40-mm hyper velocity round, to such a great speed that it is capable of penetrating the toughest armour. But unfortunately loading time of round is slow and the power drain of activating the immensely powerful magnets causes a great strain on the reactor. So a recharge period is necessary, so due to these limitations it is only capable of targeting slow moving vessels. But it can easily penetrate their hulls.","$p_lstalkerst","3000m 3000c","$lstalkers","Building $p_lstalkers");


    }

}

echo "</table>";

require "footer.php";
?>
