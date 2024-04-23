<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Dashoard</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Navbar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
        </nav>
        <section class="py-5">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="container">
                <a href="{{ url('/addproduct') }}">Add Product</a>
                <a href="{{ url('/logout') }}">Logout</a>
                @if(!$dataproduct->isEmpty())
                    @foreach($dataproduct->chunk(4) as $chunk)
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
                        @foreach ($chunk as $item)
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="{{ asset( $item->product_image ) }}" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $item->product_name }}</h5>
                                        <!-- Product price-->
                                        {{ $item->product_price }}
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                            View Product
                                        </button>
                                    </div>
                                </div>
                                <!-- Modal Section -->
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <img class="card-img-top" src="{{ asset( $item->product_image ) }}" alt="..." />
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <!-- Product name-->
                                                <div class="row align-items-start">
                                                    <div class="col">
                                                        <h5 class="card-title">{{ $item->product_name }}</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="card-title text-end">20.000 Like</h5>
                                                    </div>
                                                </div>                                            
                                                <!-- Product price-->
                                                {{ $item->product_price }}
                                                <form action="{{ route('comment.add' , $item->id )}}" method='POST'>
                                                    @csrf
                                                    <input type="text" value="" name="comment" id="comment" class=""  placeholder="Comment">
                                                    <input class="" type="submit" value="Post Comment">
                                                </form>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('product.edit' , $item->id)}}">
                                                    @csrf
                                                    <button type="submit" name="submit" class="btn btn-danger">Edit Product</button>
                                                </form>
                                                <form onsubmit="return confirm('Do You Want to Delete this Product?')" action="{{ route('product.delete' , $item->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" name="submit" class="btn btn-danger">Delete Product</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                @else
                    <h1>Empty!</h1>
                @endif
                
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                @if (is_array($datauser) || $datauser instanceof \Illuminate\Support\Collection)
                    @if(empty($datauser))
                        <h1>Empty!</h1>
                    @else 
                        @foreach($datauser as $item)
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                            </tr>
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->number }}</td>
                                @if ($item->role == 'user')
                                    <td>
                                        <form onsubmit="return confirm('Do You Want to Delete this User Account?')" action="{{ route('user.delete' , $item->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit" class="btn">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        </table>
                        @endforeach
                    @endif
                @endif
            </div> 
        </section>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    </body>
</html>