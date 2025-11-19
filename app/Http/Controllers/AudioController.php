<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audio;

class AudioController extends Controller
{

    public function getContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 10);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterDescription = $request->get('filter-description', null);

        $query = Audio::orderBy('id', 'asc');

        if ($filterName !== null) {
            $query->where('name', "like", "%" . $filterName . "%");
        }

        if ($filterDescription !== null) {
            $query->where('rfc', "like", "%" . $filterDescription . "%");
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
