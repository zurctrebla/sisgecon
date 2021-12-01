<?php

namespace App\Models\Traits;

trait UserACLTrait
{
    public function permissions()
    {
        $role = $this->role()->first();

        $permissions = [];

        foreach ($role->permissions as $permission) {
            array_push($permissions, $permission->name);
        }

        return $permissions;
    }

    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }
}
