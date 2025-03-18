<?php


namespace App\Services\Auth;


interface AuthService
{
    public function login($credentials, $guard = 'web');

    public function logout($guards = ['admin', 'web']);

    public function register($user, $affiliateKey = null, $isAdmin = false);

    public function verifyApiAuthentication($uid, $apiToken);

}
