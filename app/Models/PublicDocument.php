<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 *
 */

class PublicDocument extends Model
{
    protected $table = 'public_documents';
    protected $fillable = [
        'order',
        'file_name',
        'doc_type',
        'version',
        'release_month',
        'release_year',
    ];
}
