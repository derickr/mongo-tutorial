printjson( db.beer.dropIndex( { 'rating_score' : -1, 'created_at' : 1 } ) );

printjson( db.beer.find().sort( { 'rating_score' : -1, 'created_at' : 1 } ).limit( 10 ).toArray() );

printjson( db.beer.find().sort( { 'rating_score' : -1, 'created_at' : 1 } ).limit( 10 ).explain() );

printjson( db.beer.createIndex( { 'rating_score' : -1, 'created_at' : 1 } ) );

printjson( db.beer.find().sort( { 'rating_score' : -1, 'created_at' : 1 } ).limit( 10 ).explain() );

printjson( db.beer.dropIndex( { 'rating_score' : -1, 'created_at' : 1 } ) );
