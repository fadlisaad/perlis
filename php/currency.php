<?php
require_once __DIR__ . '/../vendor/autoload.php';
use TNkemdilim\MoneyToWords\Converter;
use TNkemdilim\MoneyToWords\Languages as Language;

function convertMoney($amount)
{
    $converter = new Converter("ringgit", "sen", Language::MALAY);
    $ringgit = $converter->convert($amount);
    $ringgit = str_replace(',', '', $ringgit);
    $ringgit = str_replace('hanya', 'sahaja', $ringgit);
    $ringgit = strtoupper($ringgit);
    return $ringgit;
}