<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Models\CreatorDetail;
use App\Models\Dare;
use App\Models\Quizze;
use App\Models\Responder;
use App\Models\ResponderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CreatorDetailController extends Controller
{
    public function index($dare_id)
    {
        $data['dare'] = $dares = Dare::with('quizess')->where(['id' => $dare_id])->first();
        foreach ($dares->quizess as $quizes) {
            $data['quizze'][] =  Quizze::with('choices')->orderBy('id', 'DESC')->where(['id' => $quizes->id])->first();
        }

        return $this->sendResponse($data, 'data recieved');
    }

    public function store($dare_id, Request $request)
    {
        $isExist = Creator::where([['dare_id', '=',  $dare_id], ['creator_ip', '=', $request->ip()]])->first();
        $isCreatorDetailExist = CreatorDetail::where([['dare_id', '=',  $dare_id], ['creator_id', '=', $isExist->id]])->first();
        if (!$isCreatorDetailExist) {
            $status = CreatorDetail::insert($request->answeredData);
            $isExist->share_url = Str::random(20);
            $isExist->save();
        }
        $share_url = URL::to('responder/' . $isExist->share_url);

        return view('creatorDetails.view', compact(['isExist', 'share_url']));
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        Creator::where([['dare_id', '=',  $input['dare_id']], ['id', '=', $input['creator_id']]])->delete();
        CreatorDetail::where([['dare_id', '=',  $input['dare_id']], ['creator_id', '=', $input['creator_id']]])->delete();
        Responder::where([['dare_id', '=',  $input['dare_id']], ['creator_id', '=', $input['creator_id']]])->delete();
        // ResponderDetail::where([['dare_id', '=',  $input['dare_id']], ['creator_id', '=', $input['creator_id']]])->delete();
        return redirect()->route('home');
    }
}
