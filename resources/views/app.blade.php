<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include Bootstrap CSS -->
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Include jQuery -->

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">MCQ APP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@yield('scripts')
<script>
    $(document).ready(function() {
        $(document).on("click","#next-button",function(e) {
            $('#error-message').text('');

            e.preventDefault(); // Prevent the default form submission
            console.log("ues");
            console.log("uesi");

            var selectedAnswer = $('input[name="answer_id"]:checked').val();

            console.log(selectedAnswer);
            if (selectedAnswer) {
                // Serialize the form data to JSON
                var formData = $('#answer-form').serializeArray();
                var jsonData = {};
                $.each(formData, function () {
                    jsonData[this.name] = this.value;
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('submit-answer') }}', // Replace with your route
                    data: $('#answer-form').serialize(), // Serialize the form data
                    success: function(response) {
                        console.log(response);
                        if(response.success){
                            window.location.reload();
                        }

                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle errors here, such as displaying an error message
                        console.log('Error:', textStatus, errorThrown);
                    }
                });
            } else {
                // Display a validation error message
                $('#error-message').text('Please select an answer.');
            }
        });

    });
</script>
</body>
</html>
