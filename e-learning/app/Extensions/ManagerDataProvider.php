<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 20.11.2017
 * Time: 13.30
 */
namespace App\Extensions;
use \Illuminate\Contracts\Auth\UserProvider;
use App\Extensions\Manager;
use database\connectors\ManagerData;
use UserAgentParser\Provider\WhichBrowser;
class ManagerDataProvider implements UserProvider {
    private $model;

    public function __construct(\App\Extensions\Manager $managermodel){
        $this->model=$managermodel;
    }

    public function retrieveById($identifier){
        $manager = new Manager;
        $manager->account = $identifier;
        $manager->setPw(ManagerData::getPw($identifier));
        return $manager;
    }
    public function retrieveByToken($identifier, $token){
    }
    public function updateRememberToken(\Illuminate\Contracts\Auth\Authenticatable $user, $token){
    }

    public function retrieveByCredentials(array $credentials){
        if(empty($credentials)){
            return;
        }
        $managerdata = ManagerData::getManagerByAccount($credentials['account']);
        $manager = new Manager($managerdata->account,$managerdata->password);
        return $manager;
    }
    public function validateCredentials(\Illuminate\Contracts\Auth\Authenticatable $user, array $credentials){
        if(empty($credentials['account'])&&empty($credentials['password'])) return;
        return ManagerData::login($credentials['account'],$credentials['password'],$this->getBrowser());
    }
    private function getBrowser(){
        $provider = new WhichBrowser();
        try {
            $result = $provider->parse(request()->header('User-Agent'));
            return $result->getBrowser()->getName();
        } catch (NoResultFoundException $ex){}

    }
}