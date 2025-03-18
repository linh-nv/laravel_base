<?php


namespace App\Services\User;


use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserServiceImp implements UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function store($user, $roleName)
    {
        DB::beginTransaction();
        try {
            $user['password'] = bcrypt($user['password']);
            $user = $this->userRepository->create($user);
            $user->syncRoles([$roleName]);
            $role = Role::findByName($roleName);
            $permissions = $role->permissions()->get();
            $user->syncPermissions($permissions);
            DB::commit();
            return $user;
        } catch (\Exception $exception) {
            Log::error("Create new user has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $newUserInfo, $roleName)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->findOrFail($id);
            $user->update($newUserInfo);
            if (!$user->hasRole($roleName)) {
                $user->syncRoles([$roleName]);
                $role = Role::findByName($roleName);
                $permissions = $role->permissions()->get();
                $user->syncPermissions($permissions);
            }
            DB::commit();
            return $user;
        } catch (\Exception $exception) {
            Log::error("Update user has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }

    }


}
