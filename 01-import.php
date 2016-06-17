<?php
require 'vendor/autoload.php';

$m = new \MongoDB\Client;
$d = $m->tutorial;
$c = $d->beer;
$c->drop();

foreach ( file( 'untappd.json' ) as $checkin )
{
	$document = json_decode( $checkin );
	$c->insertOne( $document );
}
