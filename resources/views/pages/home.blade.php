@extends('layouts.dashboard')

@section('content')
<div class="bg-dark"></div>
<div class="cart-panel">
    <div class="cart-header">
        <p class="cart-title text-center">Daftar Keranjang</p>
    </div>
    <div class="cart-body">
        <div class="cart-item-list">
        </div>
    </div>
    <div class="cart-footer">
        <div class="btn-cart" data-toggle="modal" data-target="#modalCheckout">
            <p class="text-center">Proses</p>
        </div>
    </div>
</div>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 mr-2 justify-content-end">
            <div id="openCart" class="btn btn-success">Buka Keranjang</div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="menus-content">
            <div class="row item-list">

                @foreach ($products as $item)
                @if ($item->parent_id == "0")
                <div class="col-lg-2 col-md-4 col-sm-6 my-2" data-toggle="modal" data-target="#modalProduct">
                    <div class="card-product shadow" id="{{$item->id}}">
                        <input type="hidden" class="hdnPrice" value="{{$item->sell_price}}">
                        <div class="card-image">
                            <img src="https://img.freepik.com/free-photo/fried-chicken-leg-with-tomato-chili-fried-onion-lettuce-corn-needle-mushroom_1150-25857.jpg?t=st=1732522779~exp=1732526379~hmac=1b7879f7b4633e3ae223aa2327d8a3e95f40654be922686b47b996cdc7d1057e&w=360"
                                width="100%" height="200px" alt="">
                        </div>
                        <div class="card-content">
                            <p class="title">
                                {{$item->product_name}}
                            </p>
                            <p class="category">
                                {{$item->category_name}}
                            </p>
                            <p class="price">
                                Rp {{ number_format($item->sell_price, 0, ',', '.') }}
                            </p>

                        </div>
                    </div>
                </div>
                @endif
                @endforeach

            </div>
            <div class="row item-filter" style="display: none;">

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <input type="hidden" class="hdnPricePrimary" value="">
            </div>
            <div class="modal-body">
                <p class="title">Pilih Varian</p>
                <div class="variant-list mb-2">
                </div>
                <p class="title">Jumlah</p>
                <input type="number" class="txtTotal form-control mt-1 mb-2" id="txtTotal" placeholder="Masukkan Jumlah"
                    value="1">

                <p class="title">Catatan</p>
                <textarea name="txtNote" id="txtNote" class="form-control" cols="30" rows="5"
                    placeholder="Masukkan Catatan"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnModalClose" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnAddOrder">Tambah Pesanan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCheckout" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title-2 fs-5" id="exampleModalLabel">Ringkasan Transaksi</h1>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="" class="title">Nama</label>
                    <input type="text" class="form-control txtName" value="" placeholder="Masukkan Nama">
                </div>
                <br>
                <div class="form-group">
                    <label for="" class="title">Methode Pembayaran</label>
                    <br>
                    <input type="radio" class="rboPayment" name="payment" checked value="cash"> <label
                        for="">Cash</label>
                </div>
                <br>
                <label for="" class="title">Daftar Pesanan</label>
                <div class="item-checkout-list">

                </div>

                <div class="final-price" style="width: 100%; display: flex; justify-content: space-between;">
                    <p class="title" style="font-size: 20px">Total Harga</p>
                    <input type="hidden" class="hdnFinalPrice" value="">
                    <p class="price" style="font-size: 20px; font-weight: bold;"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnModalClose2" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnCheckout">Order Pesanan</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/template" id="tmpCardProduct">
    <div class="col-lg-2 col-md-4 col-sm-6 my-2" data-toggle="modal" data-target="#modalProduct">
    <div class="card-product shadow" id="">
      <input type="hidden" class="hdnPrice" value="">
      <div class="card-image">
        <img src="https://img.freepik.com/free-photo/fried-chicken-leg-with-tomato-chili-fried-onion-lettuce-corn-needle-mushroom_1150-25857.jpg?t=st=1732522779~exp=1732526379~hmac=1b7879f7b4633e3ae223aa2327d8a3e95f40654be922686b47b996cdc7d1057e&w=360" width="100%" height="200px" alt="">
      </div>
      <div class="card-content">
        <p class="title"></p>
        <p class="category"></p>
        <p class="price"></p>
        <p class="stock"></p>
      </div>
    </div>
  </div>
</script>

<script type="text/template" id="tmpCartItem">
    <div class="cart-item">
    <div class="cart-image">
      <img src="https://img.freepik.com/free-photo/fried-chicken-leg-with-tomato-chili-fried-onion-lettuce-corn-needle-mushroom_1150-25857.jpg?t=st=1732522779~exp=1732526379~hmac=1b7879f7b4633e3ae223aa2327d8a3e95f40654be922686b47b996cdc7d1057e&w=360" width="110px" height="110px" alt="">
    </div>
    <div class="cart-item-info">
      <div style="width: 250px; display: flex; justify-content: space-between;">
        <input type="hidden" class="hdnProductItemID" val="">
        <p class="name"></p>
        <p class="total"></p>
        <input type="hidden" class="hdnPriceItem" val="">
      </div>
      <p class="detail"></p>
      <p class="note"></p>
      <div style="width: 250px; display: flex; justify-content: space-between; align-item: center;">
        <p class="price"></p>
        <div class="btn-delete p-1" style="cursor: pointer;">
          <i class="fas fa-trash-alt" style="color: red;"></i>
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/template" id="tmpVariant">
    <div class="variant-item">
    <input type="radio" class="rboVariant" id="" name="variant" value="">
    <input type="hidden" class="hdnPrice" value="" />
    <label for="variant" class="title-variant"></label> 
    <div style="display:flex;">
        <p>Harga : </p><p class="price-product"></p>
    </div>
    <div style="display:flex;">
        <p>Jumlah Stok : </p><p class="stock-available"></p>
    </div>
    <br>
  </div>
</script>

<script type="text/template" id="tmpItemCheckout">
    <div class="item-checkout mb-2">
    <div style="width: 100%; display: flex; justify-content: space-between; ">
        <input type="hidden" class="hdnProductID" value="" />
        <p class="title"> </p>
        <p class="price"></p>
    </div>
    <input type="hidden" class="hdnPriceItem" value="" />
    <p class="total"></p>
    <p class="note"></p>
  </div>
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".category-item").click(function () {
            $(".category-item").removeClass("active");

            var id = $(this).attr("id");

            if (id != "all") {

                $.ajax({
                    url: "{{route('search')}}",
                    type: "GET",
                    data: {
                        'query': id
                    },
                    success: function (data) {
                        $(".item-filter").empty();
                        if (data.length > 0) {
                            $.each(data, function (index, value) {

                                if (value.parent_id == "0") {
                                    var newDiv = $($('#tmpCardProduct').html());
                                    newDiv.find(".card-product").attr("id", value
                                        .id);
                                    newDiv.find(".hdnPrice").val(value.sell_price)
                                    newDiv.find(".title").html(value.product_name);
                                    newDiv.find(".price").html(new Intl
                                        .NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR'
                                        }).format(value.sell_price).replace(
                                            "IDR", ""));

                                    $(".item-filter").append(newDiv);
                                }
                            })
                        } else {
                            $(".item-filter").append(
                                '<p class="text-center">Data tidak tersedia</p>');
                        }
                    }
                })

                $(".item-list").hide();
                $(".item-filter").show();
            } else {
                $(".item-list").show();
                $(".item-filter").hide();
            }
            $(this).addClass('active');
        });

        $("#openCart").click(function () {
            $(".bg-dark").show();
            $('.cart-panel').animate({
                right: '0px'
            }, 200);
        });

        $(".bg-dark").click(function () {
            $(".bg-dark").hide();
            $('.cart-panel').animate({
                right: '-400px'
            }, 200);
        })

        $(".card-product").click(function () {
            var title = $(this).find(".title").html();
            var pricePrimary = $(this).find(".hdnPrice").val();

            var id = $(this).attr("id");

            $.ajax({
                url: "{{route('getvariant')}}",
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    $(".variant-list").empty();

                    if (data.length > 0) {
                        $.each(data, function (index, value) {

                            var stockValue = 0;


                            var newDiv = $($('#tmpVariant').html());

                            newDiv.find('.rboVariant').attr('id', value.id);
                            newDiv.find('.rboVariant').attr('value', value.id);

                            newDiv.find('.hdnPrice').val(value.sell_price);

                            newDiv.find(".price-product").html(new Intl
                                .NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }).format(value.sell_price).replace(
                                    "IDR", ""));

                            newDiv.find(".title-variant").html(value.product_name);

                            $.ajax({
                                url: "{{route('getonestock')}}",
                                type: "GET",
                                data: {
                                    'query': value.id
                                },
                                success: function (data2) {

                                    stockValue += parseInt(data2[0]
                                        .stock);

                                    newDiv.find(".stock-available")
                                        .html(stockValue);
                                    // console.log(data2[0].stock);

                                }
                            })
                            // console.log(stockValue);



                            $(".variant-list").append(newDiv);
                        })
                    } else {
                        $(".variant-list").append(
                            '<p class="text-center">Data tidak tersedia</p>');
                    }
                }
            })

            $(".modal").find(".modal-title").html(title);
            $(".modal").find(".hdnPricePrimary").val(pricePrimary);

        });

        $("#btnAddOrder").click(function () {
            var divModalBody = $('.modal-body');

            if (divModalBody.find('input[name="variant"]:checked').length > 0) {
                var variantID = divModalBody.find('input[name="variant"]:checked').val();

                var productVariantID = divModalBody.find('input[name="variant"]:checked').attr("id");

                var divVariantItem = divModalBody.find('input[name="variant"]:checked').closest(
                    '.variant-item');

                var stockProduct = parseInt(divVariantItem.find(".stock-available").html());

                var variantName = divVariantItem.find('.title-variant').html();

                var priceVariant = divVariantItem.find('.hdnPrice').val();

                var total = parseInt(divModalBody.find('#txtTotal').val());

                var notes = divModalBody.find("#txtNote").val();

                var productName = $(".modal-title").html();

                var divCartItem = $($('#tmpCartItem').html());

                var totalPrice = parseInt(total) * parseInt(priceVariant)

                if (stockProduct < total) {
                    alert("Stok tidak cukup");
                } else {
                    divCartItem.find(".name").html(productName);
                    divCartItem.find(".total").html("x" + total);
                    divCartItem.find(".detail").html(variantName);
                    divCartItem.find(".hdnPriceItem").val(totalPrice);
                    divCartItem.find(".hdnProductItemID").val(productVariantID);
                    if (notes == "") {
                        divCartItem.find(".note").html("-");
                    } else {
                        divCartItem.find(".note").html(notes);
                    }
                    divCartItem.find(".price").html(new Intl
                        .NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(totalPrice).replace("IDR", ""));

                    $(".cart-item-list").append(divCartItem);

                    alert('produk berhasil ditambah');

                    divModalBody.find("#txtTotal").val(1);
                    divModalBody.find("#txtNote").val("");

                    $("#btnModalClose").click();
                }
            } else {
                alert("Pilih variant terlebih dahulu");
            }

        });


        $(".btn-cart").click(function () {
            $(".item-checkout-list").empty();
            var finalPrice = 0;
            $(".cart-item-list .cart-item").each(function () {
                var title = $(this).find('.name').html();
                var detail = $(this).find(".detail").html();
                var price = $(this).find(".price").html();
                var priceInt = parseInt($(this).find(".hdnPriceItem").val());
                var total = $(this).find(".total").html();
                var note = $(this).find(".note").html();
                var hdnPrice = $(this).find(".hdnPriceItem").val();
                var productID = $(this).find(".hdnProductItemID").val();

                var divCheckoutItem = $($('#tmpItemCheckout').html());

                divCheckoutItem.find(".title").html(title + " ( " + detail + " )");
                divCheckoutItem.find(".price").html(price);
                divCheckoutItem.find(".total").html(total);
                divCheckoutItem.find(".note").html(note);
                divCheckoutItem.find(".hdnPriceItem").val(hdnPrice);
                divCheckoutItem.find(".hdnProductID").val(productID);

                $(".item-checkout-list").append(divCheckoutItem);

                finalPrice += priceInt;
            });
            $(".final-price").find(".hdnFinalPrice").val(finalPrice);
            $(".final-price").find(".price").html(new Intl
                .NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(finalPrice).replace("IDR", ""));

        });

        $("#btnCheckout").click(function () {

            var modalCheckout = $("#modalCheckout");

            var name = modalCheckout.find(".txtName").val();

            var totalProduct = 0;

            var orderHDID = 0;

            modalCheckout.find(".item-checkout-list .item-checkout").each(function () {
                var total = parseInt($(this).find(".total").html().replace('x', ''));
                totalProduct += total;
            });

            var totalPrice = modalCheckout.find(".final-price .hdnFinalPrice").val();

            var payment = modalCheckout.find('input[name="payment"]:checked').val();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');


            $.ajax({
                url: "{{route('orderHD')}}",
                type: "POST",
                data: {
                    '_token': csrfToken,
                    'title': "Pesanan",
                    'name': name,
                    'total_product': totalProduct,
                    'total_price': totalPrice,
                    'payment_method': payment

                },
                success: function (data) {

                    orderHDID = data.id;

                    $.ajax({
                        url: "{{route('income')}}",
                        type: "POST",
                        data: {
                            '_token': csrfToken,
                            'income_category_id': 1,
                            'total': totalPrice,
                            'description': "--",
                            'no_reference': orderHDID
                        },
                        success: function (data) {
                            console.log('success');
                        },
                        error: function (data) {
                            console.log("gagal");
                        }
                    })

                    modalCheckout.find(".item-checkout-list .item-checkout").each(
                        function () {
                            var total = parseInt($(this).find(".total").html().replace(
                                'x', ''));
                            var productID = $(this).find(".hdnProductID").val();
                            var price = $(this).find(".hdnPriceItem").val();

                            $.ajax({
                                url: "{{route('orderDT')}}",
                                type: "POST",
                                data: {
                                    '_token': csrfToken,
                                    'order_hd_id': orderHDID,
                                    'product_id': productID,
                                    'total': total,
                                    'price': price
                                },
                                success: function (data) {
                                    console.log('success');
                                },
                                error: function (data) {
                                    console.log("gagal");
                                }
                            })

                            $.ajax({
                                url: "{{route('getonestock')}}",
                                type: "GET",
                                data: {
                                    'query': productID
                                },
                                success: function (data) {

                                    var stockProduct = data[0].stock;

                                    var stockID = data[0].id;

                                    var stockNow = parseInt(stockProduct) -
                                        parseInt(total);

                                    $.ajax({
                                        url: "{{route('admin.stock.update', ':id')}}"
                                            .replace(':id',
                                                stockID),
                                        type: "PATCH",
                                        data: {
                                            '_token': csrfToken,
                                            'product_id': productID,
                                            'stock': stockNow,
                                        },
                                        success: function (data) {

                                            console.log(
                                                "sukses");
                                        },
                                        error: function (data) {
                                            console.log(
                                            "gagal");
                                        }
                                    });

                                }
                            })

                        });

                    $(".item-checkout-list").empty();
                    $(".cart-item-list").empty();
                },
                error: function (data) {
                    console.log("gagal");
                }
            });



            alert("Pesanan berhasil dibuat");

            $("#btnModalClose2").click();

            $(".bg-dark").click();

        });

    });

    $(document).on("click", ".btn-delete", function () {
        // Optional: remove the closest cart item
        $(this).closest(".cart-item").remove();
        alert("Data berhasil dihapus");
    });

</script>

@endsection
