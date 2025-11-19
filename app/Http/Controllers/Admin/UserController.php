<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getAuthUser()
    {
        $user = User::find(Auth::id());

        if ($user != null) {

            return response()->json([
                'success' => true,
                'message' => 'Se encontró el usuario',
                'user' => $user
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error: No se enontro el usuario'
            ]);
        }
    }

    public function indexContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterRole = $request->get('filter-role', null);

        $query = User::query()->with(['role']);

        if ($filterName != null) {
            $query = $query->where(function($query) use($filterName) {
                $query->where('name', 'like', '%' . $filterName . '%')
                    ->orWhere('last_name', 'like', '%' . $filterName . '%')
                    ->orWhere('second_last_name', 'like', '%' . $filterName . '%');
            });
        }

        if ($filterEmail != null) {
            $query = $query->where('email', 'like', '%' . $filterEmail . '%');
        }

        if ($filterRole != null) {
            $query = $query->where('role_id','=',$filterRole);
        }

        $count = $query->count();
        $user = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        $roles = Role::query()->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $user,
            'roles' => $roles
        ]);
    }

    public function upsert(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrNew($id);
            $user->fill($request->only(User::getFillables()));
            if (isset($request->password)) $user->password = bcrypt($request->password);
            $user->saveOrFail();
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

    public function status($id)
    {
        try {
            DB::beginTransaction();
            $changeStatus = User::find($id);
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
