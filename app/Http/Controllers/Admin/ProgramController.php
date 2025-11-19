<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Program;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function indexContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $query = Program::orderBy('id', 'asc')->with('categories');

        $count = $query->count();
        $program = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $program,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $program = Program::find($id);
        $program->fill($request->all());
        $program->saveOrFail();
        DB::commit();

        return response()->json([
            'success' => true,
            'messagge' => 'Programa correcto'
        ]);
    }

    public function status($id)
    {
        try {
            DB::beginTransaction();
            $changeStatus = Program::find($id);
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
