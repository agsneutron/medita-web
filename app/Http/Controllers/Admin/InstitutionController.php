<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Program;
use App\Models\TypeClient;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitutionController extends Controller
{

    public function indexContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterContact = $request->get('filter-contact', null);
        $filterEmail = $request->get('filter-contact_email', null);
        $filterType = $request->get('filter-client_type', null);
        $filterProgram = $request->get('filter-program', null);

        $query = Institution::query()->with(['type_client','program']);

        if ($filterName != null) {
            $query = $query->where('name', 'like', '%' . $filterName . '%');
        }
        if ($filterContact != null) {
            $query = $query->where('contact', 'like', '%' . $filterContact . '%');
        }
        if ($filterEmail != null) {
            $query = $query->where('contact_email', 'like', '%' . $filterEmail . '%');
        }
        if ($filterType != null) {
            $query = $query->where('type_client_id','=',$filterType);
        }
        if ($filterProgram != null) {
            $query = $query->where('program_id','=',$filterProgram);
        }

        $count = $query->count();
        $institutions = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        $program = Program::query()->get();
        $client_types = TypeClient::query()->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $institutions,
            'client_types' => $client_types,
            'profiles' => $program,
        ]);
    }

    public function upsert(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $institution = Institution::findOrNew($id);
            $institution->fill($request->only(Institution::getFillables()));
            if ($id === 'FAKE_ID') $institution->code = self::code();
            $institution->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Institución correcta.'
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
            $changeStatus = Institution::find($id);
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

    public function getInstitution($id){
        $institution = Institution::whereId($id)->with(['type_client'])->first();
        if ($institution != null) {
            return response()->json([
                'success' => true,
                'institution' => $institution
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error institution'
            ]);
        }
    }

}
