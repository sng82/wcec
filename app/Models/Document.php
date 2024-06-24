<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */

class Document extends Model
{
//    use HasFactory;

//    public mixed $file_name;
//    public mixed $user_id;


    protected $table = 'documents';
    protected $fillable = [
        'title',
        'file_name',
        'file_location',
        'doc_type',
        'user_id',
        'eoi_id'
    ];

    public function ownedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
