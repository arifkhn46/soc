<?php

namespace App\Enum;

use Illuminate\Support\Arr;

final class TaskType  
{
  // public static function __callStatic($name, $arguments)
  // {
    
  // }

  static function getName(int $id) {
    $task_types = config('soc.task_types');
    $type = Arr::first($task_types, function ($value, $key) use ($id){
        return $value['id' ] == $id;
    });

    return $type['name'];
  }
}
