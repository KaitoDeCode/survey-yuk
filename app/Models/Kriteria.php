<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded=[

    ];

    public function survei()
    {
        return $this->belongsTo(Survei::class);
    }
}
