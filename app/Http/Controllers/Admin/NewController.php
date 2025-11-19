<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\UploadFiles;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewController extends Controller
{

    public function indexContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $query = News::query();

        $count = $query->count();
        $news = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $news,
        ]);
    }

    public function upsert(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $new = News::findOrNew($id);
            $new->fill($request->only(News::getFillables()));
            if ($request->file('file') !== null) $new->url_image = UploadFiles::storeFileWithName($request->file('file'),'notice');
            $new->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Noticia correcta.'
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

    public function status($id)
    {
        try {
            DB::beginTransaction();
            $changeStatus = News::find($id);
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
