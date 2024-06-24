<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */

class EOI extends Model
{
//    use HasFactory;

//    public mixed $id;

    protected $table = 'expression_of_interests';

    protected $fillable = [
        'user_id',
        'current_role',
        'employment_history',
        'qualifications',
        'training',
    ];
}
