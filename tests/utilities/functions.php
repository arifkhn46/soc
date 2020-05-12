<?php

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times = null, $states = [])
{
    return factory($class, $times)->states($states)->make($attributes);
}
