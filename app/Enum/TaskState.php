<?php

namespace App\Enum;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class TaskState
{

  public static function __callStatic($name, $arguments)
  {
    $states = self::getStates();
    $state = Arr::first($states, function ($value, $key) use ($name){
      return Str::lower(str_replace(' ', '', $value['name'])) == Str::lower($name);
    });
    return $state['id'];
  }

  public static function getName(int $id)
  {
    $states = self::getStates();
    $state = Arr::first($states, function ($value, $key) use ($id){
      return $value['id'] == $id;
    });
    return $state['name'];
  }

  private static function getStates()
  {
    return config('soc.task_states');
  }

  public static function getAllStateIds()
  {
    return [
      self::created(),
      self::assigned(),
      self::inProgress(),
      self::onHold(),
      self::completed()
    ];
  }
}

