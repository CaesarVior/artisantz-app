<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleModel extends Model
{
    protected $fillable = ['name'];

    protected $table = 'roles';

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
