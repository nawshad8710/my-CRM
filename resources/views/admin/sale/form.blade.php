@extends('admin.layouts.app')

@section('title', 'Sale Form')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
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

                                <form method="GET" id="search-form" class="mb-3">
                                    <div class="search mt-4 border d-flex justify-content-between"
                                        style="margin: 0 auto; width: 60%">
                                        <div style="width: 100%">
                                            <input type="text" name="search" id="search"
                                                class="form-control border-0" placeholder="Search...."
                                                style="position: relative">
                                            <div id="suggestions-dropdown" class="dropdown-menu"
                                                style="display: none; width:54%; position:absolute; top:28%; left:21%; right:25%">
                                            </div>
                                        </div>
                                        <button class="btn text-white bg-primary rounded-0" type="submit">
                                            <ion-icon name="search-outline"></ion-icon>
                                        </button>
                                    </div>
                                </form>
                                <form
                                    action="@isset($sale){{ route('admin.sales.update', $sale->id) }}@else{{ route('admin.sales.submit') }}@endisset"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">

                                        @if (session('list'))
                                            <h5 class="mb-1 mt-5">List Product</h5>
                                            <div class="listItemdiv">
                                                @foreach (session('list') as $id => $value)
                                                    <div class=" mb-3 shadow-sm" style="padding-left: 10px">

                                                    </div>

                                                    <ul class="list-group mb-4">
                                                        <li class="list-group-item border border-light shadow-sm">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-3">
                                                                    <div>
                                                                        <p class="listName fw-bold text-capitalize mb-0">
                                                                            {{ $value['name'] }}
                                                                            <input type="text" name="product_id[]"
                                                                                value="{{ $id }}" hidden>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="d-flex">
                                                                        <button
                                                                            class="decrease-button btn btn-secondary  rounded-0"
                                                                            data-id="{{ $id }}">-</button>

                                                                        <input class="w-25 text-center border border-gray"
                                                                            type="text" readonly
                                                                            name="product_quantity[]"
                                                                            value="{{ $value['quantity'] }}">

                                                                        <button
                                                                            class="increase-button btn btn-secondary  rounded-0"
                                                                            data-id="{{ $id }}">+</button>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="d-flex flex-row align-items-center gap-2">
                                                                        <label for="">Unit Price</label>
                                                                        <input
                                                                            class="unitPrice border border-gray text-center"
                                                                            data-id="{{ $id }}" type="text"
                                                                            style="width: 50px" name="product_price[]"
                                                                            value="{{ $value['unit_price'] }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="d-flex flex-row align-items-center gap-2">
                                                                        <p class="">total Price:
                                                                        </p>
                                                                        <p class="totalPrice">{{ $value['price'] }}</p>
                                                                        <input type="text" hidden
                                                                            name="product_total_price[]"
                                                                            value="{{ $value['price'] }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">

                                                                    <!--customization field start-->
                                                                    <div class="form-check">
                                                                        <input class="form-check-input checkboxCustomizable"
                                                                            type="checkbox" name="" value=""
                                                                            id="flexCheckChecked" {{-- @if ($value['renewable'] === 1) checked @endif --}}
                                                                            data-id="{{ $id }}">
                                                                        {{-- <input type="text" name="customizable[]"
                                                                            value="{{ $value['customizable'] }}" hidden> --}}
                                                                        <label class="form-check-label ml-2"
                                                                            for="flexCheckChecked">
                                                                            Customizable
                                                                        </label>



                                                                    </div>


                                                                    <!--customization field end-->


                                                                    <div>
                                                                        <div class="form-check">
                                                                            <input
                                                                                class="form-check-input checkboxRenewable"
                                                                                type="checkbox" name=""
                                                                                value="" id="flexCheckChecked"
                                                                                @if ($value['renewable'] === 1) checked @endif
                                                                                data-id="{{ $id }}">
                                                                            <input type="text" name="renewable[]"
                                                                                value="{{ $value['renewable'] }}" hidden>
                                                                            <label class="form-check-label ml-2"
                                                                                for="flexCheckChecked">
                                                                                Renewable
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <div>
                                                                        <button class="deleteItem btn btn-danger"
                                                                            class="btn btn-danger"
                                                                            data-id="{{ $id }}">
                                                                            <ion-icon name="trash-bin"></ion-icon>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="display: none;"
                                                                class=" customizableDiv border border-light shadow p-1 "
                                                                data-id="{{ $id }}">
                                                                <div class="row">

                                                                    <div class="col-md-6">
                                                                        <div class="input-group input-group-sm mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"
                                                                                    id="inputGroup-sizing-sm">Customization
                                                                                    Description</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                class="form-control customizeDescription"
                                                                                aria-label="Sizing example input"
                                                                                name="customizeDescription[]"
                                                                                data-id="{{ $id }}"
                                                                                aria-describedby="inputGroup-sizing-sm">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-group input-group-sm mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"
                                                                                    id="inputGroup-sizing-sm">Customzable
                                                                                    amount</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                data-id="{{ $id }}"
                                                                                class="form-control customizeAmount"
                                                                                aria-label="Sizing example input"
                                                                                name="customizeAmount[]"
                                                                                aria-describedby="inputGroup-sizing-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                        @endif

                                    </div>



                                    <div class="container">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="customer_id" class="control-label mb-1">Customer</label>
                                                    <select class="form-control" name="customer_id" id="customer_id"
                                                        required>
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
                                                <h5>Subtotal</h5>
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

                                                <div class="border d-flex justify-content-between align-items-center">
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
                                                                       PRODUCT CALCULATION SCRIPT
                                                            ----------------------------------------------->
    <script>
        $(document).ready(function() {
            var priceValues = [];
            var totalSum = 0;
            var vatAmount = 100;
            var paymentStatus = 0;
            var customizationValues = [];

            $('.totalPrice').each(function() {
                priceValues.push(parseFloat($(this).text()));
            });

            totalSum = priceValues.reduce(function(acc, value) {
                return acc + value;
            }, 0);

            $('#total').val(totalSum.toFixed(2));

            $('#vat, #paid, .customizeAmount').on('input', function() {


                // console.log(productId)
                var customizationIndex = customizationValues.findIndex(function(item) {
                    // return item.productId === productId;
                });
                var customizationValue = parseFloat($(this).val()) || 0;

                if (customizationIndex !== -1) {
                    customizationValues[customizationIndex].value = customizationValue;
                } else {
                    customizationValues.push({
                        // productId: productId,
                        value: customizationValue
                    });
                }

                var totalCustomization = customizationValues.reduce(function(acc, item) {
                    return acc + item.value;
                }, 0);
                // console.log(customizationValues)


                var vatPercentage = parseFloat($('#vat').val()) || 0;
                var paidAmount = parseFloat($('#paid').val()) || 0;
                var vatAmountReduction = vatAmount * (vatPercentage / 100);
                var reducedTotal = totalSum + vatAmountReduction + totalCustomization;

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
            });
        });
    </script>
    <!----------------------------------------------
                                                        UPDATE LIST BY PRESSING + - BUTTON SCRIPT
                                                            ----------------------------------------------->
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
                            window.location.reload();

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
    <script>
        $(document).ready(function() {
            $('.checkboxCustomizable').change(function() {
                var productId = $(this).attr('data-id')
                var isChecked = $(this).prop('checked');
                var customizeDivId = $(this).attr('data-id');
                // var customizeDescription = ;

                if (isChecked === true & productId === customizeDivId) {
                    $('.customizableDiv[data-id="' + productId + '"]').show();
                } else {

                    $('.customizableDiv[data-id="' + productId + '"]').hide();
                }

            })
        })
    </script>


    <!----------------------------------------------
                                                                   UPDATE UNIT PRICE SCRIPT
                                                        ----------------------------------------------->
    <script>
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
                        window.location.reload();

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })
        })
    </script>
@endpush
