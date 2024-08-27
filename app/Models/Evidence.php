<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;

    protected $fillable = [
      'dumas_id',
      'name',
      'type_id',
      'file',
      'is_done',
    ];

    public function type() {
      return $this->belongsTo(EvidenceType::class);
    }
}
