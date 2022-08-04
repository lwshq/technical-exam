<?php

namespace App\Services;

use Hash;
use Password;
use Str;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;

// use App\Libraries\M360;
use App\Contracts\UserServiceInterface;
use App\Contracts\UserRepositoryInterface;

// use JWTAuth;

class UserService implements UserServiceInterface
{

    protected $user;

    public function __construct(
        UserRepositoryInterface $user
    )
    {
        $this->user = $user;
    }

    public function signUpUser(array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $userItem = $this->storeUser($attributes);

        if($userItem->wasRecentlyCreated === true) {
            $response['status'] = true;
            $response['message'] = 'User successfully created.';
        }

        return $response;

    }

    private function storeUser(array $attribs) {
        $prepData = array(
            'name' => $attribs['name'],
            'email' => $attribs['email'],
            'password' => Hash::make($attribs['password'])
        );

        return $this->user->create($prepData);
    }

}
