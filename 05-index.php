<?php
$m = new MongoClient;
$c = $m->tutorial->beer;

function createQuery( $c )
{
	$cursor = $c->find();
	$cursor->sort( [ 'rating_score' => -1, 'created_at' => 1 ] );
	$cursor->limit( 10 );

	return $cursor;
}

function doQuery( $c )
{
	$cursor = createQuery( $c );

	foreach( $cursor as $document )
	{
		echo $document['beer_name'], ': ', $document['rating_score'], " @ ";
		echo date_create( "@{$document['created_at']->sec}" )->format('Y-m-d H:i:s');
		//var_dump( $document['created_at']->toDateTime() );
		echo "\n";
	}
}

doQuery( $c );

$cursor = createQuery( $c );
print_r( $cursor->explain() );

$c->createIndex( [ 'rating_score' => -1, 'created_at' => 1 ] );

$cursor = createQuery( $c );
print_r( $cursor->explain() );

$c->deleteIndex( [ 'rating_score' => -1, 'created_at' => 1 ] );
