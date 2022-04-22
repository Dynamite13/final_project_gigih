@extends('layouts.app')

@section('title', 'Tambah pesanan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah pesanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pesanan.create') }}">Tambah pesanan</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="card card-primary shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama menu</th>
                                            <th>Harga</th>
                                            <th>Deskripsi</th>
                                            <th>Stok / Ketersediaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $menu->nama_menu }}</td>
                                                <td>{{ 'Rp. ' . number_format($menu->harga, 0, ',', '.') }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($menu->deskripsi, 12) }}</td>
                                                <td>{{ $menu->stok }}</td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="addToCart('{{$menu->id}}')">
                                                        <i class="fas fa-cart-shop"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $menus->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h5 class="card-title">Keranjang pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart-table">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Detail pesanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <ul>
                                        <li>Total menu: <b id="total_menu">0</b></li>
                                        <li>Total transaksi: <b id="total_transaksi">0</b></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary" onclick="postTransaksi()">Simpan transaksi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var data_menu = JSON.parse(`{!! $menus->getCollection() !!}`);
        var menus_in_cart = [];

        function addToCart(menu_id) {
            // filter in data_menu
            var menu = data_menu.filter(function(menu) {
                return menu.id == menu_id;
            });
            
            let data = menus_in_cart.find(function(item){
                return item.id == menu_id;
            });
            if(data){
                data.jumlah++;
                data.total_harga = parseInt(data.harga) * parseInt(data.jumlah);
            } else {
                // add to cart
                menus_in_cart.push({
                    id: menu[0].id,
                    nama_menu: menu[0].nama_menu,
                    harga: menu[0].harga,
                    jumlah: 1,
                    total_harga: menu[0].harga
                });
            }
            // render cart
            renderCart(menus_in_cart);
        }


        function renderCart(menus_in_cart){
            var html = '';
            var total_menu = menus_in_cart.length;
            var total_transaksi = 0;
            for (var i = 0; i < menus_in_cart.length; i++) {
                var menu = menus_in_cart[i];
                total_transaksi += parseInt(menu.total_harga);
                html += `
                    <tr>
                        <td>${i+1}</td>
                        <td>${menu.nama_menu}</td>
                        <td>Rp.${menu.harga}</td>
                        <td>
                            <input type="number" onchange="setQty()" onkeyup="setQty()" id="jumlah-${menu.id}" value="${menu.jumlah}" min="1" max="${menu.stok}">
                        </td>
                        <td id="ttl-${menu.id}">Rp.${menu.total_harga}</td>
                        <td>
                            <button class="btn btn-danger" onclick="removeFromCart('${menu.id}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }
            $('#cart-table').html(html);
            $('#total_menu').html(total_menu);
            $('#total_transaksi').html('Rp.'+total_transaksi);
        }

        function setQty() {
            var menu_id = $(event.target).attr('id').split('-')[1];
            var jumlah = $(event.target).val();
            var menu = menus_in_cart.find(function(item){
                return item.id == menu_id;
            });
            menu.jumlah = jumlah;
            menu.total_harga = parseInt(menu.harga) * parseInt(menu.jumlah);
            $('#ttl-'+menu_id).html(`Rp.${menu.total_harga}`);

        }

        function removeFromCart(menu_id) {
            menus_in_cart = menus_in_cart.filter(function(menu) {
                return menu.id != menu_id;
            });

            // render cart
            renderCart(menus_in_cart);
        }

        function postTransaksi() {
            menus_in_cart.forEach(menu_in_cart => {
                var data = {
                    _token: "{{csrf_token()}}",
                    menu_id: menu_in_cart.id,
                    jumlah: menu_in_cart.jumlah
                };
                $.ajax({
                    url: `{{ route('pesanan.store') }}`,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        menus_in_cart = [];
                        renderCart(menus_in_cart);
                        toastr.success(response.message)
                    },
                    error: function(err) {
                        console.log(err)
                    }
                });
            });

            toastr.warning(`Loading... tunggu ${menus_in_cart.length} menu dalam proses pemesanan`);
        }
    </script>
@endsection