<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Homepage</title>

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
          <div class="container">
              <h1>{{ $iduser }}</h1>
              <a href="/logout">Logout</a>

              @forelse($dataproduct->chunk(4) as $product)
                  <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
                    @foreach($product as $product)
                      <div class="col mb-5">
                        <!-- Product Card Section -->
                          <div class="card h-100">
                              <!-- Product image-->
                              <img class="card-img-top" src="{{ asset( $product->product_image ) }}" alt="..." />
                              <!-- Product details-->
                              <div class="card-body p-4">
                                  <div class="text-center">
                                      <!-- Product name-->
                                      <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                      <!-- Product price-->
                                      {{ $product->product_price }}
                                  </div>
                              </div>
                              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <button class="btn btn-primary" data-bs-target="#product{{ $product->id }}" data-bs-toggle="modal">
                                        View Product
                                    </button>
                                </div>
                              </div>
                          </div>
                        <!-- End of Product Card Section -->

                        <!-- Product Modal Section -->
                                <!-- Modal 1 -->
                                <div class="modal fade" id="product{{ $product->id }}" aria-hidden="true" aria-labelledby="product" tabindex="-1">
                                  <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">{{ $product->product_name }}</h5>
                                      </div>
                                      <div class="modal-body">
                                          <img src="{{ asset( $product->product_image ) }}" class="img-fluid" alt="..." />
                                          <div class="row align-items-start">
                                            <div class="col">
                                              <h5 class="card-title">{{ $product->product_price }}</h5>
                                            </div>
                                            <div class="col">
                                              <h5 class="card-title text-end">{{ $product->like()->count() }} Like</h5>
                                            </div>
                                            @if(Auth::user()->likedproduct($product))
                                              <div class="col">
                                                <form action="{{ route('like.delete' , $product->id)}}">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-outline-danger">
                                                    <i class="bi bi-heart-fill"></i> Like
                                                  </button>
                                                </form>
                                              </div>
                                            @else
                                              <div class="col">
                                                <form action="{{ route('like.add' , $product->id) }}" method='POST'>
                                                  @csrf
                                                  <button type="submit" class="btn btn-outline-danger">
                                                    <i class="bi bi-heart"></i> Like
                                                  </button>
                                                </form>
                                              </div>
                                            @endif
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button class="btn btn-primary" data-bs-target="#comment{{ $product->id }}" data-bs-toggle="modal">Comment</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!-- Modal 2 -->
                                <div class="modal fade" id="comment{{ $product->id }}" aria-hidden="true" aria-labelledby="comment" tabindex="-1">
                                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Comment</h5>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row row-gap-3">
                                          <div class="col-12">
                                            <form action="{{ route('comment.add' , $product->id , $iduser)}}" method='POST'>
                                              @csrf
                                              <input type="text" value="" name="comment" id="comment" class=""  placeholder="Comment">
                                              <input class="" type="submit" value="Post Comment">
                                            </form>
                                          </div>
                                          @foreach ($product->comment as $comment)
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
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <p class="small mb-0" style="color: #aaa;">
                                                                    @if(Auth::user()->id == $comment->user_id)
                                                                      <a href="{{ route('comment.delete' , $comment->id)}}" class="link-grey">Remove</a> •
                                                                    @endif
                                                                    </p>
                                                                    <div class="d-flex flex-row">
                                                                        <i class="fas fa-star text-warning me-2"></i>
                                                                        <i class="far fa-check-circle" style="color: #aaa;"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                          @endforeach
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button class="btn btn-primary" data-bs-target="#product{{ $product->id }}" data-bs-toggle="modal">Back</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <!-- End Of Product Modal Section -->
                      </div>
                    @endforeach
                  </div>
              @empty
                  <h1>Product Empty!</h1>
              @endforelse
          </div>
        </section>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    </body>
</html>