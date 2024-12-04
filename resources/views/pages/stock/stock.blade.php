@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Stok</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Stok</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Stok Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="dataStock1">
                        <div class="btn btn-success" id="btnUpdateStock">
                            Update Stok
                        </div>
                        <table class="myTable table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th style="width: 10%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    @forelse ($stocks as $stock)
                                        <td>{{ $loop->iteration }}</td>
                                <td>{{ $stock->product->product_name }}</td>
                                <td>{{ $stock->stock }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </td>
                                @empty
                                <td colspan="4" class="text-center">Tidak ada data</td>
                                @endforelse
                                </tr> --}}
                                <tr>
                                    <td>1</td>
                                    <td>Indomie</td>
                                    <td>10</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="card-body" id="dataStock2" style="display: none">
                        <div class="btn btn-primary mb-2" id="btnSaveStock">
                            Simpan Stok
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 40%">Nama</th>
                                    <th style="width: 10%">Stok Saat Ini</th>
                                    <th style="width: 10%">Stok Penambahan</th>
                                    <th style="width: 10%">Total Stock</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    @forelse ($stocks as $stock)
                                        <td>{{ $loop->iteration }}</td>
                                <td>{{ $stock->product->product_name }}</td>
                                <td>{{ $stock->stock }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </td>
                                @empty
                                <td colspan="4" class="text-center">Tidak ada data</td>
                                @endforelse
                                </tr> --}}
                                <tr class="product-item">
                                    <td>1</td>
                                    <td class="name">Indomie</td>
                                    <td class="stock-product">0</td>
                                    <td>
                                        <input type="number" class="form-control txtStock" >
                                    </td>
                                    <td class="total-stock">
                                        0
                                    </td>
                                    <td >
                                        <input type="hidden" id="hdnPriceBuy" value="20000">
                                        <p class="cost-product">-</p>
                                    </td>
                                </tr>
                                <tr class="product-item">
                                    <td>1</td>
                                    <td class="name">Indomie</td>
                                    <td class="stock-product">0</td>
                                    <td>
                                        <input type="number" class="form-control txtStock">
                                    </td>
                                    <td class="total-stock">
                                        0
                                    </td>
                                    <td >
                                        <input type="hidden" id="hdnPriceBuy" value="20000">
                                        <p class="cost-product">-</p>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#btnUpdateStock").click(function () {
            $("#dataStock1").hide();
            $("#dataStock2").fadeIn();
        });

        $("#btnSaveStock").click(function () {
            $("#dataStock2").hide();
            $("#dataStock1").fadeIn();
        });


        $(".txtStock").on("keyup", function () {
            

            var divProduct = $(this).closest(".product-item");

            var data = $(this).val();

            if (data == "") {
                
                var dataStockNow = divProduct.find(".stock-product").html();

                divProduct.find('.total-stock').html(parseInt(dataStockNow));

                divProduct.find('.cost-product').html("-");
            } else {

                
                var dataStockNow = divProduct.find(".stock-product").html();

                var totalStock = parseInt(data) + parseInt(dataStockNow);

                divProduct.find('.total-stock').html(totalStock);

                var priceProduct = divProduct.find("#hdnPriceBuy").val();

                var costBuy = parseInt(totalStock) * parseInt(priceProduct);

                divProduct.find('.cost-product').html(costBuy);
            }


        });

    });

</script>
@endsection
