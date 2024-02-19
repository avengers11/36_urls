<?php

namespace App\Http\Controllers\frontend\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\management;
use Illuminate\Http\Request;
use App\Models\urls;

class admin_frontend_urls_controller extends Controller
{
    //admin_urls_links_controller
    public function admin_urls_links_controller(Request $request, $uniqeKey=null) {
        // check url
        if(!empty($uniqeKey)){
            if(urls::where("uniqeKey", $uniqeKey) -> exists()){
                $first_urls = urls::where("uniqeKey", $uniqeKey) -> first();
                urls::where("uniqeKey", $uniqeKey) -> update([
                    "view" => $first_urls['view'] + 1
                ]);

                if($first_urls->auth == 1 && !\App\Models\users::where('username', $request -> session() -> get('username')) -> where('st', 'active') -> exists()){
                    return redirect(route('users_accounts_web'));
                }

                $request->session()->put('url', $first_urls->url);

                return redirect(route('users_ads_web', $first_urls));

            }else{
                return view('users.pages.home.404');
            }
        }
        return redirect(route('users_home_web'));
    }

    // admin_urls_controller
    public function admin_urls_controller() {
        $urls = urls::orderBy('id', 'DESC') -> paginate(10);
        return view('admin.pages.settings.urls.url') -> with(compact('urls'));
    }

    // admin_urls_add_controller
    public function admin_urls_add_controller($id=null) {
        if($id == null){
            $cat = Category::orderBy('order', 'ASC')->get();
        }else{
            $cat = Category::where('id', $id)->get();
        }

        return view('admin.pages.settings.urls.add')->with(compact('cat'));
    }

    // admin_urls_add_default_controller
    public function admin_urls_add_default_controller() {
        $manage = management::first();
        return view('admin.pages.settings.urls.default')->with(compact('manage'));
    }

    // admin_urls_update_controller
    public function admin_urls_update_controller(urls $url, $id=null) {
        if($id == null){
            $cat = Category::orderBy('order', 'ASC')->get();
        }else{
            $cat = Category::where('id', $id)->get();
        }
        return view('admin.pages.settings.urls.update') -> with(compact('url', 'cat'));
    }

}
