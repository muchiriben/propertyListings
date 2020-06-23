<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
     //Table Name
     protected $table = 'properties';
     //primarykey
     public $primaryKey = 'property_id';
     //timestamps
     public $timestamps = true;
 
     public function user(){
         return $this->belongsTo('App\User');
     }
}
