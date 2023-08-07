<?php

namespace App\Http\Controllers;

use App\Models\Quizze;
use App\Models\Dare;
use App\Http\Requests\StoreQuizzeRequest;
use App\Http\Requests\UpdateQuizzeRequest;

class QuizzeController extends Controller
{

    public function addQuizze($dare_id)
    {
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $dare_id])->first();
        $quizzes = Quizze::with('choices')->where(['dare_id' => $dare_id])->get();
        return view('quizzes.create', compact(['dare', 'quizzes']));
    }

    public function viewQuizze($dare_id)
    {
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $dare_id])->first();
        $quizzes = Quizze::with('choices')->where(['dare_id' => $dare_id])->get();
        return view('quizzes.view', compact(['dare', 'quizzes']));
    }

    public function editQuizze($quizze_id)
    {
        $singleqQuizze = Quizze::with('choices')->where('id', '=', $quizze_id)->first();
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $singleqQuizze->dare_id])->first();
        $quizzes = Quizze::with('choices')->where(['dare_id' => $singleqQuizze->dare_id])->get();
        return view('quizzes.edit', compact(['dare', 'singleqQuizze', 'quizzes']));
    }

    public function updateQuizze($quizze_id, UpdateQuizzeRequest $request)
    {
        $input = $request->all();
        $quizze = Quizze::where('id', '=', $quizze_id)->first();
        $quizze->update($input);
        return $this->sendSuccess('Quizze Updated Successfully');
    }

    public function storeQuizze(StoreQuizzeRequest $request)
    {
        $input = $request->all();
        $data = Quizze::create($input);
        return $this->sendSuccess('Quizze Created Successfully');
    }

    public function deleteQuizze($quizze_id)
    {
        $quizze = Quizze::where('id', '=', $quizze_id)->delete();
        return back()->with('success', 'Quizze Deleted Successfully');
    }
}
