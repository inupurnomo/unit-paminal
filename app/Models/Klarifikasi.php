<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klarifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'date',
      'is_done',
    ];
}
