<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DumasStatus extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'status_id',
      'catatan',
    ];

    public function status() {
      return $this->belongsTo(StatusType::class, 'status_id');
    }
}
