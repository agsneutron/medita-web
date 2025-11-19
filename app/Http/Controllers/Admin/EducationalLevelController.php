<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationalLevel;
use App\Models\Level;
use DB;
use Illuminate\Http\Request;

class EducationalLevelController extends Controller
{
    public function getEducationalLevel()
    {
        $educational_levels = EducationalLevel::query()->with(['levels'])->get();

        return response()->json([
            'educational' => $educational_levels,
        ]);
    }

    public function upsert(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $educational_level = EducationalLevel::find($id);
            $educational_level->name = $request->name;
            foreach ($request->levels as $level){
                $grade = Level::find($level['id']);
                $grade->name = $level['name'];
                $grade->saveOrFail();
            }
            $educational_level->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Usuario correcto.'
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
