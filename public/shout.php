<?php

// Set headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

require '../bootstrap.php';

// No quotes loaded ?
$data = (new Quotes\Data\JsonResource('../data/quotes.json'))->toArray();
if (empty($data['quotes'])) {
    die(json_encode([
        'error' => 'No quotes loaded'
    ]));
}

// Can't show display more that 10 quotes ?
$limit = empty($_GET['limit']) ? 0 : intval($_GET['limit']);
if ($limit && $limit > 10) {
    die(json_encode([
        'error' => "Can't show display more that 10 quotes"
    ]));
}

// Process author's quotes shout  
Quotes\API\Shouter::getInstance()->processRequest(
    'GET', 
    $_GET['id'], 
    $data['quotes']
);
