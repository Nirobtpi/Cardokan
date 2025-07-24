<?php

use App\Models\StripePayment;

if (!function_exists('get_class_name')) {
    function get_class_name($class_name)
    {
        return $class_name;
    }
}

// stripe load data
if(!function_exists('get_stripe_key')){
    function get_stripe_key($key){
        $data= StripePayment::first();
        return $data ? $data->$key :'';
    }
}
?>
