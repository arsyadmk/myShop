<?php
if (!function_exists('store_type')) {
    function store_type($value)
    {
        if ($value == 0) {
            return "Pusat";
        } elseif ($value == 1) {
            return "Cabang";
        } elseif ($value == 2) {
            return "Retail";
        } else {
            return "Error";
        }
    }
}

if (!function_exists('jenis_user')) {
    function jenis_user($value)
    {
        if ($value == 0) {
            return "Super Admin";
        } elseif ($value == 1) {
            return "Admin";
        } elseif ($value == 2) {
            return "Cashier";
        }
    }
}