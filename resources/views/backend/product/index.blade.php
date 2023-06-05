@extends('backend.app')
@section('content')
    <div class="main-content">
        <!-- header area start -->
        @include('backend.components.headerarea')
        <!-- header area end -->
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Data Product</h4>

                    </div>
                </div>
                @include('backend.components.navbartop')
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="row">
                <!-- Dark table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            {{-- tampilkan pesan success jika ada --}}
                            @if (Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <br>
                            <h4 class="header-title">Daftar Product</h4>
                            <a href="{{ url('add-product') }}" class="btn btn-primary mb-4">Tambah</a>
                            <div class="data-tables datatable-dark">
                                <div class="table-responsive">
                                    <table id="dataTable3" class="text-center">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Kategori</th>
                                                <th>Nama Product</th>
                                                <th>Harga</th>
                                                <th width="15%"></th>
                                                <th width="15%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $item->kode_product }}</td>
                                                    <td>{{ $item->kategori }}</td>
                                                    <td>{{ $item->nama_product }}</td>
                                                    <td>{{ number_format($item->harga,2) }}</td>
                                                    <td>
                                                        <a href="{{ url('edit-product', $item->id ) }}" class="btn btn-success btn-xs">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ url('delete-product', $item->id ) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dark table end -->
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
