<?php
require 'vendor/autoload.php';

$m = new \MongoDB\Client;
$d = $m->tutorial;
$c = $d->beer;
$c->drop();

foreach ( file( 'untappd.json' ) as $checkin )
{
	$document = json_decode( $checkin );
	foreach ( [ 'beer_abv', 'beer_ibu', 'venue_lat', 'venue_lng', 'rating_score' ] as $field )
	{
		$document->$field = (float) $document->$field;
	}
	$document->created_at = new \MongoDB\BSON\UTCDateTime( strtotime( $document->created_at ) * 1000 );
	$c->insertOne( $document );
}
