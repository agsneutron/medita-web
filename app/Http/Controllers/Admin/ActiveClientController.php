<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Institution;
use Illuminate\Http\Request;

class ActiveClientController extends Controller
{
    public function indexContent(Request $request)
    {
        $status = ['Activo', 'Inactivo'];
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterDate = $request->get('filter-date', null);
        $filterStatus = $request->get('filter-status', null);

        $institutions = Institution::query();
        $clients = Client::query();

        if ($filterName !== null) {
            $institutions = $institutions->where('name', 'like', '%' . $filterName . '%');
            $clients = $clients->where('name', 'like', '%' . $filterName . '%')
                ->orWhere('last_name', 'like', '%' . $filterName . '%')
                ->orWhere('second_last_name', 'like', '%' . $filterName . '%');
        }

        if ($filterDate !== null) {
            $institutions = $institutions->where('created_at', 'like', '%' . $filterDate . '%');
            $clients = $clients->where('created_at', 'like', '%' . $filterDate . '%');
        }

        if ($filterStatus !== null) {
            if ($filterStatus === 'Activo') {
                $institutions = $institutions->where('active', '=', true);
                $clients = $clients->where('active', '=', true);
            } else {
                $institutions = $institutions->where('active', '=', false);
                $clients = $clients->where('active', '=', false);
            }
        }

        $count = $institutions->count() + $clients->count();

        $arr_intitutions = $institutions
            ->limit($size)
            ->skip($skip)
            ->get();

        $arr_client = $clients
            ->limit($size)
            ->skip($skip)
            ->get();

        $activeClients = $arr_intitutions->concat($arr_client);

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $activeClients,
            'status' => $status,
        ]);
    }

    public function filterContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterDate = $request->get('filter-date', null);
        $filterStatus = $request->get('filter-status', null);

        $since = $request->get('since');
        $until = $request->get('until');

        $institutions = Institution::whereBetween('created_at', [$since, $until]);
        $clients = Client::whereBetween('created_at', [$since, $until]);

        if ($filterName !== null) {
            $institutions = $institutions->where('name', 'like', '%' . $filterName . '%');
            $clients = $clients->where('name', 'like', '%' . $filterName . '%')
                ->orWhere('last_name', 'like', '%' . $filterName . '%')
                ->orWhere('second_last_name', 'like', '%' . $filterName . '%');
        }

        if ($filterDate !== null) {
            $institutions = $institutions->where('created_at', 'like', '%' . $filterDate . '%');
            $clients = $clients->where('created_at', 'like', '%' . $filterDate . '%');
        }

        if ($filterStatus !== null) {
            if ($filterStatus === 'Activo') {
                $institutions = $institutions->where('active', '=', true);
                $clients = $clients->where('active', '=', true);
            } else {
                $institutions = $institutions->where('active', '=', false);
                $clients = $clients->where('active', '=', false);
            }
        }

        $count = $institutions->count() + $clients->count();

        $arr_intitutions = $institutions
            ->limit($size)
            ->skip($skip)
            ->get();

        $arr_client = $clients
            ->limit($size)
            ->skip($skip)
            ->get();

        $activeClients = $arr_intitutions->concat($arr_client);

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $activeClients,
        ]);
    }
}
