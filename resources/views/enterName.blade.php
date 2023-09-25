@extends('app')

@section('content')
    <h1>Enter Your Name</h1>
    <form method="POST" action="{{ route('save-name') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
