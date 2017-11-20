<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 20.11.2017
 * Time: 13.30
 */
namespace App\Extensions;
use \Illuminate\Contracts\Auth\UserProvider;
use app\User;
use database\connectors\UserData;
class UserDataProvider implements UserProvider {
    private $model;

    public function __construct(\App\User $usermodel){
        $this->model=$usermodel;
    }

    public function retrieveById($identifier){
        return UserData::getUser($identifier);
    }
    public function retrieveByToken($identifier, $token){
        // TODO: Implement retrieveByToken() method.
    }
    public function updateRememberToken(\Illuminate\Contracts\Auth\Authenticatable $user, $token){
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials){
        if(empty($credentials)){
            return;
        }
        $userdata = UserData::getUser(UserData::getUserId($credentials['account']));
        $user = new User;
        $user->account= $userdata->account;
        $user->password = $userdata->password;
        return $user;
    }
    public function validateCredentials(\Illuminate\Contracts\Auth\Authenticatable $user, array $credentials){
        if(empty($credentials['account'])&&empty($credentials['password'])) return;
        return UserData::login($credentials['account'],$credentials['password'],request()->ip(),'firefox');
    }
}