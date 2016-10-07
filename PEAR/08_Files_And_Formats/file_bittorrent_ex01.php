<?php
/* Make a BitTorrent file. */

require_once 'File/Bittorrent/Maketorrent.php';
require_once 'File.php';

PEAR::setErrorHandling(PEAR_ERROR_PRINT);

$torrent = new File_Bittorrent_Maketorrent('C:\\tmp\\myfile.iso');
$torrent->setAnnounce('http://localhost/~Nathan/torrents');
$torrent->setComment('This is my test!');
$torrent->setPieceLength(256);
$meta = $torrent->buildTorrent();

File::write('test.torrent', $meta, FILE_MODE_WRITE);

?>
