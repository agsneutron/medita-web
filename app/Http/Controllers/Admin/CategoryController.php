<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CategoryController extends Controller
{

    public function getContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 10);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterDescription = $request->get('filter-description', null);

        $query = Category::orderBy('id', 'asc');

        if ($filterName !== null) {
            $query->where('name', "like", "%" . $filterName . "%");
        }

        if ($filterDescription !== null) {
            $query->where('description', "like", "%" . $filterDescription . "%");
        }

        $count = $query->count();
        $categories = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $categories,
        ]);
    }

    public function addFile(Request $request){
        try{
            $url = UploadFiles::storeFileWithName($request->file('file'),'category');
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

    public function deleteFile(Request $request){
        try{
          UploadFiles::deleteFile($request->get('url'));
            return response()->json([
                'success' => true,
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
            $category = Category::findOrNew($id);
            $oldname = $category->name;
            $category->fill($request->only(Category::getFillables()));
            $category->name = $oldname;
            $category->saveOrFail();
            DB::commit();

            if($request->get($request->get('url_image')!=$request->get('old_url_image'))){
                UploadFiles::deleteFile($request->get('old_url_image'));
            }

            return response()->json([
                'success' => true,
                'message' => 'Categoria correcta.'
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


    public function getCategory($id){
        $category = Category::find($id);
        if ($category != null) {
            return response()->json([
                'success' => true,
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
