<?php 
include_once( "config.php" );
$fields = [
    'required' => ['s_id', 'name', 'faculty'],
    'fields' => ['name', 'faculty']
];

// " name=:name, faculty=:faculty "

function set_fields( $key ) {
    return "$key = :$key";
}
$fs = array_map( 'set_fields', $fields['fields']  );
$str = implode(", ", $fs);
echo "<pre>";
var_dump($fs);
var_dump($str);
echo "</pre>";