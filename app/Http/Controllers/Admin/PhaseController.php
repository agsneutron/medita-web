<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Phase;
use App\Services\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PhaseController extends Controller
{

    public function getContent(Request $request, $id)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 10);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterDescription = $request->get('filter-description', null);

        $query = Phase::orderBy('id', 'asc')
            ->where('category_id', "=", $id);

        if ($filterName !== null) {
            $query->where('name', "like", "%" . $filterName . "%");
        }

        if ($filterDescription !== null) {
            $query->where('description', "like", "%" . $filterDescription . "%");
        }

        $count = $query->count();
        $phases = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'categoryId' => $id,
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $phases,
        ]);

    }


    public function addFile(Request $request){
        try{
            $url = UploadFiles::storeFileWithName($request->file('file'),'phase');
            return response()->json([
                'success' => true,
                'theUrl' => $url,
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function upsert(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $phase = Phase::findOrNew($id);
            $phase->fill($request->only(Phase::getFillables()));
            $phase->saveOrFail();
            DB::commit();


            if($request->get($request->get('url_image')!=$request->get('old_url_image'))){
                UploadFiles::deleteFile($request->get('old_url_image'));
            }

            return response()->json([
                'success' => true,
                'message' => 'Fase correcta.'
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


    public function status($id)
    {
        try {
            DB::beginTransaction();
            $changeStatus = Phase::find($id);
            $changeStatus->active = !$changeStatus->active;
            $changeStatus->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Se actualizo correctamente.'
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

    public function getPhase($id){

        $phase = phase::find($id);

        $category = Category::find($phase->category_id);

        if ($phase != null) {
            return response()->json([
                'success' => true,
                'phase' => $phase,
                'category' => $category
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al encontrar la categoria'
            ]);
        }
    }
}
