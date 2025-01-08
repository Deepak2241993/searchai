<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('getTotalCartItems')) {
    function getTotalCartItems()
    {
        $cart = Session::get('cart', []);
        $uniqueIds = [];

        foreach ($cart as $item) {
            if (is_array($item) && isset($item['id'])) {
                $uniqueIds[$item['id']] = true;
            }
        }

        // Count the unique IDs
        return count($uniqueIds);
    }
}
