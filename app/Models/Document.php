<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
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
