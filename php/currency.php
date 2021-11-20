<?php
require_once __DIR__ . '/../vendor/autoload.php';
use NumberToWords\NumberToWords;

function convertMoney($amount)
{
    // create the number to words "manager" class
    $numberToWords = new NumberToWords();

    // build a new currency transformer using the RFC 3066 language identifier
    $numberTransformer = $numberToWords->getCurrencyTransformer('ms');
    $ringgit = $numberTransformer->toWords($amount*100, 'MYR');
    $ringgit = strtoupper($ringgit);
    return $ringgit;
}