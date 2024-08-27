<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDinas extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'number',
      'file',
      'is_archived',
    ];
}
