<?php

Breadcrumbs::for('home', function ($trail) {
  $trail->push('Home', route('home'));
});

Breadcrumbs::for('content-repository-list', function ($trail) {
  $trail->parent('home');
  $trail->push('Repositories', route('teacher.content_repository.list'));
});

Breadcrumbs::for('content-repositories', function ($trail) {
  $trail->parent('content-repository-list');
  $trail->push('Create repository', route('teacher.content_repository.store'));
});