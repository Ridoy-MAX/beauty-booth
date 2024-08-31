<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    </head>
    <body >


        <div class="container">
            <div class="row">

                                <!-- Filter Form -->
                                <form method="GET" action="{{ route('products.index') }}" class="d-flex m-3">
                                    <select name="category" class="form-select me-2" aria-label="Category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="sort" class="form-select me-2" aria-label="Sort">
                                        <option value="">Sort By</option>
                                        <option value="best_sell" {{ request('sort') == 'best_sell' ? 'selected' : '' }}>Best Selling</option>
                                        <option value="top_rated" {{ request('sort') == 'top_rated' ? 'selected' : '' }}>Top Rated</option>
                                        <option value="price_high_to_low" {{ request('sort') == 'price_high_to_low' ? 'selected' : '' }}>Price: High to Low</option>
                                        <option value="price_low_to_high" {{ request('sort') == 'price_low_to_high' ? 'selected' : '' }}>Price: Low to High</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>

                                @foreach ($products as $product)

                                @php
                                // Calculate total sold quantity for the current product
                                $totalSold = $product->orderDetails->sum('quantity');
                            @endphp
                                <div class="card col-md-3 m-3" style="width: 18rem;">
                                 
                                    <div class="card-body">
                                        <h5 class="card-title">Product : {{ $product->name }}</h5>
                                        Category: {{ $product->categories->first()->name ?? '' }}
                                        <p class="card-text">Price: ${{ $product->price }}</p>

                                        <p class="card-text">Total sold: 

                                     {{$totalSold}}
                                        </p>
                                        <p class="card-text">Average Rating: {{ $product->reviews->avg('rating') ? number_format($product->reviews->avg('rating'), 1) : 'No Reviews' }}</p>
                                        <a href="#" class="card-link">More Details</a>
                                    </div>
                                </div>
                            @endforeach
            
            </div>
        </div>

    </body>
</html>
