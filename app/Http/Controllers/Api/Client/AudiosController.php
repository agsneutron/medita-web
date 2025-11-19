<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\AudioWS;
use App\Http\Resources\Api\Client\PhaseWS;
use App\Http\Resources\Api\Client\RecognitionsProgramWS;
use App\Models\Audio;
use App\Models\Category;
use App\Models\Client;
use App\Models\Phase;
use Illuminate\Http\Request;

class AudiosController extends Controller
{
    public function getAudios($phase)
    {
        /** @var Client $client */
        $client = \Auth::user();

        if($phase == -1){
            $audiosList = Audio::whereActive(true)
                ->whereHas('phase.category.programs', function ($q) use ($client){
                    $q->where('program_id', $client->program_id);
                    $q->where('category_id', 7)->orWhere('category_id', 10);
                })
                ->with(['clientAudio' => function ($query) use ($client){
                    $query->where('client_id',$client->id);
                }])
                ->orderBy('id')
                ->orderBy('number')
                ->get();
        }
        else{
            $audiosList = Audio::wherePhaseId($phase)->whereActive(true)
                ->whereHas('phase.category.programs', function ($q) use ($client){
                    $q->where('program_id', $client->program_id);
                })
                ->with(['clientAudio' => function ($query) use ($client){
                    $query->where('client_id',$client->id);
                }])
                ->orderBy('number')
                ->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => AudioWS::collection($audiosList)
        ]);
    }

    public function getHighTechAudio($phase)
    {
        /** @var Client $client */
        $client = \Auth::user();

        $audiosList = Audio::with(
            ['payments' => function ($query) use ($client) {
                $query->where('client_id',$client->id);
            }, 'clientAudio' => function ($query) use ($client){
                $query->where('client_id',$client->id);
            }
        ])->where('price','>',0)
            ->wherePhaseId($phase)
            ->where(function ($q) use ($client){
                $q->where('active',true)->orWhereHas('payments',function ($query) use ($client){
                    $query->where('client_id',$client->id);
                });
            })
            ->orderBy('number')
            ->whereNull('audio_id')
            ->get();
        $paymentAudio = Audio::whereHas('payments',function ($q) use ($client){
            $q->where('client_id',$client->id);
        },'>',0)
            ->wherePhaseId($phase)->where(function ($q) use ($client){
            $q->where('active',true)->orWhereHas('payments',function ($query) use ($client){
                $query->where('client_id',$client->id);
            });

        })->with(['payments' => function ($query) use ($client) {
            $query->where('client_id',$client->id);
        },'clientAudio' => function ($query) use ($client){
            $query->where('client_id',$client->id);
        }])->whereNotNull('audio_id')->get();

        $audiosList = $audiosList->concat($paymentAudio)->sortBy('id')->values()->all();

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => AudioWS::collection($audiosList)
        ]);
    }

    public function phasesWithAudio($category){

        /** @var Client $client */
        $client = \Auth::user();

        $phases = Phase::whereCategoryId($category)
            ->with(['audio'  => function ($query) use ($client){
                $query->where('active',true)->with(['clientAudio' => function ($query) use ($client){
                    $query->where('client_id',$client->id);
                }])->orderBy('number');
            },'payments'=>function($q) use($client){
                $q->where('client_id',$client->id);
            },])
            ->whereHas('category.programs', function ($q) use ($client){
                $q->where('program_id', $client->program_id);
            })
            ->has('audio','>',0)->where('active',true);

        $mergePhases = Phase::whereId(25)
            ->with(['audio' => function ($query) use ($client){
                $query->where('active',true)->with(['clientAudio' => function ($query) use ($client){
                    $query->where('client_id',$client->id);
                }])->orderBy('number');
            },'payments'=>function($q) use($client){
                $q->where('client_id',$client->id);
            }])->has('audio','>',0)->where('active',true)
            ->union($phases)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => RecognitionsProgramWS::collection($mergePhases)
        ]);
    }
}
