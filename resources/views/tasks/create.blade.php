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
        <h1 class="h2">Create Task</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{route('dashboard')}}" class="btn btn-sm btn-danger">Back</a>
            </div>
            <div class="card p-0 mt-3">
                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Tasks</h4>
                </div>
                <div class="card-body shadow-lg">
                 <form action="{{route('tasks.store')}}" method="POST">

    @csrf

    <div class="mb-3">
        <label class="form-label">Title</label><br>
        <input value="{{ old('title') }}" class="form-control  @error('title') is-invalid @enderror" type="text" name="title" placeholder="Enter title">
        @error('title')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label><br>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" placeholder="Enter description">
            {{ old('description') }}
        </textarea>
          @error('description')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label><br>
        <select name="status" class="form-select" id="status">
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Due Date</label><br>
        <input value="{{ old('due_date') }}" type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror">
           @error('due_date')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Save Task</button>

</form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   
  </body>
</html>