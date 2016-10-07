<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_idpreg($input) {
    switch($input)
    {
        case 1:
            return "/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/";
        case 2:
            return "/^[A-Z0-9]{1,9}$/";
        case 3:
            return "/^(H|M)\d{8}$/";
        case 4:
            return "/^d{8}$/";
        default:
            return "//";
    }
}