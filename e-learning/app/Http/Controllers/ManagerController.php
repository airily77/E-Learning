<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 06/12/2017
 * Time: 17:25
 */

namespace App\Http\Controllers;


class ManagerController extends Controller {
    public function examCreation(){
        return view('create-exam');
    }
}