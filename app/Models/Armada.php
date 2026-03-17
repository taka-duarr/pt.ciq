<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    protected $fillable = ['nama', 'minimal_ton', 'maksimal_ton'];
}
