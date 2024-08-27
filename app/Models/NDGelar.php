<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NDGelar extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'is_done',
    ];
}
