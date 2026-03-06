Purpose
=======

DBGStatus is a PHP script that will poll the DBG census server to get the status of specified DBG games servers

Current Supported Games
=======================
* DC Universe Online
* EverQuest
* EverQuest 2
* H1Z1:Just Survive
* H1Z1:King of the Kill
* Landmark
* PlanetSide 2

Server Requirements
===================

* PHP 5 w/ allow_url_fopen = On

Installation
============

* Signup for a Service ID from DBG at http://census.daybreakgames.com/#service-id
* Check out the git repository (`git clone https://github.com/Manvaril/dbgstatus/`)
* Edit the top half of the script labeled "Script Config" with your Service ID and the game you would like to see
* Upload status.php to your webserver
* Point your browser to status.php
