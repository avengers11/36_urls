<?php

namespace App\Http\Controllers\frontend\users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\products2;
use App\Models\slider;
use App\Models\users;
use App\Models\live_tv;
use App\Models\management;
use App\Models\download_links;
use App\Models\Sliders2;
use App\Models\urls;

class users_frontend_deshbord_controller extends Controller
{
    //users_home_controller
    public function users_home_controller(Request $request, $id=null)
    {
        return view('users.pages.home.home');
    }

    // users_update_controller
    public function users_update_controller() {
        $management = download_links::where('id', 1) -> first();
        return view('users.pages.home.update') -> with(compact('management'));
    }

    // users_ads_controller
    public function users_ads_controller(urls $url)
    {
        $management = management::first();
        return view('users.pages.ads.ads')->with(compact('url', 'management'));
    }

    // users_ads_custom_controller
    public function users_ads_custom_controller(Request $request)
    {
        return view('users.pages.ads.custom');
    }

    // users_404_controller
    public function users_404_controller(Request $request)
    {
        return view('users.pages.home.404');
    }

}
