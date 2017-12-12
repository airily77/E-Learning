<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 20.11.2017
 * Time: 18.09
 */

namespace App\Extensions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Manager implements AuthenticatableContract{
    use Notifiable;
    public $account;
    protected $password;
    public function setPw($pw){
        $this->password=$pw;
    }
    public function __construct2($account,$password){
        $this->account=$account;
        $this->password=$password;
    }
    public function __construct(){}

    protected function setAccount($account){
        $this->account=$account;
    }
    public function getAuthIdentifierName(){
        return $this->account;
    }

    public function getAuthPassword(){
        return 'yupthisisthepassword';
    }

    public function getAuthIdentifier(){
        return $this->account;
    }

    public function getRememberToken(){
    }

    public function setRememberToken($value){
    }
    public function getRememberTokenName(){
    }
}
