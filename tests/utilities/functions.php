<?php

function create($class, $attributes = [], $times = null, $states = [])
{
    $factory = factory($class, $times);

    if ($states) {
        $factory->states($states);
    }

    return $factory->create($attributes);
}

function make($class, $attributes = [], $times = null, $states = [])
{
    $factory = factory($class, $times);

    if ($states) {
        $factory->states($states);
    }

    return $factory->make($attributes);
}
