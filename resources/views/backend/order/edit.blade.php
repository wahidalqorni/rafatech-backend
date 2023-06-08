@extends('backend.app')
@push('style')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
@endpush
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
                        <h4 class="page-title pull-left">Data Order</h4>

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
                            <h4 class="header-title">Update Order</h4>
                            @if (Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table class="table table-bordered">
                                <tr>
                                    <td>Kode Order</td>
                                    <td>:</td>
                                    <td>{{ $data->kode_order }}</td>
                                </tr>
                                <tr>
                                    <td>Product</td>
                                    <td>:</td>
                                    <td>{{ $data->nama_product }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pemesan</td>
                                    <td>:</td>
                                    <td>{{ $data->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $data->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Beli</td>
                                    <td>:</td>
                                    <td>{{ $data->jumlah }}</td>
                                </tr>
                                <tr>
                                    <td>Harga Satuan</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($data->harga_satuan,2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total Harga</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($data->total_harga,2) }}</td>
                                </tr>
                            </table>
                            <form id="formSubmit" method="POST" action="{{ url('update-order') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="form-group">
                                    <label for="status">Publish</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror"
                                        id="status">
                                        <option value="New" {{ old('status',$data->status) === 'New' ? 'selected' : '' }}>New</option>
                                        <option value="Proses" {{ old('status',$data->status) === 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Finished" {{ old('status',$data->status) === 'Finished' ? 'selected' : '' }}>Finished</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <button class="btn btn-primary" type="submit" id="btnLogin">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Dark table end -->
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
</script>
@endpush