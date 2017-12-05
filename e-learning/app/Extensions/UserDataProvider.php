<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 20.11.2017
 * Time: 13.30
 */
namespace App\Extensions;
use \Illuminate\Contracts\Auth\UserProvider;
use App\User;
use database\connectors\UserData;
use UserAgentParser\Exception\NoResultFoundException;
use UserAgentParser\Provider\WhichBrowser;
class UserDataProvider implements UserProvider {
    public $model;

    public function __construct(\App\User $usermodel){
        $this->model=$usermodel;
    }

    public function retrieveById($identifier){
        $pw = UserData::getPw($identifier);
        $user = new User;
        $user->account = $identifier;
        $user->setPw($pw);
        return $user;
    }
    public function retrieveByToken($identifier, $token){
    }
    public function updateRememberToken(\Illuminate\Contracts\Auth\Authenticatable $user, $token){
    }

    public function retrieveByCredentials(array $credentials){
        if(empty($credentials)){
            return;
        }
        $userdata = UserData::getUser(UserData::getUserId($credentials['account']));
        $user = new User($userdata->account,$userdata->password);
        return $user;
    }
    public function validateCredentials(\Illuminate\Contracts\Auth\Authenticatable $user, array $credentials){
        if(empty($credentials['account'])&&empty($credentials['password'])) return;
        return UserData::login($credentials['account'],$credentials['password'],$this->getBrowser());
    }
    private function getBrowser(){
        $provider = new WhichBrowser();
        try {
            $result = $provider->parse('Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36');
        } catch (NoResultFoundException $ex){}
        return $result->getBrowser()->getName();

    }
}