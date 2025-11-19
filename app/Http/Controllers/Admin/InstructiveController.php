<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructive;
use App\Models\Category;
use App\Models\Phase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class InstructiveController extends Controller
{

    public function getInstructive($id){

        $category = Category::find($id);

//        $instructive = Instructive::find($category->instructive_id);
        $instructive = $category->url_instructive;

        if ($instructive != null) {
            return response()->json([
                'success' => true,
                'instructive' => $instructive
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al encontrar el intructivo'
            ]);
        }
    }

    public function upsert(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $instructive = Category::findOrNew($id);
            $instructive->url_instructive=$request->url;
//            $instructive = Instructive::findOrNew($id);
//            $instructive->fill($request->only(Instructive::getFillables()));
            $instructive->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Instructivo correcto.'
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

    public function getPhaseInstructive($id){

        $phase = Phase::find($id);

//        $instructive = Instructive::find($category->instructive_id);
        $instructive = $phase->url_instructive;

        if ($instructive != null) {
            return response()->json([
                'success' => true,
                'instructive' => $instructive
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al encontrar el intructivo'
            ]);
        }
    }

    public function upsertPhase(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $instructive = Phase::findOrNew($id);
            $instructive->url_instructive=$request->url;
            $instructive->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Instructivo de Fase correcto.'
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

    public function getPhaseAffirmations($id){

        $phase = Phase::find($id);

//        $instructive = Instructive::find($category->instructive_id);
        $affirmations = $phase->affirmations;

        if ($affirmations != null) {
            return response()->json([
                'success' => true,
                'affirmations' => $affirmations
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al encontrar las afirmaciones'
            ]);
        }
    }

    public function upsertPhaseAffirmations(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $affirmations = Phase::findOrNew($id);
            $affirmations->affirmations=$request->affirmations;
            $affirmations->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Afirmaciones de Fase correcto.'
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
