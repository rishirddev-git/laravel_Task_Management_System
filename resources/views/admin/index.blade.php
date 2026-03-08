<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Simple Task Management System</title>
  </head>
  <body>
    <div class="bg-dark text-center text-white py-3">
        <h1 class="h2">Welcome to your Dashboard, {{ Auth::user()->name }}!</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{route('tasks.create')}}" class="btn btn-sm btn-dark">create</a>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-primary ms-2" type="submit">Logout</button>
                </form>
            </div>
              @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2 p-1 mb-0" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-sm btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
            <div class="card p-0 mt-3">
                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Tasks</h4>
                </div>
                <div class="card-body shadow-lg">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Added By</th>
                                <th width="130">Status </th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                        </thead>
                          <tbody>
                            @forelse($tasks as $task)
                            <tr>
                                <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->user->name }}</td>                               
                                <td class="text-center">
                                    <select name="status" class="form-select" id="status-{{ $task->id }}" 
                                                onchange="updateTaskStatus(this, {{ $task->id }})">
                                            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        </select>

                                        <span id="status-msg-{{ $task->id }}" class="small"></span>
                                            </td>                               
                                <td class="text-center">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-dark btn-sm">Edit</a>
                                    <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"  class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Move this task to trash?')"> Delete </button>
                                        </form>
                                   
                                </td>
                            </tr>
                             @empty
                                <tr>
                                    <td colspan="7">No tasks found. Time to relax!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    function updateTaskStatus(selectElement, taskId) {
    const status = selectElement.value;
    const messageSpan = document.getElementById('status-msg-' + taskId);

    // Show a "Saving..." text immediately
    messageSpan.innerText = " Saving...";
    messageSpan.className = "text-muted small";

    fetch(`/tasks/${taskId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageSpan.innerText = " ✓ Updated";
            messageSpan.className = "text-success small";
        } else {
            messageSpan.innerText = " ✗ Error";
            messageSpan.className = "text-danger small";
        }
        
        // Hide the message after 2 seconds
        setTimeout(() => { messageSpan.innerText = ""; }, 2000);
    })
    .catch(error => {
        messageSpan.innerText = " ✗ Connection Error";
        messageSpan.className = "text-danger small";
    });
}
</script>
  </body>
</html>