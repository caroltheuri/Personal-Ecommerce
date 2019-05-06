@extends('layout')


@section('content')
    <a href="/features/create"  class="btn btn-sm btn-warning" style="margin-top:10px;">Add Feature</a>
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Feature Name</th>
            <th>User Name</th>
            <th>Created At</th>
            <th colspan="2">Actions</th>
        </tr>

        @foreach($features as $feature)
        @if(Auth::user()->id == $feature->user_id)
        <tr>
            <td>{{ $feature->id }}</td>
            <td>{{ $feature->feature_name }}</td>
            <td>{{ $feature->user->name }}</td>
            <td>{{ $feature->created_at->toFormattedDateString() }}</td>
            <td><a href="/features/edit/{{ $feature->id }}" class="btn btn-sm btn-primary">Edit</a></td>
            <td>
                <form action="/features/{{ $feature->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endif
        @endforeach
    </table>
    
@endsection