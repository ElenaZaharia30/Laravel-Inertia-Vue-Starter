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

    public function scopeFilter($query, array $filters): void
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        if ($filters['user_id'] ?? false) {
            $query->where('user_id', $filters['user_id']);
        }
    }

}
