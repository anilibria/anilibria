#!/usr/bin/php
<?php
require('/var/www/anilibria/root/private/config.php');
require('/var/www/anilibria/root/private/init/mysql.php');
require('/var/www/anilibria/root/private/init/sphinx.php');
require('/var/www/anilibria/root/private/init/memcache.php');
require('/var/www/anilibria/root/private/func.php');
require('/var/www/anilibria/root/private/auth.php');

countRating();
updateGenreRating();
showSitemap();
