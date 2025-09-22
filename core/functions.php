<?php

function tinhtong($thamso = []){
    $tong = 0;
    foreach($thamso as $value){
        $tong += (int) $value;
    }
    return $tong;
}