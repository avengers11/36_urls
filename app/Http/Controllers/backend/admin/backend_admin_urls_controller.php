<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use App\Models\management;
use Illuminate\Http\Request;
use App\Models\urls;

class backend_admin_urls_controller extends Controller
{
    //admin_urls_add_urls_controller
    public function admin_urls_add_urls_controller(Request $req) {
        $data = $req -> all();

        // is key is used
        if(urls::where("uniqeKey", $data['uniqeKey']) -> exists()){
            return back() -> with('msg', 'Uniqe key is already use!');
        }

        if(!empty($req -> file('og'))){
            $pic = $req -> file('og');
            $og_img = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/og"), $og_img);
        }else{
            $og_img = "default.png";
        }

        $db = new urls;
        $db -> category_id = $data['category_id'];
        $db -> title = $data['title'];
        $db -> og = $og_img;
        $db -> uniqeKey = $data['uniqeKey'];
        $db -> url = $data['url'];
        $db -> auth = $data['auth'];
        $db -> view_page = $data['view_page'];
        $db -> time = $data['time'];
        $db -> custom_page = $data['custom_page'];
        $db -> save();
        return redirect(route('settings.urls_admin_urls_web')) -> with('msg', 'You are successfully create a sorten url!!');
    }

    // admin_urls_add_custom_controller
    public function admin_urls_add_custom_controller(Request $req){
        $data = $req -> all();

        management::where("id", 1) -> update([
            'default' => $data['default_page'],
        ]);
        return redirect(route('settings.urls_admin_urls_web')) -> with('msg', 'You are successfully update settings!!');
    }

    // admin_urls_update_urls_controller
    public function admin_urls_update_urls_controller(Request $req, $id){
        $data = $req -> all();

        // is key is used
        if(urls::where("uniqeKey", $data['uniqeKey']) -> where('id', '!=', $id) -> exists()){
            return back() -> with('msg', 'Uniqe key is already use!');
        }

        $old_data =  urls::where('id', $id) -> first();

        if(!empty($req -> file('og'))){
            $pic = $req -> file('og');
            $og_img = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/og"), $og_img);
        }else{
            $og_img = $old_data['og'];
        }

        urls::where("id", $id) -> update([
            'title' => $data['title'],
            'og' => $og_img,
            'uniqeKey' => $data['uniqeKey'],
            'url' => $data['url'],
            'auth' => $data['auth'],
            'view_page' => $data['view_page'],
            'time' => $data['time'],
            'custom_page' => $data['custom_page']
        ]);
        return redirect(route('settings.urls_admin_urls_web')) -> with('msg', 'You are successfully update a sorten url!!');
    }

    // admin_urls_delete_urls_controller
    public function admin_urls_delete_urls_controller($id) {
        urls::where("id", $id) -> delete();
        return redirect(route('settings.urls_admin_urls_web')) -> with('msg', 'You are successfully delete a sorten url!!');
    }

    // admin_urls_search_controller
    public function admin_urls_search_controller(Request $req) {
        $data = $req -> all();

        $urls_data = urls::where("uniqeKey", "LIKE", "%".$data['url']."%") -> get();
        return response() -> json(['data' => $urls_data]);
    }
}
