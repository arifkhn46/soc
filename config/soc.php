<?php

return [
  'administrators' => [
    // Add the email addresses of users who should be administrators here.
    'arifkhn46@gmail.com'
  ],
  'teachers' => [
    // Add the email addresses of users who should be teacher here.
    'jyoti.raman2013@gmail.com'
  ],
  'task_types' => [
      [ 'id' => 1, 'name' => 'Theory'],
      [ 'id' => 2, 'name' => 'Practical'],
      [ 'id' => 3, 'name' => 'Mock']
  ],
  'task_states' => [
    ['id' => 1, 'name' => 'Created'],
    ['id' => 2, 'name' => 'Assigned'],
    ['id' => 3, 'name' => 'In progress'],
    ['id' => 4, 'name' => 'On hold'],
    ['id' => 5, 'name' => 'Completed']
  ],

];