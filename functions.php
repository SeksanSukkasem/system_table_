<?php
include_once("config.php");

// insert student

// data validation

// 0 ok
// 1 required keys not found
//

function load_data($conn, $table, $condition=[]) {
    $data = $conn->query("SELECT * FROM $table");
    return $data;
}

function insert($conn, $data, $fields) {

    foreach ( $fields['required'] as $key ) {

        if ( !array_key_exists($key, $data) ) {
            return [ 'success' => false, 'error' => "$key is required" ];
        } 
        elseif ( ! $data[$key] ) {
            return [ 'success' => false, 'error' => "$key is required! please enter value" ];
        }
    }

    $values = [];
    foreach ( $fields['fields'] as $key) {
        $values[$key] = $data[$key];
    }

    $keys = implode(', ', $fields['required']);
    $value = " :".implode(', :', $fields['required']);
    // สำหรับเปลี่ยนแปลงข้อมูล
    $sql = "INSERT INTO $fields[table] ($keys) 
    VALUE ( $value );";
    $stm = $conn->prepare( $sql );
    $stm->execute($values);

    return [ 'success' => true ];
}

function set_fields( $key ) {
    return "$key = :$key";
}

function update($conn, $data, $fields) {

    foreach ( $fields['required'] as $key ) {
        if ( !array_key_exists($key, $data) ) {
            return [ 'success' => false, 'error' => "$key is required" ];
        } 
        elseif ( ! $data[$key] ) {
            return [ 'success' => false, 'error' => "$key is required! please enter value" ];
        }
    }

    $values = [];
    foreach ( $fields['required'] as $key) {
        $values[$key] = $data[$key];
    }
    foreach ( $fields['fields'] as $key) {
        $values[$key] = $data[$key];
    }
    
    $fs = array_map( 'set_fields', $fields['required']  );
    $required = implode(", ", $fs);
    $fs = array_map( 'set_fields', $fields['fields']  );
    $keys = implode(", ", $fs);

    // สำหรับเปลี่ยนแปลงข้อมูล
    $sql = "UPDATE $fields[table] SET $keys WHERE $required ";
    $stm = $conn->prepare( $sql );
    $stm->execute( $values );

    return [ 'success' => true ];
}

function delete($conn, $data, $fields) {

    foreach ( $fields['required'] as $key ) {
        if ( !array_key_exists($key, $data) ) {
            return [ 'success' => false, 'error' => "$key is required" ];
        } 
        elseif ( ! $data[$key] ) {
            return [ 'success' => false, 'error' => "$key is required! please enter value" ];
        }
    }
    
    $values = [];
    foreach ( $fields['required'] as $key) {
        $values[$key] = $data[$key];
    }

    $fs = array_map( 'set_fields', $fields['required']  );
    $required = implode(", ", $fs);

    $sql = "DELETE FROM $fields[table] WHERE $required";
    $stm = $conn->prepare( $sql );
    $stm->execute( $values );

}