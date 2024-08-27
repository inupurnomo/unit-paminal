<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    use HasFactory;
    protected $fillable = [
      'dumas_id',
      'date',
      'name',
      'address',
      'telephone',
      'is_done',
    ];

    public function dumas() {
      return $this->belongsTo(Dumas::class);
    }
}
