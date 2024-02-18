<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResultDispatches extends Model
{
    protected $table = 'result_dispatches';

    protected $fillable = [
        'client_id',
        'dispatch_id',
        'status',
        'error',
    ];

}