<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelTraffic extends Model
{
  protected $table='traffic';
  protected $fillable=['visitor', 'visits'];
}