<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;
use Faker\Provider\Company;

class PageController extends Controller
{
    //

    public function gioiThieu(){
        $company=CompanyInfo::find(1);
        return view('pages.gioi-thieu',compact('company'));
    }
}
