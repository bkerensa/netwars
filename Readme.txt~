


Installation
------------

First download and install all the necessary tools:
* Apache Web Server(Linux/BSD) OR OmniHTTPd(Windows)
* MySQL
* phpMyAdmin (not required)
* Wget (Linux/BSD only!)

Modify dblogon.php if you have modified your MySQL login
and password.

Open http://localhost/install.php if you have unzipped
the Wassink-Planetarion zip into your server root directory.

If everything seems fine you should delete install.php.

Make sure that ticker.dat is writable.

Modify options.php and set the following:

$mode = "inet";
Can be "inet" or "LAN". Depends on if you will set up
this as a local (LAN) game or an internet game.

$motd = "blablabla";
Edit this to your desired message of the day.


Modify tickah.php and set the following:

$tickertime = 60;
Set this to your desired ticker interval.

$pw = "my_password";
Set this to your desired ticker password.


Now you should be ready to launch the ticker.
* For Windows users:
Open http://localhost/tickah.php?password=my_password&os=windows
where my_password is your password. The ticker should refresh
automatically after your defined ticker interval.

* For Linux/BSD users:
Edit 'ticker' and set your ticker location and ticker interval(sleep 60):
(wget http://localhost/tickah.php?password=my_password --output-file=wgetlog;sleep 60;./ticker)& >> log
Do a 'chmod 777 ticker' in order to make it executable. Run it by typing ./ticker .


Your game should be running fine now. Use phpMyAdmin to edit user accounts etc.

NB!
The source code is not as structured as it should be. You may have a hard time editing
the files to adjust other settings. But hey, It was hard for me too

NOTE!!
When u start the ticker with the tickah.php?pass blabla function it says TICK DONE! 
leave that window open otherwise it won't tick again. that window is the ticker@!
