<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 20.11.2017
 * Time: 13.39
 */
namespace App\Extensions;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use \Illuminate\Contracts\Auth\Guard;
class UserGuard implements Guard{
    protected $provider;
    protected $user;
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
        if(!(is_null($this->user))){
            return $this->user;
        }
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id(){
        if($this->user=$this->user()){
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
            $user = $this->provider->retrieveByCredentials($credentials);
            $this->setUser($user);
            return true;
        }else
            return false;
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function setUser(\Illuminate\Contracts\Auth\Authenticatable $user){
        $this->user = $user;
        return $this;
    }

    public function __construct(UserDataProvider $provider){
        $this->provider = $provider;
        $this->user=null;
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function setManager(Authenticatable $user){
    }
}