<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 06/12/2017
 * Time: 17:25
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller {
    public function __construct(){
        $this->middleware('manager');
    }
    public function manager(){
        return view('management');
    }
    public function examCreation(){
        return view('create-exam');
    }
    public function courseCreation(){
        return view('create-course');
    }

    public function createExam(Request $request){
        dd($request->input());
    }
}