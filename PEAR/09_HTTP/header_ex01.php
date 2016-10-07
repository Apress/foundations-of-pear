<?php
require_once('HTTP/Client.php');
require_once('HTTP/Header.php');
$client = new HTTP_Client();
$response_code = $client->get('http://localhost/apress/test.php');
$status = HTTP_Header::getStatusType($response_code);
switch ($status) {
    case HTTP_HEADER_STATUS_INFORMATIONAL:
        echo "The page that you requested contains informational data";
        break;
    case HTTP_HEADER_STATUS_REDIRECT:
        echo "The page that you requested redirected to another location";
        break;
    case HTTP_HEADER_STATUS_CLIENT_ERROR:
        echo "There was an error requesting that page";
        break;
    case HTTP_HEADER_STATUS_SERVER_ERROR:
        echo "There was an error on the server requesting the page";
        break;
    case HTTP_HEADER_STATUS_SUCCESSFUL:
    default:
        echo "The page was returned successfully";
}
?>
