<?php
require("vendor/autoload.php");
$openapi = \OpenApi\scan('API.json');
header('Content-Type: application/json');
echo $openapi->JSON();
