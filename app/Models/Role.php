<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id_role';

    protected $fillable = [
        'nama_role',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_role', 'id_role');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
}
