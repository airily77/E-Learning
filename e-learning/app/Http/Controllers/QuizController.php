<?php
/**
 * Created by PhpStorm.
 * User: Tobi
 * Date: 24/11/2017
 * Time: 11.45
 */

namespace App\Http\Controllers;


class QuizController extends Controller {
    public function index(){
        return view('quiz');

    }

}