<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'home',
        'login',
        'logout',
        'exam/postExam',
        'admin/login',
        'user/create/post',
        'course/content',
        'create/exam/post',
        'create/course/post',
        'user/remove',
        'exam/remove',
        'remove/course',
        'news/create/post',
        'news/remove',
        'scrollimage/create/post',
        'scrollimage/remove',
        'user/settings/post',
        'user/changepassword/post',
        'user/tocourse',
        'user/modify',
        'user/remove/course',
        'user/remove/exam',
        'user/modify/post',
        '/user/information/post',
        'news/modify/post'
    ];
}