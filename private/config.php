<?php
$conf['start'] = microtime(true);

$conf['memcache']	= ['/tmp/memcached.socket', 0];

$conf['mysql_host'] = getenv('MYSQL_HOST', true) ?: 'localhost';
$conf['mysql_user'] = getenv('MYSQL_USERNAME', true) ?: 'anilibria';
$conf['mysql_pass'] = getenv('MYSQL_PASSWORD', true) ?: 'anilibria';
$conf['mysql_base'] = getenv('MYSQL_DATABASE', true) ?: 'anilibria';

$conf['email'] = getenv('EMAIL_FROM', true) ?: 'poiuty@poiuty.com';
$conf['email_from'] = getenv('EMAIL_NAME', true) ?: 'Test anilibria';

// v3
$conf['recaptcha_secret'] = getenv('RECAPTCHA2_SECRET', true) ?: 'secret';
$conf['recaptcha_public'] = getenv('RECAPTCHA2_PUBLIC', true) ?: 'public';

// v2
$conf['recaptcha2_secret'] = getenv('RECAPTCHA3_SECRET', true) ?: 'secret';
$conf['recaptcha2_public'] = getenv('RECAPTCHA3_PUBLIC', true) ?: 'public';

$conf['hash_len'] = 64;
$conf['hash_algo'] = 'sha256';

$conf['torrent_secret'] = getenv('TORRENT_SECRET', true) ?: 'secret';
$conf['torrent_announce'] = getenv('TORRENT_ANNOUNCE', true) ?: 'http://tt.anilibria.tv:2710/announce';

$conf['sphinx_host'] = getenv('SPHINX_HOST', true) ?: '127.0.0.1';
$conf['sphinx_port'] = getenv('SPHINX_PORT', true) ?: '9306';

$conf['stat_url'] = getenv('STAT_URL', true) ?: 'https://ws.poiuty.com/ws/';
$conf['stat_secret'] = getenv('STAT_SECRET', true) ?: 'secret';

$conf['nginx_domain'] = getenv('NGINX_BASE', true) ?: 'https://x.anilibria.tv';
$conf['nginx_secret'] = getenv('NGINX_SECRET', true) ?: 'secret';

$conf['youtube_secret'] = getenv('YOUTUBE_SECRET', true) ?: 'secret';

$conf['push_all'] = getenv('PUSHALL_SECRET', true) ?: 'secret';
$conf['push_sanasol'] = 'secret';
