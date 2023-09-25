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
        $allAnsweredQuestions = Result::where('user_id', session("user_id"))->get();
        if(count($allAnsweredQuestions) < 10){
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
            $correctAnswersCount = Result::where('user_id', session("user_id"))
                ->join('answers', function ($join) {
                    $join->on('results.question_id', '=', 'answers.question_id')
                        ->on('results.answer_id', '=', 'answers.id');
                })
                ->where('answers.is_correct', true) // Assuming there's a column 'is_correct' to indicate correct answers
                ->count();

            $skippedAnswerCount = Result::where('user_id', session("user_id"))
                ->whereNull('answer_id')
                ->count();
            $allAnsweredQuestions = count($allAnsweredQuestions);
            $wrongAnsweredQuestions = $allAnsweredQuestions - $skippedAnswerCount - $correctAnswersCount;
            $user = User::where("id", session('user_id'))->first();
            return view('questions.results', compact(
                'correctAnswersCount',
                'skippedAnswerCount',
                        'allAnsweredQuestions',
                        'wrongAnsweredQuestions',
                        'user'
                )
            );

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
