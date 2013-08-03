<?php
/*
 * This is a PHP library that handles MySQL database operations.
 *
 * COPYRIGHT(c) 2013
 * AUTHOR: Robin Thomas
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

 
/**
 * Throws a PDO Exception whenever a warning or error occurs
 * @param $errNo - SQLSTATE error code
 * @param $errStr - The exception message
 */
function PdofyErrors($errNo, $errStr) {
  throw new PDOException($errStr, $errNo);
}


/**
 * Sets the custom error handler
 * @param - Custom Error Handler defined above
 */
set_error_handler('PdofyErrors');


/**
 * Class to handle the various MySQL database operations
 * @property $pdo - Property to store the PDO object
 * @property $stmt - Property to store the result set of MySQL query
 */
class Pdofy {

  private $pdo;
  private $stmt;

  /**
   * Class constructor to create a PDO object and connect to the database
   * @param $host - Hostname, normally 'localhost'
   * @param $dbName - Name of the Database
   * @param $user - Database username
   * @param $pass - Database password
   */
  function __construct($host, $dbName, $user, $pass) {
    try {
      $this->pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  /**
   * Class method to execute a MySQL query
   * @param $query - string containing the parameterized MySQL query
   * @param $array - array comtaining the elements for parameterized MySQL query
   */
  function queryDb($query, $array = array()) {
    try {
      $this->stmt = $this->pdo->prepare($query);
      $this->stmt->execute($array);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  /**
   * Class method to query the database and return results as rows
   * @param $query - string containing the parameterized MySQL query
   * @param $array - array containing the elements for parameterized MySQL query
   * @param $arg - PDO fetch style (Supports PDO::FETCH_ASSOC, PDO::FETCH_BOTH, PDO::FETCH_NUM)
   * @return $row - array containing the results of the query in row form
   */
  function fetchRow($query, $array = array(), $arg = PDO::FETCH_ASSOC) {
    try {
      $this->stmt = $this->pdo->prepare($query);
      $this->stmt->execute($array);
      $row = $this->stmt->fetchAll($arg);
      if (count($row) == 1) {
        foreach ($row[0] as $key => $value) {
          $rw[$key] = $value;
        }
        $row = $rw;
      }
      return $row;
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  /**
   * Class method to query the database and return results as columns
   * @param $query - string containing the parameterized MySQL query
   * @param $array - array containing the elements for parameterized MySQL query
   * @param $arg - column number
   * @return $row - array containing the results of the query in column form
   */
  function fetchColumn($query, $array = array(), $arg = 0) {
    try {
      $this->stmt = $this->pdo->prepare($query);
      $this->stmt->execute($array);
			$row = $this->stmt->fetchAll(PDO::FETCH_COLUMN, $arg);
      return $row;
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  /**
   * Class destrcutor to destruct the object and clear the memory
   */
  function __destruct() {
    $this->pdo = null;
    $this->stmt = null;
    $this->err = null;
  }

}