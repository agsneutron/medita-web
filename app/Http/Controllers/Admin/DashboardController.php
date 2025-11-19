<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientAudio;
use App\Models\Goal;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function getGoals()
    {
        $registeredUsers = Goal::where('name', 'usuarios registrados')->first();
        $salesGoal = Goal::where('name', 'ventas mensuales')->first();
        $reproductionGoal = Goal::where('name', 'reproducciones')->first();

        return response()->json([
            'registeredUsersGoal' => $registeredUsers,
            'saleGoal' => $salesGoal,
            'reproductionGoal' => $reproductionGoal,
        ]);
    }

    public function getRegisteredUsersMonth()
    {
        $month = Carbon::now()->format('m');
        $usersPerMonth = Client::query()->whereMonth('created_at', $month)->get();
        $usersPerMonth = count($usersPerMonth);

        return response()->json([
            'users' => $usersPerMonth,
        ]);
    }

    public function getSalesMonth()
    {
        $month = Carbon::now()->format('m');
        $paymentsPerMonth = Payment::query()
            ->whereMonth('date', $month)
            ->sum('price');

        return response()->json([
            'payments' => $paymentsPerMonth,
        ]);
    }

    public function getReproductionsMonth()
    {
        $month = Carbon::now()->format('m');

        $recognitionReproductionArr = ClientAudio::query()
            ->where('completed', true)
            ->whereHas('audio.phase.category', function ($q) {
                $q->where('id', ClientAudio::RECOGNITION);
            })->with(['audio'])->whereMonth('created_at', ($month))
            ->get();

        $recognitionReproduction = 0;

        foreach ($recognitionReproductionArr as $RRA) {
            $recognitionReproduction += (int)$RRA->audio->duration;
        }

        $musicReproductionArr = ClientAudio::query()
            ->where('completed', true)
            ->whereHas('audio.phase.category', function ($q) {
                $q->where('id', ClientAudio::HIGH_TECH);
            })->with(['audio'])->whereMonth('created_at', ($month))
            ->get();

        $musicReproduction = 0;

        foreach ($musicReproductionArr as $MRA) {
            $musicReproduction += (int)$MRA->audio->duration;
        }

        $meditationReproductionArr = ClientAudio::query()
            ->where('completed', true)
            ->whereHas('audio.phase.category', function ($q) {
                $q->where('id', ClientAudio::MEDITATIONS);
            })->with(['audio'])->whereMonth('created_at', ($month))
            ->get();

        $meditationReproduction = 0;

        foreach ($meditationReproductionArr as $MERA) {
            $meditationReproduction += (int)$MERA->audio->duration;
        }

        return response()->json([
            'recognitionReproduction' => $recognitionReproduction,
            'musicReproduction' => $musicReproduction,
            'meditationReproduction' => $meditationReproduction,
        ]);
    }

    public function alterGoals(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $saleTest = Goal::find($id);
            $saleTest->goal = $request->goal;
            $saleTest->saveOrFail();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Meta correcta'
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

    public function getIncomes()
    {
        $year = Carbon::now()->format('Y');
        $recognitionProgramIncomes = [];
        $wwlfIncomes = [];

        for ($i = 1; $i <= 12; $i++) {
            $recognitionProgramIncomes[$i] = Payment::whereMonth('date', $i)
                ->whereYear('date', $year)
                ->where('programs_id', 1)
                ->sum('price');
        }

        for ($i = 1; $i <= 12; $i++) {
            $wwlfIncomes[$i] = Payment::whereMonth('date', $i)
                ->whereYear('date', $year)
                ->where('programs_id', 3)
                ->orWhere(function ($query) use ($i, $year) {
                    $query->whereMonth('date', $i)
                        ->whereYear('date', $year)
                        ->where('programs_id', 4);
                })->sum('price');
        }

        return response()->json([
            'recognitionIncomes' => $recognitionProgramIncomes,
            'wwlfIncomes' => $wwlfIncomes,
        ]);
    }
}
