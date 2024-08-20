<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 * @mixin IdeHelperDocument
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

    public function scopeSearch($query, $value)
    {
        $query->where('file_name', 'like', "%{$value}%")
              ->orWhere('doc_type', 'like', "%{$value}%")
              ->orWhereHas('owner', function (Builder $query) use ($value) {
                  $query->where('first_name', 'like', "%{$value}%")
                        ->orWhere('last_name', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%");
              });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
//        return $this->belongsTo(User::class);
    }
}
