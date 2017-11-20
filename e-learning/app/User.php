<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User implements AuthenticatableContract{
    use Notifiable;
    protected $table = 'user';
    public $account;
    public $password;
    public $remember_token = 'remember_token';
    protected $fillable = [
        'account','password',
    ];
    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName(){
        return $this->account;
    }

    public function getAuthPassword(){
        return $this->password;
    }

    public function getAuthIdentifier(){
        return $this->{$this->getAuthIdentifier()};
    }

    public function getRememberToken(){
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value){
        // TODO: Implement setRememberToken() method.
    }
    public function getRememberTokenName(){
        // TODO: Implement getRememberTokenName() method.
    }
}
