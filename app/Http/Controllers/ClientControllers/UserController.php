<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\User\FilterUserRequest;
use App\Http\Requests\ClientRequests\User\StoreUserRequest;
use App\Http\Requests\ClientRequests\User\UpdatePasswordRequest;
use App\Http\Requests\ClientRequests\User\UpdateStatusUserRequest;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use App\TraitHelpers\ResourceHelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    use ResourceHelperTrait, ApiResponseTrait, ConfigTrait, DateTrait;

    private $userRepository, $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;

    }

    public function index(FilterUserRequest $request)
    {
        $users = $this->userRepository->handleFilter('*', $request->search_key, $request->role, $request->status_id)->latest('id');
        $users = $this->handlePaginate($users, route('clients.users.index'), $request->only('search_key', 'role', 'status_id'));
        if ($request->ajax()) {
            return $this->handleResourcesResponse(true, ['data' => view(parent::CLIENT_VIEW . 'user.user.index.table', compact('users'))->render()]);
        }
        return view(parent::CLIENT_VIEW . "user.user.index", compact('users'));
    }

    public function info()
    {
        $user = Auth::user();
        return view(parent::CLIENT_VIEW . "user.user.info");

    }

    public function create()
    {
        return view(parent::CLIENT_VIEW . "user.user.create");
    }

    public function store(StoreUserRequest $request)
    {
        $created = $this->userService->store($request->only('name', 'phone', 'email', 'password', 'status_id'), $request->role);
        if ($created) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Tạo :module thành công!', ['module' => 'người dùng'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Tạo :module thất bại!', ['module' => 'người dùng'])]));
    }

    public function edit($id)
    {
        $user = $this->userRepository->findOrFail($id);
        return view('client.user.user.edit', compact('user'));
    }

    public function update(StoreUserRequest $request, $id)
    {
        $user = $this->userService->update($id, $request->only('name', 'phone', 'email', 'status_id'), $request->role);
        if ($user) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Sửa :module thành công!', ['module' => 'thông tin người dùng'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Sửa :module thất bại!', ['module' => 'thông tin người dùng'])]));
    }

    public function editPassword($id = null)
    {
        if ($id == null) {
            $user = \Auth::user();
            return view('client.user.user.edit-logged-password');
        }
        $user = $this->userRepository->findOrFail($id);
        return view('client.user.user.edit-password', compact('user'));
    }

    public function updatePassword(UpdatePasswordRequest $request, $id = null)
    {
        $userLogged = \Auth::user();
        if ($id == null) {
            $id = $userLogged->id;
        }
        $updated = $this->userRepository->update($id, ['password' => bcrypt($request->re_new_password)]);
        if ($updated) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Đổi mật khẩu thành công!')]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Đổi mật khẩu thất bại!')]));
    }

    public function updateStatus(UpdateStatusUserRequest $request, $userId)
    {
        $updated = $this->userRepository->update($userId, ['status_id' => $request->status]);
        if ($updated) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Thay đổi :action thành công!', ['action' => 'trạng thái'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Thay đổi :action thất bại!', ['action' => 'trạng thái'])]));
    }

    public function destroy($id)
    {
        $deleted = $this->userRepository->delete($id);
        if ($deleted) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Xoá :module thành công!', ['module' => 'người dùng'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Xoá :module thất bại!', ['module' => 'người dùng'])]));
    }


    public function search(Request $request)
    {
        $users = [];
        if ($request->search != null) {
            $type = null;
            $status = $request->status;
            $users = $this->userRepository->handleFilter(['id', 'name', 'username'], $request->search, $type, $status)->get();
            $users = $users->map(function ($user) {
                return ['id' => $user->id, 'text' => "{$user->username}({$user->name})"];
            });
        }
        return response()->json(['items' => $users]);
    }
}
