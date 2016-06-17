<?php
require 'vendor/autoload.php';

$m = new \MongoDB\Client;
$d = $m->tutorial;
$c = $d->beer;

$document = $c->findOne( [ 'beer_name' => 'USA Hells' ] );
echo date_create( $document['created_at'] )->format( 'Y-m-d' ), "\n\n";

$cursor = $c->find(
	[ 'rating_score' => [ '$gte' => '4.5' ] ],
	[ 
		'projection' => [ 'beer_name' => 1, 'rating_score' => 1, 'created_at' => 1 ],
		'sort' => [ 'rating_score' => -1, 'created_at' => 1 ]
	]
);

foreach ( $cursor as $document )
{
	echo $document['beer_name'], "\n", 
		$document['rating_score'],  ' - ',
		$document['created_at'], "\n";
}
?>
