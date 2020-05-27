<?php

namespace App\Enum;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class TaskType
{
  public static function __callStatic($name, $arguments)
  {
    $types = self::getTypes();
    $type = Arr::first($types, function ($value, $key) use ($name){
      return Str::lower(str_replace(' ', '', $value['name'])) == Str::lower($name);
    });
    return $type['id'];
  }

  static function getName(int $id) {
    $task_types = config('soc.task_types');
    $type = Arr::first($task_types, function ($value, $key) use ($id){
        return $value['id' ] == $id;
    });

    return $type['name'];
  }

  private static function getTypes()
  {
    return config('soc.task_types');
  }

  static function getAllTypesId()
  {
    return [
      self::theory(),
      self::practical(),
      self::mock(),
    ];
  }
}
