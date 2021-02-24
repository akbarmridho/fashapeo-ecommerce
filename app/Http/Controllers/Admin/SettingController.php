<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Actions\Setting\UpdateMail;
use App\Actions\Setting\UpdateContact;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('admin.pages.site-setting');
    }

    public function contact(Request $request)
    {
        (new UpdateContact)->update($request->all());
    }

    public function mail(Request $request)
    {
        (new UpdateMail)->update($request->all());
    }
}
