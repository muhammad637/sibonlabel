@extends('pages.index')
@section('pagetitle')
    <li class="breadcrumb-item active fs-6">Laporan</li>
@endsection

@section('container')
    <!-- End Page Title -->
    <div class="font-poppins" style="width: 98%">
        <div class="d-flex mb-3 justify-content-between align-items-end">
            <div class="fs-2 color-black">
                List Laporan
            </div>
            <div class="d-flex justify-content-end gap-2">
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-download"></i> Excel
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/eksportLaporan">Semua</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#bulanan">Bulanan</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#ruangan">Ruangan</a></li>
                    </ul>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="bulanan" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Eksport Laporan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/bulananExcel" method="post">
                                @csrf
                                <div class="modal-body">
                                    <label for="bulanan" class="form-label"> Pilih bulan</label>
                                    <input type="month" id="bulanan" name="bulanan" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="ruangan" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Eksport Laporan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/ruanganExcel" method="post">

                                @csrf
                                <div class="modal-body">
                                    <label for="ruangan" class="form-label"> Pilih Ruangan</label>
                                    <select type="" id="ruangan" name="ruangan_id" class="form-control">
                                        @foreach ($ruangan as $ruang)
                                            <option value="{{ $ruang->id }}">{{ $ruang->nama_ruangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped border" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Nama Produk</th>
                        <th>Nama Ruangan</th>
                        <th>jumlah_order</th>
                        <th>No Telp User</th>
                        <th>No Telp Ruangan</th>
                        <th>status</th>
                        <th>msg</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @php
                            $nohp = $order->user->no_telephone;
                            if (substr(trim($nohp), 0, 1) == '0') {
                                $nohp = '62' . substr(trim($nohp), 1);
                            }
                            $array = json_decode($order->pesan, true);
                            
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->user->nama }}</td>
                            <td>{{ $order->product->nama_product }}</td>
                            <td>{{ $order->ruangan->nama_ruangan }}</td>
                            <td>{{ $order->jumlah_order }}</td>
                            <td><a href="https://wa.me/{{ $nohp }}/?text=SIBONLABEL%0Auntuk : {{ $array['pengorder'] }}%0A{{ $array['msg'] }}%0Adari Admin: {{$array['nama_perubah']}}"
                                    target="_blank" class="badge bg-info p-2">{{ $order->user->no_telephone }}</a>
                            </td>
                            <td>{{ $order->ruangan->no_telephone }}</td>
                            <td>
                                @if ($order->status == 'terima')
                                    <div class="badge bg-success">{{ $order->status }}</div>
                                @elseif($order->status == 'tolak')
                                    <div class="badge bg-danger">{{ $order->status }}</div>
                                @else
                                    <div class="badge bg-warning">Pending</div>
                                @endif
                            </td>
                            <td>

                                <!-- Button trigger modal -->
                                <button type="button"
                                    class="badge @if ($order->status == 'terima') bg-success @else bg-secondary @endif border-0"
                                    data-bs-toggle="modal" data-bs-target="#pesan-modal-{{ $order->id }}">
                                    <i class="bi bi-envelope"></i>
                                </button>


                            </td>
                        </tr>
                        <!-- Modal pesan order-->
                        <div class="modal fade" id="pesan-modal-{{ $order->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pesan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">pengubah : {{ $array['nama_perubah'] }}</li>
                                            <li class="list-group-item">pengorder : {{ $array['pengorder'] }}</li>
                                            <li class="list-group-item mt-5">pesan :
                                                <p>{{ $array['msg'] }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary mx-auto"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
