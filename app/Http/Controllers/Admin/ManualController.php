<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manual;
use App\Models\Category;
use App\Models\Phase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ManualController extends Controller
{

    public function getManual($id){

        $category = Category::find($id);

//        $manual = Manual::find($category->manual_id);
        $manual =  $category->url_manual;

        if ($manual != null) {
            return response()->json([
                'success' => true,
                'manual' => $manual
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al encontrar el manual'
            ]);
        }
    }

    public function upsert(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $manual = Category::findOrNew($id);
            $manual->url_manual=$request->url;
//            $manual = Manual::findOrNew($id);
//            $manual->fill($request->only(Manual::getFillables()));
            $manual->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Manual correcto.'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'line' => $ex->getLine(),
                'file' => $ex->getFile()
            ]);
        }
    }

    public function getPhaseManual($id){

        $phase = Phase::find($id);

//        $manual = Manual::find($category->manual_id);
        $manual =  $phase->url_manual;

        if ($manual != null) {
            return response()->json([
                'success' => true,
                'manual' => $manual
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al encontrar el manual'
            ]);
        }
    }

    public function upsertPhase(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $manual = Phase::findOrNew($id);
            $manual->url_manual=$request->url;
            $manual->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Manual de Fase correcto.'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'line' => $ex->getLine(),
                'file' => $ex->getFile()
            ]);
        }
    }
}
