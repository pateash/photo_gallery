<?php
require_once("../../includes/includes_admin.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user=User::find_by_id(2);
var_dump($user);
$user->delete();
var_dump($user);


?>

