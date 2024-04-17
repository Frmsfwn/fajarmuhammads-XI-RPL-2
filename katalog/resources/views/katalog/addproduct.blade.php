<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Add Product</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <div class="container">
            <form action='' method='POST' enctype="multipart/form-data" >
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
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" value="{{ @old('product_name') }}" name="product_name" id="product_name" class="form-control"  placeholder="Enter Product Name">
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="text" value="{{ @old('product_price') }}" name="product_price" id="product_price" class="form-control"  placeholder="Enter Product Price">
                        </div>
                        <div class="mb-3">
                            <label for="product_link" class="form-label">Product Link</label>
                            <input type="text" value="{{ @old('product_link') }}" name="product_link" id="product_link" class="form-control"  placeholder="Enter Product Link">
                        </div>                          
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Product Image</label>
                            <input type="file" value="" name="product_image" id="product_image" class="form-control">
                        </div>
                        <div class="col-12">
                            <input class="btn btn-primary" type="submit" value="Add Product">
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