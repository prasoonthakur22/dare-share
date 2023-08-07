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

class ResponderDetailController extends Controller
{
    public function index($share_url, Request $request)
    {
        $isExist = Creator::where('share_url', '=', $share_url)->first();
        if (!$isExist) abort(404);

        $isCreatorDetailExist = CreatorDetail::where([['dare_id', '=',  $isExist->dare_id], ['creator_id', '=', $isExist->id]])->get();
        if (!$isCreatorDetailExist) abort(404);

        foreach ($isCreatorDetailExist as $creatorDetails) {
            $data['quizze'] = Quizze::where('id', '=', $creatorDetails->quizze_id)->first();
            $data['choices'] = Choice::where('quizze_id', '=', $creatorDetails->quizze_id)->get();
            $data['answer_id'] = $creatorDetails->choice_id;
            $finalData[] =  $data;
        }

        $dare = Dare::where('id', '=', $isExist->dare_id)->first();

        return view('responderDetails.index', compact(['isExist', 'isCreatorDetailExist', 'dare', 'finalData']));
    }

    public function store($creator_id, Request $request)
    {
        $input = $request->all();

        $creator = Creator::where('id', '=', $creator_id)->first();
        if (!$creator) abort(404);

        $dare = Dare::where('id', '=',  $creator->dare_id)->first();
        if (!$dare) abort(404);

        $responder = Responder::where('id', '=',  $input['responder_id'])->first();

        $responderDetail = ResponderDetail::where('responder_id', '=',  $input['responder_id'])->first();

        if (!$responderDetail) {
            $responderDetail_id  = $input['responder_id'] =  ResponderDetail::create($input)->id;
        } else {
            $responderDetail_id = $responder->id;
        }

        $responderDetail = ResponderDetail::where('id', '=',  $responderDetail_id)->first();

        $allResponders = Responder::with('responderDetails')->where([['creator_id', '=',  $creator->id], ['dare_id', '=',   $creator->dare_id]])->get();

        return view('responderDetails.view', compact(['creator', 'responder', 'responderDetail', 'dare', 'allResponders']));
    }
}
