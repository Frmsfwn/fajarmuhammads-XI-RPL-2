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
                <a class="navbar-brand" href="#">E-Katalog</a>
                <a href="{{ url('/addproduct') }}">Add Product</a>
                <span>|</span>
                <a href="{{ url('/logout') }}">Logout</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

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
                <h2>Data Product</h2><br>
                @forelse($dataproduct->chunk(4) as $chunk)
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
                        @foreach ($chunk as $product)
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <img class="card-img-top" src="{{ asset( $product->product_image ) }}" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                            <!-- Product price-->
                                            Rp {{ $product->product_price }}
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <button class="btn btn-primary" data-bs-target="#product{{ $product->id }}" data-bs-toggle="modal">
                                                View Product
                                            </button>
                                        </div>
                                        </div>
                                    <!-- Product Modal -->
                                    <div class="modal fade" id="product{{ $product->id }}" aria-hidden="true" aria-labelledby="product" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <img class="card-img-top" src="{{ asset( $product->product_image ) }}" alt="..." />
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <!-- Product name-->
                                                    <div class="row align-items-start">
                                                        <div class="col">
                                                            <h5 class="card-title">{{ $product->product_name }}</h5>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="card-title text-end">{{ $product->like()->count() }} Like</h5>                                                        </div>
                                                    </div>                                            
                                                    <!-- Product price-->
                                                    Rp {{ $product->product_price }}
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" data-bs-target="#comment{{ $product->id }}" data-bs-toggle="modal">Comment</button>
                                                    <a class="btn btn-primary" role="button" href="{{ url("$product->product_link") }}">Product Link</a>
                                                    <form action="{{ route('product.edit' , $product->id)}}">
                                                        @csrf
                                                        <button type="submit" name="submit" class="btn btn-danger">Edit Product</button>
                                                    </form>
                                                    <form onsubmit="return confirm('Do You Want to Delete this Product?')" action="{{ route('product.delete' , $product->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" name="submit" class="btn btn-danger">Delete Product</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Modal -->
                                    <!-- Comment Modal -->
                                    <div class="modal fade" id="comment{{ $product->id }}" aria-hidden="true" aria-labelledby="comment" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Comment</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row row-gap-3">
                                                        @forelse($product->comment as $comment)
                                                            <div class="col-12">
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <div class="d-flex flex-start">
                                                                            <div class="w-100">
                                                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                                                    <h6 class="text-primary fw-bold mb-0">
                                                                                        {{ $comment->user->username }}
                                                                                        <span class="text-dark ms-2">{{ $comment->comment }}</span>
                                                                                    </h6>
                                                                                    <p class="mb-0">2 days ago</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <h1>Comment Empty!</h1>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" data-bs-target="#product{{ $product->id }}" data-bs-toggle="modal">Back</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Comment Modal -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <h1>Product Empty!</h1>
                @endforelse
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <h2>Data Users</h2><br>
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($datauser as $item)
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
                                    <button type="submit" name="submit" class="btn btn-primary">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @empty
                        <h1>User Empty!</h1>
                    @endforelse
                </table>
            </div> 
        </section>
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; E-Katalog Kelompok 7</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    </body>
</html>