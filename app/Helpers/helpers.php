<?php

if (!function_exists('terbilang')) {
    function terbilang($number)
    {
        return \App\Helpers\Terbilang::rupiah($number);
    }
}
