<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 20.11.2017
 * Time: 13.39
 */
namespace App\Extensions;
use App\Extensions\Manager;
use \Illuminate\Contracts\Auth\Guard;
class ManagerGuard implements Guard{
    protected $provider;
    protected $manager;
    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check(){
        return ! is_null($this->user());
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest(){
        return ! $this->check();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user(){
        if(!(is_null($this->user()))){
            return $this->user();
        }
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id(){
        if($this->manager=$this->user()){
            return $this->user()->getAuthIdentifier();
        }

    }

    /**
     * Validate a user's credentials.
     *
     * @param  array $credentials
     * @return bool
     */
    public function validate(array $credentials=[]){
        if(empty($credentials['account'])&&empty($credentials['password']))return false;
        if($this->provider->validateCredentials($this->user(),$credentials)){
            $manager = $this->provider->retrieveByCredentials($credentials);
            $this->setManager($manager);
            return true;
        }else
            return false;
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $manager
     * @return void
     */
    public function setManager(\Illuminate\Contracts\Auth\Authenticatable $manager){
        $this->manager = $manager;
        return $this;
    }

    public function __construct(ManagerDataProvider $provider){
        $this->provider = $provider;
        $this->manager=null;
    }
}