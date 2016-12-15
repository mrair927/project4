<?php

namespace Project4;
use Illuminate\Database\Eloquent\Model;



class Task extends Model
{
  public function group() {
    return $this->belongsTo('Project4\Group');
  }
}
