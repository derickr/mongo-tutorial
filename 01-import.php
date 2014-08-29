<?php
$m = new MongoClient;
$d = $m->tutorial;
$c = $d->beer;
$c->drop();

foreach ( file( 'untappd.json' ) as $checkin )
{
	$document = json_decode( $checkin );
	$c->insert( $document );
}
