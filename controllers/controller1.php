<?php
function bookfunction()
{
    $book = new book();

    $book->Get(26);  //Gets book whose id is 1
    $result = "<h1>Mon livre</h1><br><p>titre : ".$book->title ."</p>";
    return $result;  //This should output "Php is very cool"
}

$_SESSION['result'] = bookfunction();


function customerfunction(){
    $customer = new customer();

    $customer->Get(1);  //Gets customer whose id is 1
    $result = "<h1>Mon customer</h1><br><p>titre : ".$customer->title ."</p>";
    return $result;  //This should output "Php is very cool"
}

$_SESSION['result'] = customerfunction();

session_destroy();