<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    protected $fillable = ['role_id', 'name', 'email', 'password', 'phone_number'];

    protected $table = 'users';

    protected $hidden = ['password', 'remember_token'];

    public function role(): BelongsTo
    {
        return $this->belongsTo(RoleModel::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(EventModel::class, 'user_id');
    }
}
