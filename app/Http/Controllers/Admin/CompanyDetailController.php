<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use Illuminate\support\Facades\Auth;

class CompanyDetailController extends Controller
{
    public function index()
    {
        $data = CompanyDetail::all()->first();
        
        return view('admin.company.index',compact('data'));
    }

    public function update(Request $request)
    {
        
        // try{
            $team = CompanyDetail::find($request->codeid);
            $team->company_name = $request->company_name;
            $team->position = $request->position;

            if (isset($request->header_logo)) {
                $request->validate([
                    'header_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $rand1 = mt_rand(100000, 999999);
                $header_logoName = time(). $rand1 .'.'.$request->header_logo->extension();
                $request->header_logo->move(public_path('images/company'), $header_logoName);
                $team->header_logo = $header_logoName;
            }

            if (isset($request->logo)) {
                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $rand2 = mt_rand(100000, 999999);
                $logoName = time(). $rand2 .'.'.$request->logo->extension();
                $request->logo->move(public_path('images/company'), $logoName);
                $team->logo = $logoName;
            }

            if (isset($request->footer_logo)) {
                $request->validate([
                    'footer_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $rand2 = mt_rand(100000, 999999);
                $footer_logoName = time(). $rand2 .'.'.$request->footer_logo->extension();
                $request->footer_logo->move(public_path('images/company'), $footer_logoName);
                $team->footer_logo = $footer_logoName;
            }

            $team->address1 = $request->address1;
            $team->address2 = $request->address2;
            $team->footer_content= $request->footer_content;
            $team->google_map= $request->google_map;
            $team->phone1 = $request->phone1;
            $team->phone2 = $request->phone2;
            $team->phone3 = $request->phone3;
            $team->phone4 = $request->phone4;
            $team->email1 = $request->email1;
            $team->email2 = $request->email2;
            $team->facebook= $request->facebook;
            $team->twitter= $request->twitter;
            $team->instagram= $request->instagram;
            $team->linkedin= $request->linkedin;
            $team->website= $request->website;
            $team->youtube = $request->youtube;
            $team->google_play_link= $request->google_play_link;
            $team->google_appstore_link= $request->google_appstore_link;
            $team->tawkto = $request->tawkto;
            $team->about_us = $request->about_us;
            $team->meta_title = $request->meta_title;
            $team->meta_description = $request->meta_description;
            $team->meta_keywords = $request->meta_keywords;
            $team->created_by= Auth::user()->id;
            $team->save();

            return redirect()
                    ->route('admin.companyDetail')
                    ->with('success', 'Data saved successfully.');

        // }catch (\Exception $e){


        //     return redirect()
        //             ->route('admin.companyDetail')
        //             ->with('error', 'Server Error!!');

        // }
    }
}
