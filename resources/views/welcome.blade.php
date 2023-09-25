@extends('layouts.app')

@section('title', 'Question Page')

@section('content')
    <div class="container">
        <h1>Question</h1>
        <p>{{ $question->text }}</p>

        <!-- Answer Form -->
        <form id="answer-form" method="POST" action="{{ route('submit-answer') }}">
            @csrf
            <input type="hidden" name="question_id" value="{{ $question->id }}">

            <!-- Add your answer input fields here -->

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Next and Skip Buttons -->
        <div class="mt-3">
            <button id="next-button" class="btn btn-success">Next</button>
            <a href="{{ route('skip-question') }}" class="btn btn-warning">Skip</a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Add a click event handler for the "Next" button
            $('#next-button').click(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Validate the form using client-side validation logic (e.g., check if the required fields are filled)
                if (/* Your validation logic here */) {
                    // If the form is valid, submit it via Ajax
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('submit-answer') }}', // Replace with your route
                        data: $('#answer-form').serialize(), // Serialize the form data
                        success: function(response) {
                            // Handle the response, which may include data or a message
                            // You can update the UI here if needed

                            // For example, you can update the page with a new question:
                            $('#question').html(response.question);
                            // Clear the form or do any other necessary actions
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            // Handle errors here, such as displaying an error message
                            console.error('Error:', textStatus, errorThrown);
                        }
                    });
                } else {
                    // Display validation error messages or perform other actions
                }
            });
        });
    </script>
    </body>
    </html>
