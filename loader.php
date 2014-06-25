<?php
try
{
	$connection = new Mongo('mongodb://<sfera>:<Q1w2e3r4t5>@ds049219.mongolab.com:49219/sfera-mobi');
    $database   = $connection->selectDB('sfera-mobi');
    $collection = $database->selectCollection('sfera-blogs');
} 
catch(MongoConnectionException $e) 
{
    die("Failed to connect to database ".$e->getMessage());
}
?>