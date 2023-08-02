@extends('admin.layouts.app')
@php
    $siteInfo = optional(\App\Models\Admin\SiteInfo::find(1));
@endphp

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
            height: 16px;
            width: 16px;
            margin-right: 6px;
        }

        /* list design part */

        .box_list {
            padding: 20px 30px;
            margin: 5px 0px 10px 0px;
            box-shadow: 0px 5px 30px rgb(0 0 0 / 10%);
            border-radius: 5px;
            border: 1px solid #eeeeee;
            position: relative;
        }

        .listName {
            font-size: 20px;
            color: #263442;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .quantity-part {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .plus,
        .minus {
            margin-top: 8px;
        }

        .quantityinputfield {
            width: 100px;
            height: 32px;
            border: 1px solid rgb(43 58 74 / 20%);
            text-align: center;
            color: #263442;
            font-weight: 600;
            background: rgb(43 58 74 / 2%);
        }

        .unit-price-part {}

        .unitPriceInput {
            border: 1px solid rgb(43 58 74 / 20%);
        }

        .discountInput {
            border: 1px solid rgb(43 58 74 / 20%);
        }

        .total-price-part {
            display: flex;
            padding: 9px 15px;
            background: rgb(43 58 74 / 10%);
            color: #2b3a4a;
            font-weight: 600;
            gap: 18px;
        }

        .trash-part button {
            height: 36px;
            width: 36px;
            background: rgb(38 52 66 / 6%);
            margin-right: 5px;
            display: grid;
            place-content: center;
            border-radius: 6px;
            border: 1px solid hsl(211deg 26% 23% / 20%);
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .trash-part i{
            font-size: 18px;
            color: #2b3a4a;
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
            margin: 15px 0px;
        }

        p {
            margin-bottom: 0px
        }

        .addsale_title {
            background: #2b3a4a;
            padding: 10px 20px;
            color: #fff;
            margin: 0px;
            font-size: 20px;
        }

        .card {
            margin-bottom: 30px;
            border: unset;
        }
        
        .card form{
            padding: 30px;
        }

        .subtotal{
            font-size: 20px;
        }

        .subtotal {
            font-size: 16px;
            color: #2b3a4a;
            font-weight: 600;
        }

        button.bg-primary.text-white.border-0.px-2 {
            line-height: 36px;
            display: block;
        }

        .minus.decrease-button,
        .plus.increase-button {
            height: 32px;
            margin: 0;
            background: rgb(51 93 255);
            width: 32px;
            color: #fff;
        }

        .listItemdiv {
            display: flex;
            align-items: stretch;
            gap: 24px;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .box_list_item{
            width: calc(50% - 12px);
        }

    </style>
    
@endpush

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <div class="card-title m-0">
                        <h3 class="text-center addsale_title title-2">
                            @isset($sale)
                                Update
                            @else
                                Add New
                            @endisset Sale
                        </h3>
                    </div>
                    <form
                        action="@isset($sale){{ route('admin.sales.update', $sale->id) }}@else{{ route('admin.sales.submit') }}@endisset"
                        method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label for="product_id"
                                        class="control-label mb-1">Product</label>
                                        <select class="form-control" name="product_id" id="product_id">
                                            <option value="">--Select Product--</option>
                                            @foreach ($products as $product)
                                                @isset($sale)
                                                    <option value="{{ $product->id }}"
                                                        {{ $sale->product_id == $product->id ? ' selected' : '' }}>
                                                        {{ $product->name }}</option>
                                                @else
                                                    <option value="{{ $product->id }}">{{ $product->title }}
                                                    </option>
                                                @endisset
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label for="customer_id"
                                        class="control-label mb-1">Customer</label>
                                        <select class="form-control" name="customer_id" id="customer_id" required>
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
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label for="customer_id"
                                        class="control-label mb-1">Branch</label>
                                        <select class="form-control" name="branch_id" id="branch_id" required>
                                            <option value="">--Select Branch--</option>
                                            @foreach ($branches as $branch)
                                                @isset($sale)
                                                    <option value="{{ $branch->id }}"
                                                        {{ $sale->branch_id == $branch->id ? ' selected' : '' }}>
                                                        {{ $branch->name }}</option>
                                                @else
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}
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
                                <h5 class="mb-3 mt-5">List Product</h5>
                                <div class="listItemdiv">
                                    @foreach (session('list') as $id => $value)
                                     <div class="box_list_item">
                                         <div class="box_list">
                                             <div class="title-part">
                                                 <p class="listName">
                                                     {{ $value['name'] }}
                                                     <input type="text" name="product_id[]"
                                                         value="{{ $id }}" hidden>
                                                 </p>
                                             </div>
                                             <!-- product quantity -->
                                             <div class="quantity-part">
                                                 <button data-id="{{ $id }}" type="button"
                                                     class="minus decrease-button"> <span class="button-minus">
                                                         <i class="fa-solid fa-minus"></i>
                                                     </span></button>
                                                 <input data-id="{{ $id }}" readonly
                                                     name="product_quantity[]" value="{{ $value['quantity'] }}"
                                                     class="quantityinputfield productQuantity" type="text"
                                                     value="1">
                                                 <button data-id="{{ $id }}" type="button"
                                                     class="plus increase-button">
                                                     <i class="fa-solid fa-plus"></i>
                                                 </button>
                                             </div>
                                             
                                             <div class="row mb-3">
                                                 <div class="col-6">
                                                     <!-- unit price -->
                                                     <div class="unit-price-part">
                                                         <label for="">Unit Price</label>
                                                         <input data-id="{{ $id }}"
                                                             class="form-control unitPriceInput unitPrice" type="text"
                                                             name="product_price[]" value="{{ $value['unit_price'] }}">
                                                     </div>
                                                 </div>
                                                 <div class="col-6">
                                                     <!-- discount part -->
                                                     <div class="discount-part">
                                                         <label for="">Discount</label>
                                                         <input data-id="{{ $id }}"
                                                             class="form-control discountInput discount" type="text"
                                                             name="discount[]">
                                                     </div>
                                                 </div>
                                             </div>
 
                                             <div class="d-flex align-items-center mb-3" style="gap: 16px;">
                                                 <!-- renewable -->
                                                 <div class="renewable-part @if($value['is_product_renewable']==0) d-none @endif">
                                                     <input type="checkbox" class="checkboxRenewable"
                                                         id="todo"
                                                         @if ($value['renewable'] === 1) checked @endif
                                                         data-id="{{ $id }}">
                                                     <input type="text" name="renewable[]"
                                                         value="{{ $value['renewable'] }}" id="renewable_{{ $id }}" hidden>
                                                     <label for="todo"
                                                         data-content="Get out of bed"> Renewable</label>
                                                 </div>
                                                 
                                                 <!-- customize -->
                                                 <div class="customization-part">
                                                     <input class="checkboxCustomizable" type="checkbox"
                                                         id="flexCheckChecked"
                                                         @if ($value['is_customization'] === 1) checked @endif
                                                         data-id="{{ $id }}">
                                                     <input type="text" name="customizable[]"
                                                         value="{{ $value['is_customization'] }}" id="customizable_{{ $id }}" hidden>
                                                     <label for="flexCheckChecked"> Customize</label>
                                                 </div>
                                             </div>
 
                                             <!-- total price part -->
                                             <div class="total-price-part">
                                                 <p>Total Price :</p>
                                                 <p data-id="{{ $id }}" class="totalPrice">
                                                     {{ $value['price'] }}</p>
                                                 <input type="text" hidden name="product_total_price[]"
                                                     value="{{ $value['price'] }}">
                                             </div>
                                             
 
                                             <!-- trash -->
                                             <div class="trash-part">
                                                 <button data-id="{{ $id }}" class="deleteItem">
                                                     <i class="fa-solid fa-trash"></i>
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
                                                             id="textAreaExample1" rows="1">{{ $value['customization']['description'] }}</textarea>
 
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
                                         <div style="display: none;" class=" renewableDiv"
                                             data-id="{{ $id }}">
                                             <div class="row">
                                                 <div class="col-md-6">
 
                                                     <div class="form-control ">
                                                         <label class="form-label"
                                                             for="form12">Next Renew Date</label>
                                                         <input data-id="{{ $id }}"
                                                             name="nextRenewDate[]" type="date"
                                                             id="datepicker"
                                                             class="form-control nextRenewDate  form-control-sm"
                                                             value="" />
 
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                    @endforeach
                                </div>   
                            @endif
                        <div class="" style="margin-top: 60px">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="payment_method" class="control-label mb-1">Payment
                                        Method</label>
                                    <select class="form-control border border-gray py-2 px-2 select2"
                                        style="outline:none" name="payment_method"
                                        aria-label="Default select example">
                                        <option selected>--Payment Method--</option>
                                        <option value="bkash">Bkash Online</option>
                                        <option value="bkash">Bkash Manual</option>
                                        <option value="nagad">Nagad Online</option>
                                        <option value="nagad">Nagad Manual</option>
                                        <option value="upay">Cash</option>
                                        <option value="upay">Bank Transfer</option>
                                        <option value="upay">Bank Check</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="subtotal">Subtotal: <span id="subtotal"></span><input type="hidden" id="subtotalInput"></h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 mt-2">
                                                <label class="form-label" for="vat">Vat</label>
                                                <div
                                                    class="border d-flex justify-content-between align-items-center">
                                                    <input class="form-control border-0" id="vat"
                                                        name="vat" style="width:100%" type="text" value="{{optional($siteInfo)->vat}}">
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
                                                    <input class="border-0 form-control" name="total" id="total"
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
                                                    <input class="border-0 form-control" name="paid" id="paid"
                                                        style="width:100%" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3 mt-2">
                                                <label for="due">Due</label>
                                                <div
                                                    class="border d-flex justify-content-between align-items-center">
                                                    <input class="border-0 form-control" name="due" id="due"
                                                        style="width:100%" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <input class="border-0 form-control" name="payment_status" id="paymentStatus"
                                            style="width:100%" hidden type="text">
                                    </div>

                                    <button type="submit"
                                        class="btn rounded-0 px-4 py-1 w-100" style="color: #fff; background: #2b3a4a; border-color: #2b3a4a">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    {{-- Description editor script --}}

    <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#short_description').summernote();
            $('#long_description').summernote();
        });
    </script>

    {{-- SEARCH PRODUCT, ADD AND UPDATE LIST SCRIPT --}}

    <script>
        $('#search').keyup(function() {
            search();
        });

        $('#search').focus(function() {
            search();
        });

        function search() {
            var search = $('#search').val();
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
        }

        $("#product_id").on('change', function() {
            var productId = this.value;
            //alert(productId);
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


    {{-- DELETE LIST ITEM SCRIPT --}}


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

    {{-- CHECKBOX RENEWABLE UPDATE SCRIPT --}}

    <script>
        $(document).ready(function() {
            $('.checkboxRenewable').change(function() {
                var productId = $(this).attr('data-id')
                var isChecked = $(this).prop('checked');
                if (isChecked === true) {
                    updateRenewable(productId, 'true');
                    //alert("#renewable_"+productId);
                    $('#renewable_'+productId).val(1);
                } else {
                    updateRenewable(productId, 'false');
                    $("#renewable_"+productId).val(0);
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
                    $("#customizable_"+productId).val(1);
                } else {
                    updateCustomize(productId, 'false');
                    $("#customizable_"+productId).val(0);
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

{{-- CHECKBOX IS_CUSTOMIZE UPDATE SCRIPT --}}

{{-- UPDATE UNIT PRICE SCRIPT --}}
    <script>
    $(document).ready(function() {
            $('.unitPrice').keyup(function() {
                var productId = $(this).attr('data-id')
                var unit_price = $(this).val();

                // $.ajax({
                //     url: '{{ route('updateListUnitprice') }}',
                //     type: 'POST',
                //     dataType: 'json',
                //     data: {
                //         "_token": "{{ csrf_token() }}",
                //         id: productId,
                //         unit_price: unit_price,
                //     },
                //     success: function(response) {
                //         console.log(response)


                //     },
                //     error: function(xhr, status, error) {
                //         console.log(error);
                //     }
                // });

                calculatePrice(productId);
                
            });

            $('.discount').keyup(function() {
                var productId = $(this).attr('data-id')
                var unit_price = $(this).val();

                calculatePrice(productId);
            });

            function calculatePrice(productId){
                var priceValues = [];
                var totalSum = 0;
                var vatPercentage = parseFloat($('#vat').val()) || 0;
                var quantity = parseInt($('input[data-id="' + productId + '"].productQuantity').val());
                var unitPrice = parseFloat($('input[data-id="' + productId + '"].unitPrice').val());
                var discount = parseFloat($('input[data-id="' + productId + '"].discount').val());
                //alert(discount);
                if(!discount){
                    discount = 0.00;
                }
                var totalPrice = (quantity * unitPrice) - discount;

                $('p[data-id="' + productId + '"].totalPrice').text(totalPrice);
                $('.totalPrice').each(function() {
                    priceValues.push(parseFloat($(this).text()));
                });
                totalSum = priceValues.reduce(function(acc, value) {
                    return acc + value;
                }, 0);
                var vatAmountReduction = totalSum * (vatPercentage / 100);
                var totalValue = totalSum + vatAmountReduction;
                $('#total').val(totalValue.toFixed(2));
                $('#subtotal').text(totalSum.toFixed(2));
                $('#subtotalInput').val(totalSum.toFixed(2));
                $('#due').val(totalValue.toFixed(2));
            }
        })
</script>


    <script>
        $(document).ready(function() {
            $('.customizeDescription').keyup(function() {
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
            $('.customizeAmount').keyup(function() {
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

            $('.increase-button').on('click', function() {
                var productId = $(this).data('id');
                var quantityInput = $('input[data-id="' + productId + '"].productQuantity');

                var quantity = parseInt(quantityInput.val());
                quantity++;

                quantityInput.val(quantity);

                updateTotalPrice(productId, 'increase');
            });


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


            function updateTotalPrice(productId, action) {
                var priceValues = [];
                var totalSum = 0;
                var vatPercentage = parseFloat($('#vat').val()) || 0;
                var quantity = parseInt($('input[data-id="' + productId + '"].productQuantity').val());
                var unitPrice = parseFloat($('input[data-id="' + productId + '"].unitPrice').val());
                var discount = parseFloat($('input[data-id="' + productId + '"].discount').val());
                //alert(discount);
                if(!discount){
                    discount = 0.00;
                }
                var totalPrice = (quantity * unitPrice) - discount;
                console.log(totalPrice)

                $('p[data-id="' + productId + '"].totalPrice').text(totalPrice);
                $('.totalPrice').each(function() {
                    priceValues.push(parseFloat($(this).text()));
                });
                totalSum = priceValues.reduce(function(acc, value) {
                    return acc + value;
                }, 0);
                var vatAmountReduction = totalSum * (vatPercentage / 100);
                var totalValue = totalSum + vatAmountReduction;
                $('#total').val(totalValue.toFixed(2));
                $('#subtotal').text(totalSum.toFixed(2));
                $('#subtotalInput').val(totalSum.toFixed(2));
                $('#due').val(totalValue.toFixed(2));
                $('.checkboxCustomizable').change(function() {
                    var productId = $(this).attr('data-id')
                    var isChecked = $(this).prop('checked');
                    var customizeDivId = $(this).attr('data-id');


                    if (isChecked === true & productId === customizeDivId) {
                        $('.customizableDiv[data-id="' + productId + '"]').show();
                    } else {

                        $('.customizableDiv[data-id="' + productId + '"]').hide();
                    }



                })
                $('.checkboxRenewable').change(function() {
                    var productId = $(this).attr('data-id')
                    var isChecked = $(this).prop('checked');
                    var customizeDivId = $(this).attr('data-id');

                    if (isChecked === true & productId === customizeDivId) {
                        $('.renewableDiv[data-id="' + productId + '"]').show();
                    } else {

                        $('.renewableDiv[data-id="' + productId + '"]').hide();
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

                    var subtotalAmount = $('#subtotalInput').val();

                    totalCustomizationAmount = customizationAmount.reduce(function(acc, value) {
                        return acc + value;
                    }, 0);

                    //var vatAmountReduction = totalSum * (vatPercentage / 100);
                    var vatAmountReduction = subtotalAmount * (vatPercentage / 100);
                    //var reducedTotal = totalSum + vatAmountReduction + totalCustomizationAmount;
                    var reducedTotal = subtotalAmount + vatAmountReduction + totalCustomizationAmount;
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
            var vatPercentage = parseFloat($('#vat').val()) || 0;
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
            var vatAmountReduction = totalSum * (vatPercentage / 100);
            var totalvalue = totalSum + totalCustomizeSum +vatAmountReduction;


            $('#total').val(totalvalue.toFixed(2));
            $('#subtotal').text(totalSum.toFixed(2));
            $('#subtotalInput').val(totalSum.toFixed(2));
            $('#due').val(totalvalue.toFixed(2));
            // $('#vat').val(totalvalue.toFixed(2));

            $('.checkboxCustomizable').each(function() {
                var productId = $(this).attr('data-id');
                var isChecked = $(this).prop('checked');

                if (isChecked && productId) {
                    $('.customizableDiv[data-id="' + productId + '"]').show();
                } else {
                    $('.customizableDiv[data-id="' + productId + '"]').hide();
                }
            });

            $('.checkboxRenewable').each(function() {
                var productId = $(this).attr('data-id');
                var isChecked = $(this).prop('checked');

                if (isChecked && productId) {
                    $('.renewableDiv[data-id="' + productId + '"]').show();
                } else {
                    $('.renewableDiv[data-id="' + productId + '"]').hide();
                }
            });

            $('.checkboxRenewable').change(function() {
                var productId = $(this).attr('data-id')
                var isChecked = $(this).prop('checked');
                var customizeDivId = $(this).attr('data-id');
                // console.log(customizeDivId)

                if (isChecked === true & productId === customizeDivId) {
                    $('.renewableDiv[data-id="' + productId + '"]').show();
                } else {

                    $('.renewableDiv[data-id="' + productId + '"]').hide();
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

            });

            $('.customizeAmount, #vat, #paid').on('input', function() {
                var productId = $(this).attr('data-id');
                var customizationAmount = [];
                var vatPercentage = parseFloat($('#vat').val()) || 0;
                var paidAmount = parseFloat($('#paid').val()) || 0;
                $('.customizeAmount').each(function() {
                    var customizeValue = parseFloat($(this).val()) || 0;
                    customizationAmount.push(customizeValue);
                });

                var subtotalAmount = parseFloat($('#subtotalInput').val());

                totalCustomizationAmount = customizationAmount.reduce(function(acc, value) {
                    return acc + value;
                }, 0);

                //var vatAmountReduction = totalSum * (vatPercentage / 100);
                var vatAmountReduction = subtotalAmount * (vatPercentage / 100);

                //var reducedTotal = totalSum + vatAmountReduction + totalCustomizationAmount;
                var reducedTotal = subtotalAmount + vatAmountReduction + totalCustomizationAmount;

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