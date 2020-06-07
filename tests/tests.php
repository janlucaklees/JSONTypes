<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/JSONTypes.php';


$skeema = JSONTypes::string();
var_dump( $skeema->isValid('Jan-Luca Klees') );
var_dump( $skeema->isValid('') );

var_dump( $skeema->isValid(null) );
var_dump( $skeema->isValid(1) );
var_dump( $skeema->isValid([]) );


print_r("\n");


$skeema = JSONTypes::string()->isEmailAddress();
var_dump( $skeema->isValid('email@janlucaklees.de') );

var_dump( $skeema->isValid('') );
var_dump( $skeema->isValid(null) );
var_dump( $skeema->isValid(1) );
var_dump( $skeema->isValid([]) );


print_r("\n");


$skeema = JSONTypes::string()->notEmpty();
var_dump( $skeema->isValid('email@janlucaklees.de') );

var_dump( $skeema->isValid('') );
var_dump( $skeema->isValid(null) );
var_dump( $skeema->isValid(1) );
var_dump( $skeema->isValid([]) );



print_r("\n");


$skeema = JSONTypes::object((object) [
    'name'  => JSONTypes::string()->isRequired(),
    'email' => JSONTypes::string()->isEmailAddress()
]);
var_dump( $skeema->isValid((object) [
    'name' => 'Jan-Luca Kless',
]));
var_dump( $skeema->isValid((object) [
    'name'  => 'Jan-Luca Kless',
    'email' => 'email@janlucaklees.de'
]));

var_dump( $skeema->isValid((object) []));
var_dump( $skeema->isValid((object) [
    'name'  => '',
]));
var_dump( $skeema->isValid((object) [
    'name'  => null,
]));
var_dump( $skeema->isValid((object) [
    'name'  => 1337,
]));
var_dump( $skeema->isValid((object) [
    'name'  => 'Jan-Luca Kless',
    'email' => 'not a real mail duh'
]));
var_dump( $skeema->isValid((object) [
    'email' => 'email@janlucaklees.de'
]));
