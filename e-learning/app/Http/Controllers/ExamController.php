<?php
/**
 * Created by PhpStorm.
 * User: Tobi
 * Date: 24/11/2017
 * Time: 11.45
 */

namespace App\Http\Controllers;


class ExamController extends Controller {
    public function __construct(){
        $this->middleware('exam');
    }

    public function index(){
        return view('exam');
    }

}