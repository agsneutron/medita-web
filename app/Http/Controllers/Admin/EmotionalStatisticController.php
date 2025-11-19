<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmotionalStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmotionalStatisticController extends Controller
{
    public function indexContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

//        $query = DB::table('emotional_statistics');
        $query = EmotionalStatistic::query();

        $count = $query->count();

        $emotionalStatistic = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $emotionalStatistic,
        ]);

    }
}
