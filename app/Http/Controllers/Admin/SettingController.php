<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{

    public function indexContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $query = Setting::query();

        $count = $query->count();
        $settings = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $settings,
        ]);
    }

    public function status($id)
    {
        try {
            DB::beginTransaction();
            $changeStatus = Setting::find($id);
            $changeStatus->active = !$changeStatus->active;
            $changeStatus->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Correctamente actualizado.'
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
