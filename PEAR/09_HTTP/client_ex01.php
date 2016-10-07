<?php
require_once 'HTTP/Client.php';
$client = new HTTP_Client();
$data = array();
$data['name'] = 'allan';
$data['email'] = 'allan@mediafrenzy.co.za';

$response_code = $client->post('http://localhost/apress/postdata.php', $data);

echo $response_code; ?>
