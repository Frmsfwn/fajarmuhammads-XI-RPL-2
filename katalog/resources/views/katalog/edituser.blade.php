<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edit User</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <div class="container">
            <form action='{{ url('/edituser'.$item->id) }}' method='POST' >
                @csrf
                @method('PUT')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach    
                        </ul>
                    </div>  
                @endif        
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" value="{{ $item->id }}" name="id" id="id" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ $item->name }}" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select"  aria-label="Default select example">
                                <option selected hidden value="{{ $item->gender }}">{{ $item->gender }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Phone Number</label>
                            <input type="text" value="{{ $item->number }}" name="number" id="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" value="{{ $item->email }}" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" value="{{ $item->username }}" name="username" id="username" class="form-control">
                        </div>                           
                        <label for="password" class="form-label">Password</label>
                        <input type="password" value="{{ $item->password }}" name="password" class="form-control" id="password" aria-describedby="passwordHelp">
                        <div id="passwordHelp" class="form-text">
                            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                        </div>
                        <div class="col-12">
                            <input class="btn btn-primary" type="submit" value="Register">
                            <input class="btn btn-primary" type="reset" value="Reset">
                            <input class="btn btn-primary" type="button" value="Cancel" onclick="self.history.back()">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    </body>
</html>