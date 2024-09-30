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
        $value = trim($value);

        // The submitted search term needs a bit more processing if it contains a space...
        $has_space = str_contains($value, ' ');

        if ($has_space) {
            $query->whereHas('owner', function (Builder $query) use ($value) {
                $exploded = explode(' ', $value);
                $first_word = $exploded[0];
                $last_word = end($exploded);

                // Examples below wrap saved first and last name fields
                // in [square brackets]

                $query->where(function ($query) use ($first_word, $last_word) {
                    // A search for 'John Smith' will find [John] [Smith]
                    $query->where('first_name', 'like', "%{$first_word}%")
                          ->where('last_name', 'like', "%{$last_word}%");
                })->orWhere(function ($query) use ($first_word, $last_word) {
                    // A search for 'Sarah Jane' will find [Sarah Jane] [Jones]
                    $query->where('first_name', 'like', "%{$first_word}%")
                          ->where('first_name', 'like', "%{$last_word}%");
                })->orWhere(function ($query) use ($first_word, $last_word) {
                    // A search for 'Smith Jones' will find [John] [Smith Jones]
                    $query->where('last_name', 'like', "%{$first_word}%")
                          ->where('last_name', 'like', "%{$last_word}%");
                });
            });
        } else {
            $query->where('file_name', 'like', "%{$value}%")
                  ->orWhere('doc_type', 'like', "%{$value}%")
                  ->orWhereHas('owner', function (Builder $query) use ($value) {
                      $query->where('first_name', 'like', "%{$value}%")
                            ->orWhere('last_name', 'like', "%{$value}%")
                            ->orWhere('email', 'like', "%{$value}%");
                  });
        }
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
