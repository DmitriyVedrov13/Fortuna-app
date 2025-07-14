<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FortunePhrase extends Model
{
    protected $table = 'fortune_phrases';

    protected $fillable = ['phrase'];

    public $timestamps = true; // created_at включен
}
