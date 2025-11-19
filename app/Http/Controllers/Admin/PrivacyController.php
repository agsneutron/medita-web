<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivacyController extends Controller
{

    public function getPrivacy(Request $request)
    {
        $privacy = Setting::find(Setting::PRIVACY);
        return response()->json([
            'privacy' => $privacy,
        ]);
    }

    public function upsert(Request $request)
    {
        try {
            DB::beginTransaction();
            $privacy = Setting::find(Setting::PRIVACY);
            $privacy->fill($request->only(Setting::getFillables()));
            $privacy->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Privacidad correcta.'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'line' => $ex->getLine(),
                'file' => $ex->getFile()
            ]);
        }
    }

}
