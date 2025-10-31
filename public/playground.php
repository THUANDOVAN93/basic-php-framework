<?php

use Illuminate\Support\Collection;

require __DIR__.'/../vendor/autoload.php';

$numbers = [1, 2, 5, 7, 8, 12, 1];

function maxSumSubArray($numbers, $subLength)
{
    $maxSum = 0;
    $windowSum = 0;

    for ($i = 0; $i < $subLength; $i++) {
        $windowSum += $numbers[$i];
    }
    $maxSum = $windowSum;

//    for ($i = $subLength; $i < count($numbers); $i++) {
//    }

}