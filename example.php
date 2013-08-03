<?php


/**
 * Include the Pdofy class so that you can create its objects
 * Recommended to use `require` over `require_once` for its performance gain
 * Recommended to use `require` over `include` as former shall exit on failure
 */
require './pdofy.php';


/**
 * Include the information to connect to the Database
 * $host - Hostname, normally 'localhost'
 * $dbName - Name of the Database
 * $user - Database username
 * $pass - Database password
 */
$host   = 'localhost';
$dbName = 'pdofy';
$user   = 'pdofyUser';
$pass   = 'pdofyPass';


/**
 * Create the Pdofy object to connect to the database
 */
$db = new Pdofy($host, $dbName, $user, $pass);


/**
 * A simple database statement to insert data into the table
 * Rather than using string concatenation to construct the statement,
 * use parameterized queries as shown below
 * This simple database statement shall insert an `email` into the table
 */
$query = 'INSERT INTO tableName(email) VALUES(:email)';
$array = array(
  'email' => 'pdofy_user@pdofy.com'
);
$db->queryDb($query, $array);


/**
 * A simple database statement to delete data from the table
 * Rather than using string concatenation to construct the statement,
 * use parameterized queries as shown below
 * This simple database statement shall delete a row from the table,
 * that matches the email
 */
$query = 'DELETE FROM tableName WHERE email = :email';
$array = array(
  'email' => 'pdofy_user@pdofy.com'
);
$db->queryDb($query, $array);


/**
 * A simple database statement to delete the table
 * This method does not require any extra parameters
 */
$query = 'DROP TABLE tableName';
$db->queryDb($query);


/**
 * A simple database statement to query the table
 * Rather than using string concatenation to construct the statement,
 * use parameterized queries as shown below
 * This simple database statement shall retrieve an email
 * that matches the id and display it
 */
$query = 'SELECT email FROM tableName WHERE id = :id';
$array = array(
  'id' => 1
);
print_r($db->fetchRow($query, $array));


/**
 * A simple database statement to query the table
 * Rather than using string concatenation to construct the statement,
 * use parameterized queries as shown below
 * This simple database statement shall retrieve all emails
 * from the table and display
 */
$query = 'SELECT email FROM tableName';
print_r($db->fetchRow($query));


/**
 * A simple database statement to query the table
 * Rather than using string concatenation to construct the statement,
 * use parameterized queries as shown below
 * This simple database statement shall retrieve all emails
 * from the table that matches the condition and display it in column form
 */
$query = 'SELECT email FROM tableName WHERE id >= :id';
$array = array(
  'id' => 1
);
print_r($db->fetchColumn($query, $array));


/**
 * A simple database statement to query the table
 * Rather than using string concatenation to construct the statement,
 * use parameterized queries as shown below
 * This simple database statement shall retrieve all emails
 * from the table that matches the condition and display it in column form
 */
$query = 'SELECT name, email FROM tableName WHERE id >= :id';
$array = array(
  'id' => 1
);
print_r($db->fetchColumn($query, $array, $arg = 1));