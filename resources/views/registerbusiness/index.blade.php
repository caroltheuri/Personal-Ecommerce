   


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/custom.css">
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Business Name</th>
            <th>Category</th>
            <th>Phone Number</th>
            <th>Logo</th>
            <th>Location</th>
            <th>Created At</th>
        </tr>
        
        @foreach($regbusinesses as $regbusiness)
        <tr>
            <td>{{ $regbusiness->id }}</td>
            <td>{{ $regbusiness->business_name }}</td>
            <td>{{ $regbusiness->category }}</td>
            <td>{{ $regbusiness->phone_number }}</td>
            <td><img src="{{ $regbusiness->logo }}"  style="width:50%;height:40%;"></td>
            <td>{{ $regbusiness->location }}</td>
            <td>{{ $regbusiness->created_at->toFormattedDateString() }}</td>
        </tr>
        @endforeach
        
    </table>
