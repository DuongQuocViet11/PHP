<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Products</title>
    <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">

</head>
<body>

<div class="container">
    <div class="top_19">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
    </div>
    <div class="row" style="margin-top: 50px">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Add new product</div>
                <div class="card-body">
                    <form action="{{route('store')}}" method="post" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="">Product code</label>
                            <input type="text" name="product_code" class="form-control" placeholder="Enter product code" required="required">
                            <span class="text-danger error-text product_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Product name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="Enter product name" required="required">
                            <span class="text-danger error-text product_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Product price</label>
                            <input type="text" name="product_price" class="form-control" placeholder="Enter product price" required="required">
                            <span class="text-danger error-text product_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Product image</label>
                            <input type="file" name="product_image" class="form-control" required="required">
                            <span class="text-danger error-text product_image_error"></span>
                        </div>
                        <div class="img-holder"></div>
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">All Products</div>
                <div class="card-body" id="AllProducts">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Avatar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$product->id}}</th>
                                <td>{{$product->product_code}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_price}}</td>
                                <td>{{$product->product_image}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
