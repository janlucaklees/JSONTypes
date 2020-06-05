<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'JSONTypes.php';


const MAIL_REGEX = '/^\S+@\S+\.\S{2,3}$/';

$skeema = JSONTypes::string();
var_dump( $skeema->isValid('Jan-Luca Klees') );
var_dump( $skeema->isValid('') );

var_dump( $skeema->isValid(null) );
var_dump( $skeema->isValid(1) );
var_dump( $skeema->isValid([]) );


print_r("\n");


$skeema = JSONTypes::string()->matches(MAIL_REGEX);
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
