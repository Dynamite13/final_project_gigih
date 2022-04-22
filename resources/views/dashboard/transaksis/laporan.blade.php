@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Jangka waktu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" onsubmit="return false">
                        <div class="form-group">
                            <label for="">Dari tanggal</label>
                            <input type="date" name="dari" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Sampai tanggal</label>
                            <input type="date" name="sampai" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="filterData()"  class="btn btn-primary btn-sm">Filter</button>
                            <button type="button" onclick="resetData()"  class="btn btn-secondary btn-sm">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-header">
            <h1>Data transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('laporan') }}">Laporan</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            @if (Auth::user()->role == 'admin')
                                <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#filterModal">Filter data</button>
                                <button class="btn btn-danger btn-sm float-right" id="btn-print" onclick="printData()">Print data</button>
                                <button class="btn btn-secondary btn-sm float-right" id="btn-reset" onclick="resetData()">Reset data</button>
                            @else
                                <a href="{{ route('transaksis.create') }}" class="btn btn-primary btn-sm float-right"><i
                                        class="fas fa-plus"></i> Tambah data</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama pelanggan</th>
                                            <th>Nama menu</th>
                                            <th>Jumlah</th>
                                            <th>Nama kasir</th>
                                            <th>Tanggal</th>
                                            <th>Total harga</th>
                                        </tr>
                                    </thead>
                                    <tbody id="load-transaksi"></tbody>
                                </table>
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
        const HitData = (url, data, type) => {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: url,
                    data: data,
                    type: type,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        resolve(response);
                    },
                    error: function(error) {
                        reject(error);
                    }
                });
            })
        }

        async function LoadData(url = '/laporan-transaksi') {
            try {
                const response = await HitData(url, null, 'GET');
                $('#load-transaksi').html(response);
            } catch (error) {
                console.log(error);
            }
        }

        function printData(url = '/laporan?pdf') {
            window.open(url)
        }

        async function filterData() {
            try {
                var btnPrint = $('#btn-print');
                const dari = $('input[name=dari]').val();
                const sampai = $('input[name=sampai]').val();
                const url = `/laporan-transaksi?tanggal_awal=${dari}&tanggal_akhir=${sampai}`;
                const response = await HitData(url, null, 'GET');
                $('#filterModal').modal('hide');
                $('#load-transaksi').html(response);

                btnPrint.removeAttr('onclick');
                btnPrint.attr('onclick', `printData('/laporan?pdf&tanggal_awal=${dari}&tanggal_akhir=${sampai}')`)
            } catch (error) {
                console.log(error);
            }
        }

        async function resetData() {
            try {
                var btnPrint = $('#btn-print');
                const url = '/laporan-transaksi';
                const response = await HitData(url, null, 'GET');
                const dari = $('input[name=dari]').val('');
                const sampai = $('input[name=sampai]').val('');
                $('#filterModal').modal('hide');
                $('#load-transaksi').html(response);
                btnPrint.removeAttr('onclick');
                btnPrint.attr('onclick', `printData()`)
            } catch (error) {
                console.log(error);
            }
        }
        LoadData()
    </script>
@endsection
