<?php

namespace Project4;

use Illuminate\Database\Eloquent\Model;



class Task extends Model
{
  public function tags()
{
    # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
    return $this->belongsToMany('App\Tag')->withTimestamps();
}
public function user() {
    return $this->belongsTo('App\User');
}
/* End Relationship Methods */
}
