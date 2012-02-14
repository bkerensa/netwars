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

#  server host , username, and password(blank)

#$db = mysql_connect("localhost","root","");
require("dblogon.php");

$result = mysql_query("CREATE DATABASE planetarion",$db);

mysql_select_db("planetarion",$db);

echo "created database: planetarion\n<BR>";

// Start generating tables
$result = mysql_query("DROP TABLE IF EXISTS pa_users",$db);
$result = mysql_query("DROP TABLE IF EXISTS pa_news",$db);
$result = mysql_query("DROP TABLE IF EXISTS pa_logging",$db);
$result = mysql_query("DROP TABLE IF EXISTS pa_tags",$db);
$result = mysql_query("CREATE TABLE pa_users (
   id int(11) NOT NULL auto_increment,
   name varchar(30) NOT NULL,
   nick varchar(30) NOT NULL,
   email varchar(30) NOT NULL,
   city varchar(30) NOT NULL,
   phone varchar(30) NOT NULL,
   password varchar(30) NOT NULL,
   crystal int(11) DEFAULT '0' NOT NULL,
   metal int(11) DEFAULT '0' NOT NULL,
   wraiths int(11) DEFAULT '0' NOT NULL,
   warfrigs int(11) DEFAULT '0' NOT NULL,
   destroyers int(11) DEFAULT '0' NOT NULL,
   scorpions int(11) DEFAULT '0' NOT NULL,
   p_scorpions int(11) DEFAULT '0' NOT NULL,
   p_scorpionst int(11) DEFAULT '0' NOT NULL,
   cobras int(11) DEFAULT '0' NOT NULL,
   p_cobras int(11) DEFAULT '0' NOT NULL,
   p_cobrast int(11) DEFAULT '0' NOT NULL,
   missiles int(11) DEFAULT '0' NOT NULL,
   score int(11) DEFAULT '0' NOT NULL,
   asteroids int(11) DEFAULT '0' NOT NULL,
   asteroid_crystal int(11) DEFAULT '0' NOT NULL,
   asteroid_metal int(11) DEFAULT '0' NOT NULL,
   ui_roids int(11) DEFAULT '0' NOT NULL,
   war int(11) DEFAULT '0' NOT NULL,
   def int(11) DEFAULT '0' NOT NULL,
   wareta int(11) DEFAULT '0' NOT NULL,
   defeta int(11) DEFAULT '0' NOT NULL,
   c_crystal int(10) DEFAULT '0' NOT NULL,
   c_metal int(10) DEFAULT '0' NOT NULL,
   c_airport int(11) DEFAULT '0' NOT NULL,
   c_abase int(10) DEFAULT '0' NOT NULL,
   c_wstation int(10) DEFAULT '0' NOT NULL,
   c_amp1 int(10) DEFAULT '0' NOT NULL,
   c_amp2 int(10) DEFAULT '0' NOT NULL,
   c_warfactory int(10) DEFAULT '0' NOT NULL,
   c_destfact int(11) DEFAULT '0' NOT NULL,
   c_scorpfact int(11) DEFAULT '0' NOT NULL,
   r_imcrystal int(10) DEFAULT '0' NOT NULL,
   r_immetal int(10) DEFAULT '0' NOT NULL,
   r_iafs int(10) DEFAULT '0' NOT NULL,
   r_aaircraft int(11) DEFAULT '0' NOT NULL,
   r_tbeam int(11) DEFAULT '0' NOT NULL,
   r_uscan int(11) DEFAULT '0' NOT NULL,
   infinitys int(11) DEFAULT '0' NOT NULL,
   p_infinitys int(11) DEFAULT '0' NOT NULL,
   p_infinityst int(11) DEFAULT '0' NOT NULL,
   p_wraiths int(11) DEFAULT '0' NOT NULL,
   p_wraithst int(11) DEFAULT '0' NOT NULL,
   p_warfrigs int(11) DEFAULT '0' NOT NULL,
   p_warfrigst int(11) DEFAULT '0' NOT NULL,
   p_destroyers int(11) DEFAULT '0' NOT NULL,
   p_destroyerst int(11) DEFAULT '0' NOT NULL,
   p_missiles int(11) DEFAULT '0' NOT NULL,
   p_missilest int(11) DEFAULT '0' NOT NULL,
   timer int(15) DEFAULT '0' NOT NULL,
   size int(15),
   astropods int(11) DEFAULT '0' NOT NULL,
   p_astropods int(11) DEFAULT '0' NOT NULL,
   p_astropodst int(11) DEFAULT '0' NOT NULL,
   tag varchar(10) NOT NULL,
   rank int(11) DEFAULT '0' NOT NULL,
   rcannons int(11) DEFAULT '0' NOT NULL,
   p_rcannons int(11) DEFAULT '0' NOT NULL,
   p_rcannonst int(11) DEFAULT '0' NOT NULL,
   avengers int(11) DEFAULT '0' NOT NULL,
   p_avengers int(11) DEFAULT '0' NOT NULL,
   p_avengerst int(11) DEFAULT '0' NOT NULL,
   lstalkers int(11) DEFAULT '0' NOT NULL,
   p_lstalkers int(11) DEFAULT '0' NOT NULL,
   p_lstalkerst int(11) DEFAULT '0' NOT NULL,
   r_odg int(11) DEFAULT '0' NOT NULL,
   c_odg int(11) DEFAULT '0' NOT NULL,
   closed tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (id),
   UNIQUE id (id),
   KEY id_2 (id))",$db);

echo "usertable created";

$result = mysql_query("CREATE TABLE pa_news (
   id int(11) DEFAULT '0' NOT NULL,
   time int(15) DEFAULT '0' NOT NULL,
   news text NOT NULL,
   seen varchar(10) NOT NULL,
   header varchar(40) NOT NULL)",$db);

echo "newstable created";

$result = mysql_query("CREATE TABLE pa_logging (
   id int(11) NOT NULL auto_increment,
   subject tinytext NOT NULL,
   text text NOT NULL,
   author int(11) DEFAULT '0' NOT NULL,
   stamp int(11) DEFAULT '0' NOT NULL,
   toid int(11) DEFAULT '0' NOT NULL,
   type tinytext NOT NULL,
   ip varchar(30) NOT NULL,
   PRIMARY KEY (id),
   UNIQUE id (id),
   KEY id_2 (id))",$db);

echo "logging table created";

$result = mysql_query("CREATE TABLE pa_tags (
   id int(11) NOT NULL auto_increment,
   tag varchar(10) NOT NULL,
   password tinytext NOT NULL,
   PRIMARY KEY (id),
   UNIQUE id (id),
   KEY id_2 (id))",$db);

echo "tags table created";

echo mysql_error();

?>
