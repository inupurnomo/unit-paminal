<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LHP extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'date',
      'file',
      'is_done',
    ];
}
