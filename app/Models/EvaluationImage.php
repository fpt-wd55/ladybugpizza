<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_id',
        'image',
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
