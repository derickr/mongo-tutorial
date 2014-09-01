<?php
$m = new MongoClient;

$c = $m->tutorial->beer;

/* > db.beer.aggregate( [ { $group: { _id: '$beer_type', rating: { $avg: '$rating_score' }, c: { $sum: 1 } } }, { $match: { c: { '$gte': 5 } } }, { $sort: { rating: -1 } } ] );
 */
$res = $c->aggregate( [
	[ '$group' => [ 
		'_id' => '$beer_type', 
		'rating' => [ '$avg' => '$rating_score'], 
		'count' => [ '$sum' => 1 ] 
	] ],
	[ '$match' => [
		'count' => [ '$gte' => 5 ]
	] ],
	[ '$sort' => [
		'rating' => -1
	] ],
	[ '$limit' => 8 ],
] );

foreach( $res['result'] as $result )
{
	printf( "%s: %.2f\n", $result['_id'], $result['rating'] );
}
?>
