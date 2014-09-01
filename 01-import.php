<?php
$m = new MongoClient;
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
	$document->created_at = new MongoDate( strtotime( $document->created_at ) );
	$c->insert( $document );
}
