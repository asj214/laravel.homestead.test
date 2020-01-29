<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Banner;
use App\Attachment;
use App\BannerCategory;

class BannerController extends Controller {

    public function __construct(){
        // $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    private function rules(){
        return [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'started_at' => 'required|date',
            'finished_at' => 'required|date',
            'display_yn' => 'required',
        ];
    }

    //
    public function index(){

        $per_page = 15;

        $banners = Banner::with(['user'])->orderBy('id', 'desc');
        $banners = $banners->paginate($per_page);

        // echo "<pre>";
        // print_r($banners->toArray());
        // echo "</pre>";
        // exit;

        return view('adm.banners.lists', compact('banners'));
    }

    public function create(){

        $route = route('adm.banners.store');
        $display_yn = 'Y';
        $categorys = BannerCategory::where('parent_id', null)->get();

        return view('adm.banners.form', compact('route', 'display_yn', 'categorys'));

    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'started_at' => 'required|date',
            'finished_at' => 'required|date',
            'display_yn' => 'required',
        ]);

        $banner = new Banner();
        $banner->user_id = Auth::id();
        $banner->category_id = $request->category_id;
        $banner->sub_category_id = $request->sub_category_id;
        $banner->title = $request->title;
        $banner->intro = $request->intro;
        $banner->descr = $request->descr;
        $banner->link_url = $request->link_url;
        $banner->started_at = $request->started_at;
        $banner->finished_at = $request->finished_at;
        $banner->display_yn = $request->display_yn;
        $banner->save();

        // 첨부파일 처리
        if($request->hasFile('attachment')){

            $path = $request->file('attachment')->store('public/upfiles/banners');

            $attachment = new Attachment();
            $attachment->attachment_id = $banner->id;
            $attachment->attachment_type = 'banners';
            $attachment->path = str_replace("public", "storage", $path);
            $attachment->save();

        }

        return redirect()->route('adm.banners.index');

    }

    public function edit(Request $request, $id){

        $banner = Banner::find($id);
        $route = route('adm.banners.update', ['id' => $id]);

        $display_yn = $banner->display_yn;
        $categorys = BannerCategory::where('parent_id', null)->get();

        return view('adm.banners.form', compact('banner', 'route', 'display_yn', 'categorys'));

    }

    public function update(Request $request, $id){

        $validatedData = $request->validate($this->rules());

        $banner = Banner::find($id);
        $banner->user_id = Auth::id();
        $banner->category_id = $request->category_id;
        $banner->sub_category_id = $request->sub_category_id;
        $banner->title = $request->title;
        $banner->intro = $request->intro;
        $banner->descr = $request->descr;
        $banner->link_url = $request->link_url;
        $banner->started_at = $request->started_at;
        $banner->finished_at = $request->finished_at;
        $banner->display_yn = $request->display_yn;
        $banner->save();

        // 첨부파일 처리
        if($request->hasFile('attachment')){

            $path = $request->file('attachment')->store('public/upfiles/banners');

            $attachment = new Attachment();
            $attachment->attachment_id = $banner->id;
            $attachment->attachment_type = 'banners';
            $attachment->path = str_replace("public", "storage", $path);
            $attachment->save();

        }

        return redirect()->route('adm.banners.edit', ['id' => $banner->id]);

    }

    public function destroy(Request $request, $id){

    }

    public function categorys(Request $request){

        $category_id = $request->category_id;
        $categorys = BannerCategory::where('parent_id', $category_id)->get();

        return response()->json($categorys);

    }

}
