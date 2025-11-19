<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomePaymentInstitutionController extends Controller
{
    public function indexContent(Request $request, $id)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterAudio = $request->get('filter-audio', null);
        $filterClient = $request->get('filter-client', null);
        $filterDate = $request->get('filter-date', null);
        $filterPrice = $request->get('filter-price', null);
        $filterPayment = $request->get('filter-payment_method', null);

        $query = Payment::whereHas('client', function ($q) use ($id){
            $q->where('institution_id', '=', $id);
        })->with(['client','audio','phase']);

        if ($filterAudio != null) {
            $query = $query->where(function($query) use($filterAudio){
                $query->whereHas('audio',function($query) use($filterAudio) {
                    $query->where('name', 'like', '%' . $filterAudio . '%');
                })->orWhereHas('phase',function($query) use($filterAudio) {
                    $query->where('name', 'like', '%' . $filterAudio . '%');
                });
            });
        }
        if ($filterClient != null) {
            $query = $query->whereHas('client', function($query) use($filterClient) {
                $query->where('name', 'like', '%' . $filterClient . '%')
                    ->orWhere('last_name', 'like', '%' . $filterClient . '%')
                    ->orWhere('second_last_name', 'like', '%' . $filterClient . '%');
            });
        }
        if ($filterDate != null) {
            $query = $query->where('date', 'like', '%' . $filterDate . '%');
        }
        if ($filterPrice != null) {
            $query = $query->where('price', 'like', '%' . $filterPrice . '%');
        }
        if ($filterPayment != null) {
            $query = $query->where('payment_method', 'like', '%' . $filterPayment . '%');
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
