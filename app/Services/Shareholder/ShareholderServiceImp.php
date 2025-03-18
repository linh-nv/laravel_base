<?php


namespace App\Services\Shareholder;


use App\Repositories\Shareholder\ShareholderRepository;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShareholderServiceImp implements ShareholderService
{
    protected $userService, $shareholderRepository;

    public function __construct(ShareholderRepository $shareholderRepository, UserService $userService)
    {
        $this->shareholderRepository = $shareholderRepository;
        $this->userService = $userService;

    }

    public function store($shareholder)
    {

        DB::beginTransaction();
        try {
            $user = $this->userService->store($shareholder, 'shareholder');
            $shareholder['user_id'] = $user->id;
            $shareholder = $this->shareholderRepository->create($shareholder);
            DB::commit();
            return $shareholder;
        } catch (\Exception $exception) {
            Log::error("Create new shareholder has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $newShareholderInfo)
    {
        DB::beginTransaction();
        try {
            $shareholder = $this->shareholderRepository->findOrFail($id);
            $user = $shareholder->user;
            $shareholder->update($newShareholderInfo);
            $user->update($newShareholderInfo);
            DB::commit();
            return $shareholder;
        } catch (\Exception $exception) {
            Log::error("Update shareholder has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $shareholder = $this->shareholderRepository->findOrFail($id);
            $user = $shareholder->user;
            $shareholder->delete();
            $user->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error("Delete shareholder has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


}
