<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanGelar extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'file',
      'is_done',
    ];
}
