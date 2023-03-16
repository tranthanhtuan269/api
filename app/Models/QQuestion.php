<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QQuestion extends Model
{
    use HasFactory;
    protected $table = 'qquestions';
    public $timestamps = false;

    public function answers(){
        return $this->hasMany(QAnswer::class, 'question_id');
    }
}
