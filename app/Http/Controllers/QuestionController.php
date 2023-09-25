<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function index()
    {
        $results = Result::where('user_id', 2)
            ->groupBy('question_id')
            ->selectRaw('question_id, COUNT(*) as count')
            ->get();
        if(count($results) < 10){
            // Retrieve the first question from the database saveAnswer
            $question = Question::inRandomOrder()->first();

            // Check if a question is found
            if ($question) {
                $answers = Answer::whereQuestionId($question->id)->get();
                return view('questions.index', compact('answers', 'question'));
            } else {
                // Handle the case where no questions are available
                return view('questions.no-questions');
            }
        }else{
            return view('questions.results');

        }

    }

    public function saveAnswer(Request $request)
    {

        $result = Result::make([
            'answer_id' => $request->answer_id,
            'question_id' => $request->question_id,
            'user_id' => session("user_id"),
        ]);
        $result->save();

        if($result){
            return ["success"=>true];
        }
        return ["success"=>false];
    }
}
