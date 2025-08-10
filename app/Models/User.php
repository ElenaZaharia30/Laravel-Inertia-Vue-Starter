<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Relations\HasMany;
 use Illuminate\Database\Eloquent\Relations\HasOne;
 use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function listings(): HasMany{
        return $this->hasMany(Listing::class);
    }

    public function isAdmin(): bool{
        return $this->role === 'admin';
    }

    public function scopeFilter($query, array $filters){
        if(isset($filters['search']) ?? false){
            $query->where(function($q) use($filters){
                $q->where('name', 'like', '%'.$filters['search'].'%')
                    ->orWhere('email', 'like', '%'.$filters['search'].'%');
            });
        }

        if(isset($filters['user_role']) ?? false){
            $query->where('role', $filters['user_role']);
        }
    }

}
