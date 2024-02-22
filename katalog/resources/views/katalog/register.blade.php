<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <div class="container">
            <form action='' method='POST' >
                @csrf
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
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ @old('name') }}" name="name" id="name" class="form-control"  placeholder="Enter your Name..">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select value="{{ @old('gender') }}" name="gender" id="gender" class="form-select"  aria-label="Default select example">
                                <option disabled selected hidden>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Number</label>
                            <input type="text" value="{{ @old('number') }}" name="number" id="number" class="form-control"  placeholder="Enter your Phone Number..">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" value="{{ @old('email') }}" name="email" id="email" class="form-control"  placeholder="Enter your Email..">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" value="{{ @old('username') }}" name="username" id="username" class="form-control"  placeholder="Enter Username..">
                        </div>                           
                        <label for="password" class="form-label">Password</label>
                        <input type="password" value="{{ @old('password') }}" name="password" class="form-control" id="password"  placeholder="Enter your Password" aria-describedby="passwordHelp">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>