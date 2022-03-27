<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class FileUploadController extends Controller
{
    /**
     * ファイルアップロード
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload(Request $request)
    {
        $file_name = $request->file->getClientOriginalName();
        $request->file->storeAs('public/', $file_name);

        $user = Auth::user();
        dd($user);
        // $user->update(['file_path' => '/storage/' . $file_name]);

        return $user;
    }
}
