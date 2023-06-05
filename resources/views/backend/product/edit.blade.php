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
                            <h4 class="header-title">Update Product</h4>
                            @if (Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form id="formSubmit" method="POST" action="{{ url('update-product') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="form-group">
                                    <label for="kode_product">Kode Product</label>
                                    <input type="kode_product" class="form-control @error('kode_product') is-invalid @enderror"
                                        name="kode_product" id="kode_product" aria-describedby="kode_productHelp"
                                        placeholder="Enter kode product" value="{{ old('kode_product',$data->kode_product) }}" disabled>
                                    @error('kode_product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_product">Nama Product</label>
                                    <input type="text" class="form-control @error('nama_product') is-invalid @enderror"
                                        name="nama_product" id="nama_product" aria-describedby="nama_productHelp"
                                        placeholder="Enter nama product" value="{{ old('nama_product',$data->kategori) }}" required>
                                    @error('nama_product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                                        id="kategori">
                                        <option value="Elektronik" {{ old('kategori',$data->kategori) === 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                        <option value="Pakaian" {{ old('kategori',$data->kategori) === 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                        <option value="Pecah Belah" {{ old('kategori',$data->kategori) === 'Pecah Belah' ? 'selected' : '' }}>Pecah Belah</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                        name="harga" id="harga" aria-describedby="hargaHelp"
                                        placeholder="Enter harga product" value="{{ old('harga',$data->harga) }}" required>
                                    @error('harga')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10">{{ old('deskripsi',$data->deskripsi) }}</textarea>
                                  
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        name="gambar" id="gambar" aria-describedby="gambarHelp"
                                        placeholder="Enter nama product">
                                        <img src="{{ asset('storage/'.$data->gambar) }}" alt="" srcset="">
                                    @error('gambar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Publish</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror"
                                        id="status">
                                        <option value="Publish" {{ old('status',$data->status) === 'Publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="Unpublish" {{ old('status',$data->status) === 'Unpublish' ? 'selected' : '' }}>Unpublish</option>
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
    CKEDITOR.replace('deskripsi');
</script>
@endpush
