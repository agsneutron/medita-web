<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\EmotionalStatistic;
use Illuminate\Http\Request;
use DB;

class EmotionalStatisticsController extends Controller
{
    public function statisticsRegister(Request $request)
    {
        $sleepBetter = $request->input('sleep_better', false);
        $reduceAnxiety = $request->input('reduce_anxiety', false);
        $learnMeditate = $request->input('learn_meditate', false);
        $certifyMeditation = $request->input('certify_meditation', false);
        $another = $request->input('another', false);

        $emotionalStatistics = EmotionalStatistic::get();

        try {
            DB::beginTransaction();
            /** @var EmotionalStatistic $item */
            foreach ($emotionalStatistics as $item) {
                $count = $item->count + 1;

                switch ($item->id) {
                    case EmotionalStatistic::SLEEP_BETTER:
                        if ($sleepBetter) {
                            $item->count = $count;
                        }
                        break;

                    case EmotionalStatistic::REDUCE_ANXIETY:
                        if ($reduceAnxiety) {
                            $item->count = $count;
                        }
                        break;

                    case EmotionalStatistic::LEARN_MEDITATE:
                        if ($learnMeditate) {
                            $item->count = $count;
                        }
                        break;

                    case EmotionalStatistic::CERTIFY_MEDITATION:
                        if ($certifyMeditation) {
                            $item->count = $count;
                        }
                        break;

                    case EmotionalStatistic::ANOTHER:
                        if ($another) {
                            $item->count = $count;
                        }
                        break;
                }

                $item->saveOrFail();

                DB::commit();
            }

            return response()->json([
                'success' => true,
                'message' => 'Acción exitosa',
            ]);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error al registrar al usuario'
            ]);
        }


    }
}
