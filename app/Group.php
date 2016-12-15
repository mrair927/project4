<?php

namespace Project4;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  public function tasks() {
    return $this->hisMany('Project4\Task');
  }
}
