<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    {{-- search box --}}
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <form method="GET" id="search-form">
                    <div class="search mt-4 border d-flex justify-content-between" style="margin: 0 auto; width: 60%">
                        <div style="width: 100%">
                            <input type="text" name="search" id="search" class="form-control border-0"
                                placeholder="Search....">
                            <div id="suggestions-dropdown" class="dropdown-menu" style="display: none; width:50%"></div>
                        </div>
                        <button class="btn text-white bg-primary rounded-0" type="submit">
                            <ion-icon name="search-outline"></ion-icon>
                        </button>
                    </div>
                </form>

            </div>
            <div class="col-md-12 mt-5">
                <h4>Search Result : {{ $products->count() }}</h4>
                <div class="row">
                    <div class="col-md-12">
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <div class="card shadow-0 border rounded-3 mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- <div class="col-md-4">product title</div>
                                            <div class="col-md-2">Quantity</div>
                                            <div class="col-md-2">hello </div>
                                            <div class="col-md-2">hello</div>
                                            <div class="col-md-2">hello</div> --}}
                                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(4).webp"
                                                        class="w-100" />
                                                    <a href="#!">
                                                        <div class="hover-overlay">
                                                            <div class="mask"
                                                                style="background-color: rgba(253, 253, 253, 0.15);">
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <h5>{{ $product->title }}</h5>
                                                <div class="d-flex flex-row">
                                                    <div class="text-danger mb-1 me-2">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>

                                                </div>

                                                <p class="text-truncate mb-4 mb-md-0">
                                                    {!! $product->short_description !!}
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                <div class="d-flex flex-row align-items-center mb-1">
                                                    <h4 class="mb-1 me-1">${{ $product->price }}</h4>
                                                </div>


                                                <div class="d-flex flex-column mt-4">

                                                    <button class="addTolist btn btn-primary"
                                                        data-id="{{ $product->id }}"
                                                        class="btn btn-outline-primary btn-sm mt-2" type="button">
                                                        Add to list
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>no product found</p>
                        @endif


                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <h5 class="mb-1 mt-5">List Product</h5>
                @if (session('list'))
                    <div class="listItemdiv">
                        @foreach (session('list') as $id => $value)
                            <div class="card mb-3 border border-ligh shadow-sm" style="padding-left: 10px">

                            </div>

                            <ul class="list-group mb-4">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div>
                                                <p class="listName fw-bold text-capitalize mb-0">{{ $value['name'] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <button class="decrease-button btn btn-secondary p-1 rounded-0"
                                                    data-id="{{ $id }}">-</button>

                                                <input class="w-25" type="text" readonly
                                                    value="{{ $value['quantity'] }}">

                                                <button class="increase-button btn btn-secondary p-1 rounded-0"
                                                    data-id="{{ $id }}">+</button>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="">Unit Price</label>
                                                <input type="text" style="width: 50px"
                                                    value="{{ $value['unit_price'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <p>total Price: <span class="totalPrice">{{ $value['price'] }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="renewable" value="" id="flexCheckChecked" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                    Renewable
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div>
                                                <button class="deleteItem btn btn-danger" class="btn btn-danger"
                                                    data-id="{{ $id }}">
                                                    <ion-icon name="trash-bin"></ion-icon>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="d-flex justify-content-between align-items-center">
                                        <div>

                                            <div class=" d-flex justify-content-between">
                                                <p class="listName fw-bold text-capitalize mb-0">{{ $value['name'] }}
                                                </p>
                                                <div>
                                                    <button class="decrease-button btn btn-secondary p-1 rounded-0"
                                                        data-id="{{ $id }}">-</button>

                                                    <input class="w-25" type="text" readonly
                                                        value="{{ $value['quantity'] }}">

                                                    <button class="increase-button btn btn-secondary p-1 rounded-0"
                                                        data-id="{{ $id }}">+</button>

                                                </div>
                                            </div>

                                        </div>
                                        <div>
                                            <label for="">Unit Price</label>
                                            <input type="text" style="width: 50px"
                                                value="{{ $value['unit_price'] }}">
                                        </div>
                                        <div>
                                            <p>total Price: <span class="totalPrice">{{ $value['price'] }}</span></p>
                                        </div>
                                        <div>
                                            <button class="deleteItem btn btn-danger" class="btn btn-danger"
                                                data-id="{{ $id }}">
                                                <ion-icon name="trash-bin"></ion-icon>
                                            </button>
                                        </div>

                                    </div> --}}
                                </li>
                            </ul>
                        @endforeach
                @endif

            </div>




        </div>

    </div>

    <form action="{{ route('storeSale') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h5>Payment Method</h5>
                <select class="form-select" name="payment_method" aria-label="Default select example">
                    <option selected>Select Payment Method</option>
                    <option value="bkash">Bkash</option>
                    <option value="nagad">Nagad</option>
                    <option value="upay">Upay</option>
                </select>
            </div>
            <div class="col-md-6">
                <h5>Subtotal</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 mt-2">
                            <label for="vat">Vat</label>
                            <div class="border d-flex justify-content-between align-items-center">
                                <input class="border-0" id="vat" name="vat" style="width:100%" type="text">
                                <button disabled>%</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 mt-2">
                            <label for="total">total</label>
                            <div class="border d-flex justify-content-between align-items-center">
                                <input class="border-0" name="total" id="total" value="0" style="width:100%"
                                    type="text" readonly>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 mt-2">
                            <label for="vat">Paid</label>
                            <div class="border d-flex justify-content-between align-items-center">
                                <input class="border-0" name="paid" id="paid" style="width:100%"
                                    type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 mt-2">
                            <label for="due">Due</label>
                            <div class="border d-flex justify-content-between align-items-center">
                                <input class="border-0" name="due" id="due" style="width:100%"
                                    type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

    </form>
    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        $('#search').keyup(function() {
            var search = $(this).val();
            console.log(search)
            var url = window.location.origin + '/search-product'
            console.log(url)
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    search: search
                },
                success: function(data) {
                    var dropdown = $('#suggestions-dropdown');
                    dropdown.empty();
                    console.log(data.length)

                    if (data.length > 0) {
                        // Add each suggestion as a dropdown item
                        $.each(data, function(index, suggestion) {
                            console.log(suggestion)
                            var suggestionItem = $('<a class="dropdown-item" href="#">' +
                                suggestion.title + '</a>');
                            suggestionItem.click(function(event) {
                                event.preventDefault();
                                $('#search').val(suggestion.title);
                                $('#search-form').submit();
                            });
                            dropdown.append(suggestionItem);
                        });

                        dropdown.show();
                    } else {
                        dropdown.hide();
                    }
                }
            });
        });
    </script>

    {{-- ---------------- add to list ----------------------------- --}}
    <script>
        $(document).ready(function() {
            $('.addTolist').click(function() {
                var productId = $(this).attr('data-id');
                console.log(productId);
                var url = window.location.origin + '/add-list-product'
                console.log(url)

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: productId,
                    },
                    success: function(data) {
                        updatelistView();
                        console.log(data)

                    }
                });
            });

        });

        function updatelistView() {
            $.ajax({
                url: '{{ route('listProduct') }}',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    var item = response.data

                    $.each(item, function(id, value) {
                        console.log(id, value)
                        window.location.reload();
                    });

                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        }
    </script>



    <script>
        $(document).ready(function() {
            var totalSum = 0;
            var priceValues = [];
            var vatAmount = 100;
            $('.totalPrice').each(function() {
                priceValues.push(parseFloat($(this).text()));
            });
            var newPrices = priceValues.map(function(value) {
                totalSum += value;
            });

            $('#total').val(totalSum.toFixed(2)); //total price..

            // vat
            $('#vat').keyup('input', function() {
                var selectedType = $(this).val();
                var vatPercentage = parseFloat($(this).val());
                var vatReduction = vatAmount * (vatPercentage / 100);
                var reducedTotal = totalSum - vatReduction;

                if (isNaN(vatReduction)) {
                    vatReduction = 0;
                    reducedTotal = totalSum;
                }

                $('#total').val(reducedTotal.toFixed(2));
                $('#due').val(reducedTotal.toFixed(2));
                console.log(vatReduction)
                console.log(reducedTotal)
                var totalAfterVat = $('#total').val();

                $('#paid').keyup('input', function() {
                    var paidAmount = parseFloat($(this).val());
                    console.log(totalAfterVat)

                    if (isNaN(paidAmount)) {
                        paidAmount = 0;
                    }

                    if (paidAmount === 0) {
                        totalAfterVat;
                    } else {
                        if (paidAmount > totalAfterVat) {
                            paidAmount = totalAfterVat;
                            $(this).val(paidAmount.toFixed(2));
                        }

                    }
                    var remainingBalance = Math.max(totalAfterVat - paidAmount, 0);
                    $('#due').val(remainingBalance.toFixed(2));


                    console.log(remainingBalance)
                });









            });
            // paid due
            $('#paid').keyup('input', function() {
                var paidAmount = parseFloat($(this).val());
                var totalAfterVat = $('#total').val();
                console.log(totalAfterVat)

                if (isNaN(paidAmount)) {
                    paidAmount = 0;
                }

                if (paidAmount === 0) {
                    $('#total').val(totalSum.toFixed(2));
                } else {
                    if (paidAmount > totalSum) {
                        paidAmount = totalSum;
                        $(this).val(paidAmount.toFixed(2));
                    }
                    var remainingBalance = Math.max(totalSum - paidAmount, 0);
                    $('#due').val(remainingBalance.toFixed(2));


                    console.log(remainingBalance)
                }
            });

        })
    </script>


    {{-- update list --}}
    <script>
        $(document).ready(function() {
            $('.decrease-button').on('click', function() {
                var productId = $(this).data('id');
                updateQuantity(productId, 'decrease');
            });


            $('.increase-button').on('click', function() {
                var productId = $(this).data('id');
                updateQuantity(productId, 'increase');
            });

            function updateQuantity(productId, action) {
                $.ajax({
                    url: '{{ route('updateList') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: productId,
                        action: action,
                    },
                    success: function(response) {
                        console.log(response)
                        window.location.reload();

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>

    {{-- delete item --}}
    <script>
        $(document).ready(function() {
            $(".deleteItem").on('click', function() {
                var itemid = $(this).data('id');
                console.log(itemid)
                $.ajax({
                    url: '{{ route('deleteItem') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: itemid
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })

        })
    </script>


    <script>
        $(document).ready(function() {
            var newQuantity = 0; // Declare and initialize newQuantity outside the click event handler

            $('.plusQuantity').click(function() {
                var productId = $(this).data('id');
                var productQuantityValue = parseInt($('#productquantity_' + productId).val());
                newQuantity +=
                    productQuantityValue; // Increment newQuantity by the quantity of the specific product
                console.log(newQuantity);
            });

            $('.minusQuantity').click(function() {
                var productId = $(this).data('id');
                console.log(productId);
            });
        });
    </script>

</body>

</html>
