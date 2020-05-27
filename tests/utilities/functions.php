<?php

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times = null, $states = [])
{
    $factory = factory($class, $times);
    
    if ($states) {
        $factory->states($states);
    }

    return $factory->make($attributes);
}
