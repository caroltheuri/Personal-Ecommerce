@extends('layout')


@section('content')
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Created At</th>
            <th colspan="1" style="text-align:center">Actions</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name}}</td>
            <td>{{ $user->email}}</td>
            @if($user->user_types_id == 1)
            <td>Admin</td>
            @endif
            @if($user->user_types_id == 2)
            <td>Buyer</td>
            @endif
            @if($user->user_types_id == 3)
            <td>Seller</td>
            @endif
            <td>{{ $user->created_at->toFormattedDateString() }}</td>
            {{-- <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
            <td><a href="#" class="btn btn-sm btn-success">View</a></td> --}}
            <td>
                <form action="/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    @if(Auth::user()->id !== $user->id)
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    @endif
                    
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
@endsection