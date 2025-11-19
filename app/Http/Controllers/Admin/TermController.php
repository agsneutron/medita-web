<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermController extends Controller
{

    public function getTerms(Request $request)
    {
        $terms = Setting::find(Setting::TERMS);
        return response()->json([
            'terms' => $terms,
        ]);
    }

    public function upsert(Request $request)
    {
        try {
            DB::beginTransaction();
            $terms = Setting::find(Setting::TERMS);
            $terms->fill($request->only(Setting::getFillables()));
            $terms->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Terminos correctos.'
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
