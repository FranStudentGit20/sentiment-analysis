<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sentiment extends Model
{
    protected $fillable = ['text', 'sentiment'];
}
