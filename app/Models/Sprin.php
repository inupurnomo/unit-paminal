<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprin extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'file',
      'valid_until',
      'is_archived',
    ];
}
