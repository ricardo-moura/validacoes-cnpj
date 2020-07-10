<?php

function createCnpj($barcode) {
    $preCnpj = (string) substr($barcode, 15, 8) . '0001';

    return createCnpjDigits($preCnpj);
}

function createCnpjDigits($cnpj) {
    //First digit
    $j = 5;
    for ($i = 0, $sum = 0; $i < 12; $i++) {
        $sum += (int) $cnpj[$i] * $j;
        $j = $j === 2 ? 9 : $j--;
    }

    $mod = $sum % 11;
    $cnpj[12] = $mod < 2 ? 0 : 11 - $mod;

    //Second digit
    for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
        $sum += (int) $cnpj[$i] * $j;
        $k = $j === 2 ? 9 : $j--;
    }

    $mod = $sum % 11;
    $cnpj[13] = $mod < 2 ? 0 : 11 - $mod;

    return $cnpj;
}

function isValidCnpj($cnpj) {
    if (empty($cnpj)) {
        return false;
    }

    if (strlen($cnpj) !== 14) {
        return false;
    }

    $cnpjLength = strlen($cnpj) - 2;
    $numbers = substr($cnpj, 0, $cnpjLength);
    $digits = substr($cnpj, $cnpjLength);
    $sum = 0;
    $position = $cnpjLength - 7;

    for ($i = $cnpjLength; $i >= 1; $i--) {
        $sumAux = (int) $cnpjLength - $i;
        $sum += (int) substr($numbers, $sumAux, 1) * $position--;
        if ($position >= 2) {
            continue;
        }

        $position = 9;
    }

    $validationResult = $sum % 11 < 2 ? 0 : 11 - $sum % 11;

    if ($validationResult !== (int) substr($digits, 0, 1)) {
        return false;
    }

    $cnpjLength += 1;
    $numbers = substr($cnpj, 0, $cnpjLength);
    $sum = 0;
    $position = $cnpjLength - 7;

    for ($i = $cnpjLength; $i >= 1; $i--) {
        $sumAux = (int) $cnpjLength - $i;
        $sum += (int) substr($numbers, $sumAux, 1) * $position--;
        if ($position >= 2) {
            continue;
        }

        $position = 9;
    }

    $validationResult = $sum % 11 < 2 ? 0 : 11 - $sum % 11;

    return $validationResult === (int) substr($digits, 1, 1);
}
