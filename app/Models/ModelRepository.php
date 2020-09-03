<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelRepository extends Model
{
  protected $table='repository';
  protected $fillable=['name', 'description', 'url'];
}
