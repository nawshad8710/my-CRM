<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pos</title>
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
            {{-- <div class="col-md-12 mt-5">
                <h4>Search Result : {{ $products->count() }}</h4>
                <div class="row">
                    <div class="col-md-12">
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <div class="card shadow-0 border rounded-3 mb-3">
                                    <div class="card-body">
                                        <div class="row">

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
            </div> --}}


            <div class="col-md-12">
                <h5 class="mb-1 mt-5">List Product</h5>
                @if (session('list'))
                    <div class="listItemdiv">
                        @foreach (session('list') as $id => $value)
                            <div class=" mb-3 shadow-sm" style="padding-left: 10px">

                            </div>

                            <ul class="list-group mb-4">
                                <li class="list-group-item border border-light shadow-sm">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <div>
                                                <p class="listName fw-bold text-capitalize mb-0">{{ $value['name'] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-flex">
                                                <button type="button" class="decrease-button btn btn-secondary  rounded-0"
                                                    data-id="{{ $id }}">-</button>

                                                <input data-id="{{$id}}" class="w-25 text-center border border-gray" type="text"
                                                    readonly value="{{ $value['quantity'] }}">

                                                <button type="button" class="increase-button btn btn-secondary  rounded-0"
                                                    data-id="{{ $id }}">+</button>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-flex flex-row align-items-center gap-2">
                                                <label for="">Unit Price</label>
                                                <input class="unitPrice border border-gray text-center"
                                                    data-id="{{ $id }}" type="text" style="width: 50px"
                                                    value="{{ $value['unit_price'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-flex flex-row align-items-center gap-2">
                                                <p class="">total Price:
                                                </p>
                                                <p class="totalPrice">{{ $value['price'] }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input checkboxRenewable" type="checkbox"
                                                        name="renewable" value="" id="flexCheckChecked"
                                                        @if ($value['renewable'] === 1) checked @endif
                                                        data-id="{{ $id }}">
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

                                </li>
                            </ul>
                        @endforeach
                @endif

            </div>




        </div>

    </div>

    <form action="{{ route('storeSale') }}" method="POST">
        @csrf
        <div class="container">
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
                                    <input class="border-0 text-capitalize" id="vat" name="vat"
                                        style="width:100%" type="text">
                                    <button class="bg-primary text-white border-0" disabled>%</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-2">
                                <label for="total">Total</label>
                                <div class="border d-flex justify-content-between align-items-center">
                                    <input class="border-0" name="total" id="total" value="0"
                                        style="width:100%" type="text" readonly>
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

                    <button type="submit" class="btn btn-success rounded-0 px-4 py-1">Submit</button>
                </div>
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



        <script>
            $(document).ready(function() {
                $('.decrease-button').click(function(event) {
                    event.preventDefault();
                var unitpriceId =  $(this)->attr('data-id');
                console.log(unitpriceId)
                });
            })
        </script>

    <script>
        $('#search').keyup(function() {
            var search = $(this).val();
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


                    if (data.length > 0) {
                        // Add each suggestion as a dropdown item
                        $.each(data, function(index, suggestion) {
                            console.log(suggestion.id)
                            var suggestionItem = $('<a class="dropdown-item" href="#">' +
                                suggestion.title + '</a>');
                            suggestionItem.click(function(event) {
                                // event.preventDefault();
                                // $('#search').val(suggestion.title);
                                // $('#search-form').submit();
                                var productId = suggestion.id;
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
            var priceValues = [];
            var totalSum = 0;
            var vatAmount = 100;

            $('.totalPrice').each(function() {
                priceValues.push(parseFloat($(this).text()));
            });

            totalSum = priceValues.reduce(function(acc, value) {
                return acc + value;
            }, 0);

            $('#total').val(totalSum.toFixed(2));

            $('#vat, #paid').on('input', function() {
                var vatPercentage = parseFloat($('#vat').val()) || 0;
                var paidAmount = parseFloat($('#paid').val()) || 0;

                var vatAmountReduction = vatAmount * (vatPercentage / 100);
                var reducedTotal = totalSum + vatAmountReduction;

                if (paidAmount > reducedTotal) {
                    paidAmount = reducedTotal;
                    $('#paid').val(paidAmount.toFixed(2));
                }

                var remainingBalance = reducedTotal - paidAmount;

                $('#total').val(reducedTotal.toFixed(2));
                $('#due').val(remainingBalance.toFixed(2));
            });

            $('#vatAmount').on('input', function() {
                vatAmount = parseFloat($(this).val()) || 0;

                var vatPercentage = (vatAmount / totalSum) * 100;
                $('#vat').val(vatPercentage.toFixed(2));

                var reducedTotal = totalSum + vatAmount;
                var paidAmount = parseFloat($('#paid').val()) || 0;

                if (paidAmount > reducedTotal) {
                    paidAmount = reducedTotal;
                    $('#paid').val(paidAmount.toFixed(2));
                }

                var remainingBalance = reducedTotal - paidAmount;

                $('#total').val(reducedTotal.toFixed(2));
                $('#due').val(remainingBalance.toFixed(2));
            });
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
            var newQuantity = 0;

            $('.plusQuantity').click(function() {
                var productId = $(this).data('id');
                var productQuantityValue = parseInt($('#productquantity_' + productId).val());
                newQuantity +=
                    productQuantityValue;
                console.log(newQuantity);
            });

            $('.minusQuantity').click(function() {
                var productId = $(this).data('id');
                console.log(productId);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.checkboxRenewable').change(function() {
                var productId = $(this).attr('data-id')
                var isChecked = $(this).prop('checked');
                if (isChecked === true) {
                    updateRenewable(productId, 'true');
                } else {
                    updateRenewable(productId, 'false');
                }

                function updateRenewable(productId, action) {
                    $.ajax({
                        url: '{{ route('updateListRenewable') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: productId,
                            action: action,
                        },
                        success: function(response) {
                            console.log(response)


                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            })
        })
    </script>


    <script>
        $(document).ready(function() {
            $('.unitPrice').change(function() {
                var productId = $(this).attr('data-id')
                var unit_price = $(this).val();
                // console.log(productId)
                // console.log(unit_price)
                $.ajax({
                    url: '{{ route('updateListUnitprice') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: productId,
                        unit_price: unit_price,
                    },
                    success: function(response) {
                        console.log(response)


                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })
        })
    </script>





</body>

</html>
