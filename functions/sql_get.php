<?php
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_profile($column = "")
{
    include("db_predential.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
    $sqlfind = "SELECT * FROM users WHERE id = " . $_COOKIE["uid"];
    foreach ($conn->query($sqlfind) as $row)
    {
        if (!empty($column)) return $row[$column];
        else
        {
            $result['id'] = $row['id'];
            $result['fullName'] = $row['fullName'];
            $result['password'] = $row['password'];
            $result['email'] = $row['email'];
            $result['gender'] = $row['gender'];
            $result['phone'] = $row['phone'];
            $result['typeIdCard'] = $row['typeIdCard'];
            $result['numberIdCard'] = $row['numberIdCard'];
            $result['dateOfBirth'] = $row['dateOfBirth'];
            $result['dateJoined'] = $row['dateJoined'];
            return $result;
        }
    }
}