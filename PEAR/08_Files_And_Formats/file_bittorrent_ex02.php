<?php
/* Decoding a torrent file */

require_once 'File/Bittorrent/Decode.php';

$decode = new File_Bittorrent_Decode();

$fileInfo = $decode->decodeFile('/Users/Nathan/ubuntu-5.10-install-powerpc.iso.torrent');

print_r($fileInfo);

?>
