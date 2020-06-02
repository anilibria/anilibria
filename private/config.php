<?php
$conf['start'] = microtime(true);

$conf['memcache']	= ['/tmp/memcached.socket', 0];

$conf['mysql_host'] = 'localhost';
$conf['mysql_user'] = 'anilibria';
$conf['mysql_pass'] = 'anilibria';
$conf['mysql_base'] = 'anilibria';

$conf['email'] = 'poiuty@poiuty.com';
$conf['email_from'] = 'Test anilibria';

// v3
$conf['recaptcha_secret'] = 'secret';
$conf['recaptcha_public'] = 'public';

// v2
$conf['recaptcha2_secret'] = 'secret';
$conf['recaptcha2_public'] = 'public';

$conf['hash_len'] = 64;
$conf['hash_algo'] = 'sha256';

$conf['torrent_secret'] = 'secret';
$conf['torrent_announce'] = 'http://tt.anilibria.tv:2710/announce';

$conf['sphinx_host'] = '127.0.0.1';
$conf['sphinx_port'] = '9306';

$conf['stat_url'] = 'https://ws.poiuty.com/ws/';
$conf['stat_secret'] = 'secret';

$conf['nginx_domain'] = 'https://x.anilibria.tv';
$conf['nginx_secret'] = 'secret';

$conf['youtube_secret'] = 'secret';

$conf['push_all'] = 'secret';
$conf['push_sanasol'] = 'secret';

$conf['fcm_token'] = "secret";

$conf['api_v2'] = 'localhost:99';