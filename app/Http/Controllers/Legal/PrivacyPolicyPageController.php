<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyPolicyPageController extends Controller
{
    public function index(){
        return view('legal.privacy-policy');
    }
}