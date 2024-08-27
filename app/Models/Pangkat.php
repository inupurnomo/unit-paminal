<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
  use HasFactory;

  protected $fillable = [
    'nama_pangkat',
    'logo_pangkat'
  ];
}
