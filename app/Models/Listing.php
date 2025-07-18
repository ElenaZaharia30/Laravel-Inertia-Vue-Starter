<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    /** @use HasFactory<\Database\Factories\ListingFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tags',
        'email',
        'link',
        'image',
        'approved',

    ];

    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters) {
//        dd($filters);
        if($filters['search'] ?? false){
            $query
                ->where('title', 'like', '%'.request('search').'%')
                ->orWhere('description', 'like', '%'.request('search').'%');
        }
    }
}
