@extends('layout')

@section('content')
    <form method="POST" action="/features">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="feature_name">Feature Name</label>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
        <input type="text" class="form-control" id="feature_name"  placeholder="Enter Feature Name" name="feature_name">
    </div>
    <button type="submit" class="btn btn-primary">Create Feature</button>
    </form>
@endsection('content')