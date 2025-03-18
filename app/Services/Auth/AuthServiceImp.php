<?php


namespace App\Services\Auth;


use App\Repositories\User\UserRepository;
use App\Services\Generate\GenerateService;
use Illuminate\Support\Facades\Auth;

class AuthServiceImp implements AuthService
{
    protected $userRepository, $generateService, $userWalletService;

    public function __construct(UserRepository $userRepository, GenerateService $generateService)
    {
        $this->userRepository = $userRepository;
        $this->generateService = $generateService;
        $this->generateService = $generateService;

    }

    public function login($credentials, $guard = 'web')
    {

        $logged = Auth::guard($guard)->attempt($credentials, false);
        if ($logged) {
            //anything here
        }
        return $logged;
    }

    public function logout($guards = ['top-tier', 'first-tier', 'second-tier', 'web'])
    {
        foreach ($guards as $guard) {
            Auth::guard($guard)->logout();
        }
        return true;
    }

    public function register($user, $affiliateKey = null, $isAdmin = false)
    {
        if ($affiliateKey != null)
            $affiliateUser = $this->userRepository->findAffiliateUser($affiliateKey);
        $userAffiliateKey = $this->generateService->generateModelCode($this->userRepository->getModel());
        $newUser = array_merge($user, ['password' => bcrypt($user['password']), 'is_admin' => $isAdmin, 'affiliate_key' => $userAffiliateKey, 'referrer_id' => $affiliateUser->id ?? 0, 'created_at' => now()]);
        $created = $this->userRepository->create($newUser);
        if ($created)
            $this->userWalletService->makeDefaultWallet($created->id);
        return $created;

    }

    public function verifyApiAuthentication($uid, $apiToken)
    {
        if ($uid == '' || $apiToken == '') {
            return false;
        }
        return $this->userRepository->findByCondition(['id' => $uid, 'api_token' => $apiToken]);
    }

}
