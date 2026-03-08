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
        <h1 class="h2">User Login</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{route('tasks.index')}}" class="btn btn-sm btn-danger">Back</a>
            </div>
   

            <div class="card p-0 mt-3 w-50 mx-auto border p-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Login</h4>
                </div>
                <div class="card-body shadow-lg">
                          @if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif
                 <form method="POST" action="{{ route('login') }}">

    @csrf

    <div class="mb-3">
        <label class="form-label">Email</label><br>
        <input  value="{{ old('email') }}" class="form-control  @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
        @error('email')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label><br>
       <input   value="{{ old('password') }}" class="form-control  @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
        @error('password')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
   

    <button type="submit" class="btn btn-sm btn-primary">Login</button>

</form>
                </div>
            </div>
        </div>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   
  </body>
</html>