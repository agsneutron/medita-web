<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeInstitutionController extends Controller
{
    public function indexContent(Request $request, $id)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterDate = $request->get('filter-date', null);

        $query = Client::whereInstitutionId($id)->with(['gender']);

        if ($filterName != null) {
            $query = $query->where(function($query) use($filterName) {
                $query->where('name', 'like', '%' . $filterName . '%')
                    ->orWhere('last_name', 'like', '%' . $filterName . '%')
                    ->orWhere('second_last_name', 'like', '%' . $filterName . '%');
            });
        }
        if ($filterDate != null) {
            $query = $query->where('created_at', 'like', '%' . $filterDate . '%');
        }

        $count = $query->count();
        $clients = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $clients,
        ]);
    }
}
