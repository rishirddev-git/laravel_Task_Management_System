<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Simple Task Management System</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  </head>
  <body>
    <style>
span.completed {
    background: green;
    border: 1px solid black;
    color: #fff;
    padding: 5px;
    border-radius: 6%;
    font-size: small;
}
span.pending {
    background: #ff6666;
    border: 1px solid black;
    color: #fff;
    padding: 5px;
    border-radius: 6%;
    font-size: small;
}
    </style>
    <div class="bg-dark text-center text-white py-3">
        <h1 class="h2">Simple Task Management System</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary ms-2">Login</a>
            </div>
            <div class="card p-0 mt-3">
                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Tasks</h4>
                </div>
                <div class="card-body shadow-lg">
                    <table id="taskTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Created At</th>
                                <th>Added By</th>
                                <th width="100">Status </th>                               
                            </tr>
                        </thead>
                          <tbody>
                            @forelse($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td>{{ $task->user->name }}</td>
                                <td><span class="{{ $task->status == 'Completed' ? 'completed' : 'pending' }}">{{ $task->status }} </span></td> 
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No tasks found. Time to relax!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#taskTable').DataTable({
            "pageLength": 5,  // Show 5 rows by default
            "order": [[0, "asc"]] // Order by the first column (SN)
        });
    });
</script>
  </body>
</html>