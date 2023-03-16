<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QAnswer extends Model
{
    use HasFactory;
    protected $table = 'qanswers';
    public $timestamps = false;

    public function question(){
        return $this->belongTo(QQuestion::class, 'question_id');
    }
}
