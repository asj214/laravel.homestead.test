<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Attachment;

class AttachmentController extends Controller {
    //

    public function destroy(Request $request, $id){

        $attachment = Attachment::find($id);
        // Attachment::destroy($id);

        $path = str_replace("storage", "public", $attachment->path);
        Storage::delete($path);
        $attachment->delete($id);

        return redirect($request->redirect_url);

    }


}
