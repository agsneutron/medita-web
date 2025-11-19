<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Institution;
use App\Models\Program;
use App\Models\TypeClient;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{

    public function indexContent(Request $request)
    {
        $status = ['Activo','Inactivo'];
        $user_general = 'Usuario general';
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterStatus = $request->get('filter-status', null);
        $filterCategory = $request->get('filter-category', null);
        $filterCode = $request->get('filter-code', null);

        $institutions = Institution::query()->with(['type_client']);
        $clients = Client::query();

        if ($filterName != null) {
            $institutions = $institutions->where('name', 'like', '%' . $filterName . '%');
            $clients = $clients->where(function($query) use($filterName) {
                $query->where('name', 'like', '%' . $filterName . '%')
                    ->orWhere('last_name', 'like', '%' . $filterName . '%')
                    ->orWhere('second_last_name', 'like', '%' . $filterName . '%');
            });
        }
        if ($filterStatus != null) {
            if ($filterStatus === $status[0]) $active = true;
            else $active = false;
            $institutions = $institutions->where('active','=',$active);
            $clients = $clients->where('active','=',$active);
        }
        if ($filterCategory != null) {
            $institutions = $institutions->where('type_client_id','=',$filterCategory);
            if ($filterCategory !== $user_general) $clients = $clients->where('email','=',null);
        }
        if ($filterCode != null) {
            $institutions = $institutions->where('code', 'like', '%' . $filterCode . '%');
            $clients = $clients->where('email','=',null);
        }

        $count = $institutions->count() + $clients->count();
        $arr_institution = $institutions
            ->limit($size)
            ->skip($skip)
            ->get();
        $arr_client = $clients
            ->limit($size)
            ->skip($skip)
            ->get();
        $incomes = $arr_institution->concat($arr_client);

        $categories = TypeClient::all()->concat([$user_general]);

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $incomes,
            'status' => $status,
            'categories' => $categories
        ]);
    }

    public function status($id, $type)
    {
        try {
            DB::beginTransaction();
            if ($type === 'institution') $changeStatus = Institution::find($id);
            else $changeStatus = Client::find($id);
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

    public function codeChange($id){
        try {
            DB::beginTransaction();
            $codeChange = Institution::find($id);
            $codeChange->code = self::code();
            $codeChange->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Correctamente actualizado.',
                'code' => $codeChange->code
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
