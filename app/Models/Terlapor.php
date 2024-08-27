<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terlapor extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'name',
      'date',
      'is_done',
    ];

    public function dumas() {
      return $this->belongsTo(Dumas::class, 'dumas_id');
    }
}
