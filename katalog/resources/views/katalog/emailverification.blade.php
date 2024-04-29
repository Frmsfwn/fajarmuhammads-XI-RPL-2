<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Verify Email</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <div class="container">
            <form action='/emailverification' method='POST' >
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
                <?php
                    use Symfony\Component\HttpFoundation\Session\Session;

                    $session = new Session();
                    $user = $session->get('user');
                ?>
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="text" value="{{ $user->email }}" name="email" id="email" aria-label="readonly input example" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">OTP Code</label>
                            <input type="text" value="" name="otp" id="otp" class="form-control"  placeholder="Enter the OTP code..">
                        </div>
                        <div class="col-12">
                            <input class="btn btn-primary" type="submit" value="Submit">
                            <input class="btn btn-primary" type="button" value="Cancel" onclick="self.history.back()">
                            <a href="/emailverification/resendotp/{{ $user->id }}" class="btn btn-primary">Resend OTP</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    </body>
</html>