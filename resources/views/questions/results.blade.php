@extends('app')

@section('content')
    <h1>Question</h1>
    <p>{{ $user->name }} Quiz Result</p>
    <ul>
        <li>    Correct Answered Questions: {{ $correctAnswersCount }} </li>
        <li>    Wrongly Answered questions: {{ $wrongAnsweredQuestions }}  </li>
        <li>    skipped questions: {{ $skippedAnswerCount }} </li>
    </ul>
@endsection
