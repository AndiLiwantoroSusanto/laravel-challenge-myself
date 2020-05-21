<?php

if(!function_exists('push_array_assosiative')) {
    function push_array_assosiative(&$array,$key,$data)
    {
        if(!array_key_exists($key,$array))
        {
            $array[$key] = [$data];
        }
        else
        {
            array_push($array[$key],$data);
        }
    }
}