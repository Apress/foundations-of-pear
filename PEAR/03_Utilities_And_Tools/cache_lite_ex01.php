<?php
/* Caching a simple string */

require_once 'Cache/Lite.php';

$cacheOptions = array(
	'cacheDir' => '/tmp/',
	'lifeTime' => '7200',
	'pearErrorMode' => CACHE_LITE_ERROR_DIE
	);
	
$cache = new Cache_Lite($cacheOptions);

if ($data = $cache->get('cache_lite_ex01.php'))
{
	echo $data;
}
else
{
	echo '<html><head></head><body>No data!</body></html>';
	/* Stuff some data in the cache so it'll be there the
	 * next time the page is loaded.
	 */
	$data = '<html><head></head><body>Hello, World!</body><html>';
	$cache->save($data);
}

?>
