<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.settings');
    }

    public function store(Request $request){
        try {

            foreach($request->all() as $key => $value){
    
                if($key !== 'logo' && $key !== 'icon'):
                    if($setting = Setting::where('key', $key)->first()){
                        $setting->update(['value' => $value]);
                    } else {
                        Setting::create(['key' => $key, 'value' => $value]);
                    }
                else:
                    $this->uploadLogoIcon($request);
                endif;
    
            }
    
            return back()->with('success', 'Settings Saved!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    private function uploadLogoIcon(Request $request){
        $storage = 'logo';

        if($request->logo){
            if($logo = setting('logo')){
                imageUploader($logo->value, $storage, 'd');
                $url = \URL::to('storage/'. imageUploader($request->file('logo'), $storage, 'u') );
                $logo->update(['value' => $url]);
            } else {
                $url = \URL::to('storage/'. imageUploader($request->logo, $storage, 'u'));
                Setting::create(['key' => 'logo', 'value' => $url]);
            }
        }

        if($request->file('icon')){
            if($icon = setting('icon')){
                imageUploader($icon->value, $storage, 'd');
                $url = \URL::to('storage/'. imageUploader($request->icon, $storage, 'u'));
                $icon->update(['value' => $url]);
            } else {
                $url = \URL::to('storage/'. imageUploader($request->icon, $storage, 'u'));
                Setting::create(['key' => 'icon', 'value' => $url]);
            }
        }
    }
}
