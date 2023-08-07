<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Creator;
use App\Models\CreatorDetail;
use App\Models\Dare;
use App\Models\Quizze;
use App\Models\Responder;
use App\Models\ResponderDetail;
use Illuminate\Http\Request;

class ResponderController extends Controller
{
    public function index($share_url, Request $request)
    {
        $isExist = Creator::where('share_url', '=', $share_url)->first();
        if (!$isExist) abort(404);

        $isCreatorDetailExist = CreatorDetail::where([['dare_id', '=',  $isExist->dare_id], ['creator_id', '=', $isExist->id]])->get();
        if (!$isCreatorDetailExist) abort(404);

        $dare = Dare::where('id', '=', $isExist->dare_id)->first();

        $isResponderExist = Responder::where([['creator_id', '=',  $isExist->id], ['dare_id', '=',   $isExist->dare_id], ['responder_ip', '=', $request->ip()]])->first();
        if ($isResponderExist) {

            $responderDetail = ResponderDetail::where('responder_id', '=',  $isResponderExist->id)->first();
            if ($responderDetail) {
                $creator =  $isExist;
                $responder =  $isResponderExist;

                $allResponders = Responder::with('responderDetails')->where([['creator_id', '=',  $isExist->id], ['dare_id', '=',   $isExist->dare_id]])->get();

                return view('responderDetails.view', compact(['creator', 'responder', 'responderDetail', 'dare', 'allResponders']));
            }

            foreach ($isCreatorDetailExist as $creatorDetails) {
                $data['quizze'] = Quizze::where('id', '=', $creatorDetails->quizze_id)->first();
                $data['choices'] = Choice::where('quizze_id', '=', $creatorDetails->quizze_id)->get();
                $data['answer_id'] = $creatorDetails->choice_id;
                $finalData[] =  $data;
            }

            $responder_id = $isResponderExist->id;

            $allResponders = Responder::with('responderDetails')->where([['creator_id', '=',  $isExist->id], ['dare_id', '=',   $isExist->dare_id]])->get();

            return view('responderDetails.index', compact(['isExist', 'isCreatorDetailExist', 'dare', 'finalData', 'responder_id', 'allResponders']));
        }

        return view('responders.index', compact(['isExist', 'dare']));
    }

    public function store($share_url, Request $request)
    {
        $input = $request->all();
        $isResponderExist = Responder::where([['creator_id', '=',  $input['creator_id']], ['dare_id', '=',  $input['dare_id']], ['responder_ip', '=', $request->ip()]])->first();


        $isExist = Creator::where('share_url', '=', $share_url)->first();
        if (!$isExist) abort(404);


        $dare = Dare::where('id', '=', $isExist->dare_id)->first();
        $allResponders = Responder::with('responderDetails')->where([['creator_id', '=',  $isExist->id], ['dare_id', '=',   $isExist->dare_id]])->get();

        $input['responder_ip'] = $request->ip();
        if (!$isResponderExist) {
            $input['responder_id'] =  Responder::create($input)->id;
            $responder_id = $input['responder_id'];
        } else {
            $responder_id =  $isResponderExist->id;
            $responderDetail = ResponderDetail::where('responder_id', '=',  $isResponderExist->id)->first();
            if ($responderDetail) {
                $creator =  $isExist;
                $responder =  $isResponderExist;

                $allResponders = Responder::with('responderDetails')->where([['creator_id', '=',  $isExist->id], ['dare_id', '=',   $isExist->dare_id]])->get();

                return view('responderDetails.view', compact(['creator', 'responder', 'responderDetail', 'dare', 'allResponders']));
            }
        }

        $isCreatorDetailExist = CreatorDetail::where([['dare_id', '=',  $isExist->dare_id], ['creator_id', '=', $isExist->id]])->get();
        if (!$isCreatorDetailExist) abort(404);

        foreach ($isCreatorDetailExist as $creatorDetails) {
            $data['quizze'] = Quizze::where('id', '=', $creatorDetails->quizze_id)->first();
            $data['choices'] = Choice::where('quizze_id', '=', $creatorDetails->quizze_id)->get();
            $data['answer_id'] = $creatorDetails->choice_id;
            $finalData[] =  $data;
        }

        return view('responderDetails.index', compact(['isExist', 'isCreatorDetailExist', 'dare', 'finalData', 'responder_id', 'allResponders']));
    }
}
