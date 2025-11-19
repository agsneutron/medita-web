<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Program;
use App\Models\ProgramAudio;
use App\Models\Restriction;
use App\Services\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AudioController extends Controller
{

    public function getContent(Request $request, $id)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 10);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterDescription = $request->get('filter-description', null);
        $filterNumber = $request->get('filter-number', null);


        $query = Audio::with([
                'evaluations' =>
                     function ($q) {
                            $q->orderBy('updated_at', 'desc')->with(['client']);
                     }
                 ]
            )->orderBy('number', 'asc')
                 ->where('phase_id', '=', $id);


        if ($filterName !== null) {
            $query->where('name', "like", "%" . $filterName . "%");
        }

        if ($filterDescription !== null) {
            $query->where('description', "like", "%" . $filterDescription . "%");
        }

        if ($filterNumber !== null) {
            $query->where('number', "like", "%" . $filterNumber . "%");
        }

        $count = $query->count();
        $audios = $query
            ->limit($size)
            ->skip($skip)
            ->get();
        $restrictions = Restriction::all();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $audios,
            'restrictions' => $restrictions
        ]);
    }

    public function getEvaluations(Request $request, $id)
    {

        $query = Evaluation::with(['client'])
            ->where('audio_id', '=', $id);

        $count = $query->count();
        $audios = $query ->get();

        return response()->json([
            'count' => $count,
            'data' => $audios,
        ]);
    }

    public function upsert(Request $request, $id)
    {
        if($request->get('number')>0 && $request->get('price')>=0){
            try {

                DB::beginTransaction();
                $audio = Audio::findOrNew($id);
                $audio->fill($request->only(Audio::getFillables()));
                $audio->saveOrFail();
                DB::commit();

                if($request->get($request->get('url_image')!=$request->get('old_url_image'))){
                    UploadFiles::deleteFile($request->get('old_url_image'));
                }
                if($request->get($request->get('url_gif')!=$request->get('old_url_gif'))){
                    UploadFiles::deleteFile($request->get('old_url_gif'));
                }
                if($request->get($request->get('url_audio')!=$request->get('old_url_audio'))){
                    UploadFiles::deleteFile($request->get('old_url_audio'));
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Audio correcto.'
                ]);
            }
            catch (\Exception $ex) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage(),
                    'line' => $ex->getLine(),
                    'file' => $ex->getFile()
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No se acepta un número o precio negativo'
            ]);
        }
    }

    public function addFile(Request $request){
        try {
            $file = $request->file('file');
            if (!$file->isValid()) {
                throw new \Exception('Archivo de audio no válido, el tamaño máximo es de 64MB');
            }
            $url = UploadFiles::storeFileWithName($file, 'audio');
            return response()->json([
                'success' => true,
                'theUrl' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errorTrace'=>$e->getTrace(),
                'errorFile'=>$e->getFile(),
                'errorLine'=>$e->getLine(),
                'error'=>$e->getTraceAsString(),
                'errorCode'=>$e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
//        try{
//            $url = UploadFiles::storeFileWithName($request->file('file'),'audio');
//            return response()->json([
//                'success' => true,
//                'theUrl' => $url,
//            ]);
//        }catch (\Exception $e) {
//            return response()->json([
//                'success' => false,
//                'errorTrace'=>$e->getTrace(),
//                'errorFile'=>$e->getFile(),
//                'errorLine'=>$e->getLine(),
//                'message' => $e->getMessage(),
//            ]);
//        }
    }


    public function status($id)
    {
        try {
            DB::beginTransaction();
            $changeStatus = Audio::find($id);
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

    public function getAudio($id){

        $audio = Audio::find($id);

        $category = Category::find($audio->phase_id);

        if ($audio != null) {
            return response()->json([
                'success' => true,
                'audio' => $audio,
                'category'=>$category
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al encontrar la categoria'
            ]);
        }
    }
}
