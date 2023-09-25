@extends('app')

@section('content')
    <h1>Question</h1>
    <p>{{ $question->text }}</p>

    <form action="process_answers" method="post" id="answer-form">
        @csrf <!-- Laravel CSRF token -->
        <input type="hidden" name="question_id" value="{{ $question->id }}">

        @foreach ($answers as $answer)
            <label>
                <input type="radio" name="answer_id" value="{{ $answer->id }}">
                {{ $answer->option }}
            </label><br>
        @endforeach
        <div id="error-message" class="text-danger"></div>

        <a href="#" id='next-button' class="btn btn-danger">skip</a>
        <a href="#" class="btn btn-success" id="next-button">next</a>
    </form>
@endsection
