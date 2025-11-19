<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomePaymentClientController extends Controller
{
    public function indexContent(Request $request, $id)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterCategory = $request->get('filter-category', null);
        $filterAudio = $request->get('filter-audio', null);
        $filterPayment = $request->get('filter-payment_method', null);
        $filterPrice = $request->get('filter-price', null);
        $filterDate = $request->get('filter-date', null);

        $query = Payment::whereClientId($id)->with(['audio.phase.category', 'phase.category']);

        if ($filterCategory != null) {
            $query = $query->where(function($query) use($filterCategory){
                $query->whereHas('audio.phase.category',function($query) use($filterCategory) {
                    $query->where('name', 'like', '%' . $filterCategory . '%');
                })->orWhereHas('phase.category',function($query) use($filterCategory) {
                    $query->where('name', 'like', '%' . $filterCategory . '%');
                });
            });
        }
        if ($filterAudio != null) {
            $query = $query->where(function($query) use($filterAudio){
                $query->whereHas('audio',function($query) use($filterAudio) {
                    $query->where('name', 'like', '%' . $filterAudio . '%');
                })->orWhereHas('phase',function($query) use($filterAudio) {
                    $query->where('name', 'like', '%' . $filterAudio . '%');
                });
            });
        }
        if ($filterPrice != null) {
            $query = $query->where('price', 'like', '%' . $filterPrice . '%');
        }
        if ($filterPayment != null) {
            $query = $query->where('payment_method', 'like', '%' . $filterPayment . '%');
        }
        if ($filterDate != null) {
            $query = $query->where('date', 'like', '%' . $filterDate . '%');
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
