@extends('layout')

@section('content')
    <form method="POST" action="/features/{{ $feature->id}}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
        <label for="feature_name">Feature Name</label>
        <input type="text" class="form-control" id="feature_name" name="feature_name" value="{{ $feature->feature_name}}">
    </div>
    <button class="btn btn-sm btn-warning"><a href="/features">Go back</a></button>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection('content')