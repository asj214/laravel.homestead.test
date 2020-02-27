<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Banner as BannerResource;

use App\Banner;
use App\Attachment;

class BannerController extends Controller {

    //
    public function index(Request $request){

        $request->validate([
            'category_id' => 'nullable|numeric',
            'sub_category_id' => 'nullable|numeric'
        ]);

        $per_page = $request->input('per_page', 15);
        $category_id = $request->input('category_id');
        $sub_category_id = $request->input('sub_category_id');

        $crr_date = date('Y-m-d H:i:s');

        $banners = Banner::with(['attachment'])->where('display_yn', 'Y')->where('started_at', '<=', $crr_date)->where('finished_at', '>=', $crr_date);
        
        $banners = $banners->when($category_id, function($query, $category_id){
            return $query->where('category_id', $category_id);
        });

        $banners = $banners->when($sub_category_id, function($query, $sub_category_id){
            return $query->where('sub_category_id', $sub_category_id);
        });
        
        $banners = $banners->orderBy('id', 'desc')->paginate($per_page);

        return BannerResource::collection($banners);

        // echo "<pre>";
        // print_r($banners->toArray());
        // echo "</pre>";

    }

}
