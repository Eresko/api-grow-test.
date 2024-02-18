<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dispatch extends Model
{
    protected $table = 'dispatches';

    protected $fillable = [
        'name',
        'daily',
        'time',
        'text',
        'before',
        'after',
    ];

}