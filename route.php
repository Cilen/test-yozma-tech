<?php

function route($data){
    switch ($data['filter']){
        case "name":
            $responseData = User::getUsersByName($data['value']);
            break;
        case "interest":
            $responseData = User::getUsersByInterest($data['value']);
            break;
        default:
            $responseData = User::getAllUsers();
            break;
    }
    return $responseData;
}