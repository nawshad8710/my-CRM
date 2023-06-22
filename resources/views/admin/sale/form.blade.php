@extends('admin.layouts.app')

@section('title', 'Sale Form')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <style>
        .switch.switch-3d .switch-label {
            background-color: #b4b1b1;
        }

        .note-editor.note-airframe .note-editing-area .note-editable,
        .note-editor.note-frame .note-editing-area .note-editable {
            margin-left: 10px;
        }

        input[type=checkbox],
        input[type=radio] {
            height: 25px;
            width: 25px;
        }

        /* list design part */
        .box-list {
            width: 100%;
            padding: 10px 10px 10px 10px;
            margin: 20px 0px 15px 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;

        }

        .quantity-part {
            display: flex;
            align-items: center
        }


        .plus,
        .minus {
            margin-top: 8px
        }

        .quantityinputfield {
            width: 10px;
            height: 20px;
        }

        .unit-price-part {
            display: flex;
            align-items: center
        }

        .unit-price-part>label {
            margin-bottom: 0px
        }


        .unitPriceInput {
            border: 1px solid lightblue;
            width: 50px;
        }

        .total-price-part {
            display: flex;
        }

        .renewable-part,
        .customization-part {
            display: flex;
            align-items: center
        }

        .renewable-part>label,
        .customization-part>label {
            margin-bottom: 0px
        }

        .customizableDiv {
            padding: 5px;
            margin-top: -15px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }

        p {
            margin-bottom: 0px
        }
    </style>
@endpush

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">
                                        @isset($sale)
                                            Update
                                        @else
                                            Add New
                                        @endisset Sale
                                    </h3>
                                </div>
                                <hr>


                                <form
                                    action="@isset($sale){{ route('admin.sales.update', $sale->id) }}@else{{ route('admin.sales.submit') }}@endisset"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="col-md-6">
                                                <form method="GET" id="search-form" class="mb-3">
                                                    <div class="search border d-flex justify-content-between"
                                                        style="margin: 0 auto; width: 100%">
                                                        <div style="width: 100%">

                                                            <input type="text"  id="search"
                                                                class="form-control border-0" placeholder="Search...."
                                                                style="position: relative">
                                                            <div id="suggestions-dropdown" class="dropdown-menu"
                                                                style="display: none; width:84%; position:absolute; left:3%;">
                                                            </div>
                                                        </div>
                                                        <button class="btn text-white bg-primary rounded-0" type="submit">
                                                            <ion-icon name="search-outline"></ion-icon>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-0">
                                                    {{-- <label for="customer_id"
                                                    class="control-label mb-1">Customer</label> --}}
                                                    <select class="form-control" name="customer_id" id="customer_id">
                                                        <option value="">--Select Customer--</option>
                                                        @foreach ($customers as $customer)
                                                            @isset($sale)
                                                                <option value="{{ $customer->id }}"
                                                                    {{ $sale->customer_id == $customer->id ? ' selected' : '' }}>
                                                                    {{ $customer->name }}</option>
                                                            @else
                                                                <option value="{{ $customer->id }}">{{ $customer->name }}
                                                                </option>
                                                            @endisset
                                                        @endforeach
                                                    </select>
                                                    @error('product_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        @if (session('list'))
                                            <h5 class="mb-1 mt-5">List Product</h5>
                                            <div class="listItemdiv">
                                                @foreach (session('list') as $id => $value)
                                                    <div class="box-list">
                                                        <div class="title-part">
                                                            <p class="listName">
                                                                {{ $value['name'] }}
                                                                <input type="text" name="product_id[]"
                                                                    value="{{ $id }}" hidden>
                                                            </p>
                                                        </div>
                                                        <div class="quantity-part">
                                                            <button data-id="{{ $id }}" type="button"
                                                                class="minus decrease-button"> <span class="button-minus">
                                                                    <ion-icon size="small" name="remove-circle-outline">
                                                                    </ion-icon>
                                                                </span></button>
                                                            <input data-id="{{ $id }}" readonly
                                                                name="product_quantity[]" value="{{ $value['quantity'] }}"
                                                                class="quantityinputfield productQuantity" type="text"
                                                                value="1">
                                                            <button data-id="{{ $id }}" type="button"
                                                                class="plus increase-button">
                                                                <ion-icon size="small" name="add-circle-outline">
                                                                </ion-icon>
                                                            </button>
                                                        </div>
                                                        <div class="unit-price-part">
                                                            <label for="" class="mr-2">Unit Price</label>
                                                            <input data-id="{{ $id }}"
                                                                class="unitPriceInput unitPrice text-center" type="text"
                                                                name="product_price[]" value="{{ $value['unit_price'] }}">
                                                        </div>
                                                        <div class="total-price-part">
                                                            <p>Total Price :</p>
                                                            <p data-id="{{ $id }}" class="totalPrice">
                                                                {{ $value['price'] }}</p>
                                                            <input type="text" hidden name="product_total_price[]"
                                                                value="{{ $value['price'] }}">
                                                        </div>
                                                        <div class="renewable-part">
                                                            <input type="checkbox" class="checkboxRenewable"
                                                                id="flexCheckChecked"
                                                                @if ($value['renewable'] === 1) checked @endif
                                                                data-id="{{ $id }}">
                                                            <input type="text" name="renewable[]"
                                                                value="{{ $value['renewable'] }}" hidden>
                                                            <label for="todo"
                                                                data-content="Get out of bed">Renewable</label>

                                                        </div>
                                                        <div class="customization-part">
                                                            <input class="checkboxCustomizable" type="checkbox"
                                                                id="flexCheckChecked"
                                                                @if ($value['is_customization'] === 1) checked @endif
                                                                data-id="{{ $id }}">
                                                                <input type="text" name="customizable[]"
                                                                value="{{ $value['is_customization'] }}" hidden>
                                                            <label for="flexCheckChecked">Customize</label>
                                                        </div>
                                                        <div class="trash-part">

                                                            <button data-id="{{ $id }}" class="deleteItem"
                                                                style="margin-top:5px; color: red">
                                                                <ion-icon size="large" name="trash-bin-outline">
                                                                </ion-icon>
                                                            </button>

                                                        </div>
                                                    </div>

                                                    <div style="display: none;" class=" customizableDiv"
                                                        data-id="{{ $id }}">
                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <div class="form-control ">
                                                                    <label class="form-label"
                                                                        for="textAreaExample">Description</label>
                                                                    <textarea name="customizeDescription[]" data-id="{{ $id }}" class="form-control customizeDescription"
                                                                        id="textAreaExample1" rows="4">{{ $value['customization']['description'] }}</textarea>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                                <div class="form-control ">
                                                                    <label class="form-label"
                                                                        for="form12">Amount</label>
                                                                    <input data-id="{{ $id }}"
                                                                        name="customizeAmount[]" type="text"
                                                                        id="form12"
                                                                        class="form-control customizeAmount  form-control-sm"
                                                                        value="{{ $value['customization']['amount'] }}" />

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                        @endif

                                    </div>



                                    <div class="container" style="margin-top: 60px">

                                        <div class="row">
                                            <div class="col-md-6">

                                                <label for="payment_method" class="control-label mb-1">Payment
                                                    Method</label>
                                                <select class="form-control border border-gray py-2 px-2 select2"
                                                    style="outline:none" name="payment_method"
                                                    aria-label="Default select example">
                                                    <option selected>--Payment Method--</option>
                                                    <option value="bkash">Bkash</option>
                                                    <option value="nagad">Nagad</option>
                                                    <option value="upay">Upay</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Subtotal: <span id="subtotal"></span></h5>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3 mt-2">
                                                            <label for="vat">Vat</label>
                                                            <div
                                                                class="border d-flex justify-content-between align-items-center">
                                                                <input class="border-0 text-capitalize" id="vat"
                                                                    name="vat" style="width:100%" type="text">
                                                                <button class="bg-primary text-white border-0 px-2"
                                                                    disabled>%</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3 mt-2">
                                                            <label for="total">Total</label>
                                                            <div
                                                                class="border d-flex justify-content-between align-items-center">
                                                                <input class="border-0" name="total" id="total"
                                                                    value="0" style="width:100%" type="text"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3 mt-2">
                                                            <label for="vat">Paid</label>
                                                            <div
                                                                class="border d-flex justify-content-between align-items-center">
                                                                <input class="border-0" name="paid" id="paid"
                                                                    style="width:100%" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3 mt-2">
                                                            <label for="due">Due</label>
                                                            <div
                                                                class="border d-flex justify-content-between align-items-center">
                                                                <input class="border-0" name="due" id="due"
                                                                    style="width:100%" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <input class="border-0" name="payment_status" id="paymentStatus"
                                                        style="width:100%" hidden type="text">
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-success rounded-0 px-4 py-1">Submit</button>
                                            </div>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!----------------------------------------------
                                                                                                                                    DESCRIPTION EDITOR SCRIPT
                                                                                                                        ----------------------------------------------->
    <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#short_description').summernote();
            $('#long_description').summernote();
        });
    </script>
    <!------------------------------------------------------
                                                                                                                    SEARCH PRODUCT, ADD AND UPDATE LIST SCRIPT
                                                                                                                        ----------------------------------------------->
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
                        $.each(data, function(index, suggestion) {
                            console.log(suggestion.id)
                            var suggestionItem = $('<a class="dropdown-item" href="#">' +
                                suggestion.title + '</a>');
                            suggestionItem.click(function(event) {
                                var productId = suggestion.id;
                                var url = window.location.origin + '/add-list-product'
                                $.ajax({
                                    url: url,
                                    method: 'POST',
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        id: productId,
                                    },
                                    success: function(data) {
                                        updatelistView();


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


    <!----------------------------------------------
                                                                                                                       DELETE LIST ITEM SCRIPT
                                                                                                            ----------------------------------------------->
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
    <!----------------------------------------------
                                                                                                                       CHECKBOX RENEWABLE UPDATE SCRIPT
                                                                                                            ----------------------------------------------->
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
            $('.checkboxCustomizable').change(function() {
                var productId = $(this).attr('data-id')
                var isChecked = $(this).prop('checked');
                if (isChecked === true) {
                    updateCustomize(productId, 'true');
                } else {
                    updateCustomize(productId, 'false');
                }

                function updateCustomize(productId, action) {
                    $.ajax({
                        url: '{{ route('updateListCustomization') }}',
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


    <!----------------------------------------------
                                                                                                                       CHECKBOX IS_CUSTOMIZE UPDATE SCRIPT
                                                                                                            ----------------------------------------------->



    <!----------------------------------------------
                                                                                                                       UPDATE UNIT PRICE SCRIPT
                                                                                                            ----------------------------------------------->
    {{-- <script>
    $(document).ready(function() {
            $('.unitPrice').change(function() {
                var productId = $(this).attr('data-id')
                var unit_price = $(this).val();

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
</script> --}}


    <script>
        $(document).ready(function() {
            $('.customizeDescription').change(function() {
                var productId = $(this).attr('data-id')
                var customizeDescription = $(this).val();
                console.log(productId)
                console.log(customizeDescription)

                $.ajax({
                    url: '{{ route('updateListCustomizeDescription') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: productId,
                        description: customizeDescription,
                    },
                    success: function(response) {
                        console.log(response)


                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })
            $('.customizeAmount').change(function() {
                var productId = $(this).attr('data-id')
                var customizeAmount = $(this).val();
                console.log(productId)
                console.log(customizeAmount)

                $.ajax({
                    url: '{{ route('updateListCustomizeAmount') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: productId,
                        amount: customizeAmount,
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




    <script>
        $(document).ready(function() {
            // Increase button click event
            $('.increase-button').on('click', function() {
                var productId = $(this).data('id');
                var quantityInput = $('input[data-id="' + productId + '"].productQuantity');

                var quantity = parseInt(quantityInput.val());
                quantity++;

                quantityInput.val(quantity);

                updateTotalPrice(productId, 'increase');
            });

            // Decrease button click event
            $('.decrease-button').on('click', function() {
                var productId = $(this).data('id');
                var quantityInput = $('input[data-id="' + productId + '"].productQuantity');

                var quantity = parseInt(quantityInput.val());
                if (quantity > 1) {
                    quantity--;
                    quantityInput.val(quantity);

                    updateTotalPrice(productId, 'decrease');
                }
            });

            // Function to update the total price
            function updateTotalPrice(productId, action) {
                var priceValues = [];
                var totalSum = 0;
                var quantity = parseInt($('input[data-id="' + productId + '"].productQuantity').val());
                var unitPrice = parseFloat($('input[data-id="' + productId + '"].unitPrice').val());
                var totalPrice = quantity * unitPrice;
                console.log(totalPrice)

                $('p[data-id="' + productId + '"].totalPrice').text(totalPrice);
                $('.totalPrice').each(function() {
                    priceValues.push(parseFloat($(this).text()));
                });
                totalSum = priceValues.reduce(function(acc, value) {
                    return acc + value;
                }, 0);
                $('#total').val(totalSum.toFixed(2));
                $('#subtotal').text(totalSum.toFixed(2));
                $('#due').val(totalSum.toFixed(2));
                $('.checkboxCustomizable').change(function() {
                    var productId = $(this).attr('data-id')
                    var isChecked = $(this).prop('checked');
                    var customizeDivId = $(this).attr('data-id');
                    // console.log(customizeDivId)

                    if (isChecked === true & productId === customizeDivId) {
                        $('.customizableDiv[data-id="' + productId + '"]').show();
                    } else {

                        $('.customizableDiv[data-id="' + productId + '"]').hide();
                    }



                })
                $('.customizeAmount, #vat, #paid').on('input', function() {
                    var productId = $(this).attr('data-id');
                    var customizationAmount = [];
                    var vatPercentage = parseFloat($('#vat').val()) || 0;
                    var paidAmount = parseFloat($('#paid').val()) || 0;
                    $('.customizeAmount').each(function() {
                        var customizeValue = parseFloat($(this).val()) || 0;
                        customizationAmount.push(customizeValue);
                    });

                    totalCustomizationAmount = customizationAmount.reduce(function(acc, value) {
                        return acc + value;
                    }, 0);

                    var vatAmountReduction = totalSum * (vatPercentage / 100);
                    var reducedTotal = totalSum + vatAmountReduction + totalCustomizationAmount;
                    if (paidAmount > reducedTotal) {
                        paidAmount = reducedTotal;
                        $('#paid').val(paidAmount.toFixed(2));
                    }

                    var remainingBalance = reducedTotal - paidAmount;
                    if (remainingBalance === 0) {
                        paymentStatus = 1;

                    } else if (remainingBalance < reducedTotal && remainingBalance > 0) {
                        paymentStatus = 2;
                    } else {
                        paymentStatus = 0;
                    }
                    console.log(paymentStatus)
                    $('#total').val(reducedTotal.toFixed(2));
                    $('#due').val(remainingBalance.toFixed(2));
                    $('#paymentStatus').val(paymentStatus);
                    console.log(productId)
                    console.log(customizationAmount)
                    console.log(totalCustomizationAmount)

                })


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


                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }

        })
    </script>


    <script>
        $(document).ready(function() {
            var totalSum = 0;
            var totalCustomizeSum = 0;
            var vatAmount = 100;
            var paymentStatus = 0;
            var priceValues = [];
            var customizePriceValues = [];
            var totalCustomizationAmount = 0;

            $('.totalPrice').each(function() {
                priceValues.push(parseFloat($(this).text()));
            });
            $('.customizeAmount').each(function() {
                var customizeValue = parseFloat($(this).val()) || 0;
                customizePriceValues.push(customizeValue);
            });

            totalCustomizeSum = customizePriceValues.reduce(function(acc, value) {
                return acc + value;
            }, 0);

            totalSum = priceValues.reduce(function(acc, value) {
                return acc + value;
            }, 0);
            var totalvalue = totalSum + totalCustomizeSum;


            $('#total').val(totalvalue.toFixed(2));
            $('#subtotal').text(totalSum.toFixed(2));
            $('#due').val(totalvalue.toFixed(2));

            $('.checkboxCustomizable').each(function() {
                var productId = $(this).attr('data-id');
                var isChecked = $(this).prop('checked');

                if (isChecked && productId) {
                    $('.customizableDiv[data-id="' + productId + '"]').show();
                } else {
                    $('.customizableDiv[data-id="' + productId + '"]').hide();
                }
            });
            $('.checkboxCustomizable').change(function() {
                var productId = $(this).attr('data-id')
                var isChecked = $(this).prop('checked');
                var customizeDivId = $(this).attr('data-id');
                // console.log(customizeDivId)

                if (isChecked === true & productId === customizeDivId) {
                    $('.customizableDiv[data-id="' + productId + '"]').show();
                } else {

                    $('.customizableDiv[data-id="' + productId + '"]').hide();
                }



            })
            $('.customizeAmount, #vat, #paid').on('input', function() {
                var productId = $(this).attr('data-id');
                var customizationAmount = [];
                var vatPercentage = parseFloat($('#vat').val()) || 0;
                var paidAmount = parseFloat($('#paid').val()) || 0;
                $('.customizeAmount').each(function() {
                    var customizeValue = parseFloat($(this).val()) || 0;
                    customizationAmount.push(customizeValue);
                });

                totalCustomizationAmount = customizationAmount.reduce(function(acc, value) {
                    return acc + value;
                }, 0);

                var vatAmountReduction = totalSum * (vatPercentage / 100);
                var reducedTotal = totalSum + vatAmountReduction + totalCustomizationAmount;
                if (paidAmount > reducedTotal) {
                    paidAmount = reducedTotal;
                    $('#paid').val(paidAmount.toFixed(2));
                }

                var remainingBalance = reducedTotal - paidAmount;
                if (remainingBalance === 0) {
                    paymentStatus = 1;

                } else if (remainingBalance < reducedTotal && remainingBalance > 0) {
                    paymentStatus = 2;
                } else {
                    paymentStatus = 0;
                }
                console.log(paymentStatus)
                $('#total').val(reducedTotal.toFixed(2));
                $('#due').val(remainingBalance.toFixed(2));
                $('#paymentStatus').val(paymentStatus);
                console.log(productId)
                console.log(customizationAmount)
                console.log(totalCustomizationAmount)

            })
        })
    </script>
@endpush
