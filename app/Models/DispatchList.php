<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DispatchList extends Model
{
    protected $table = 'dispatch_list';

    protected $fillable = [
        'client_id',
        'dispatch_id'
    ];

}