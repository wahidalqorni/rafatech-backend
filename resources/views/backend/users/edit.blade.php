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
                        <h4 class="page-title pull-left">Data User</h4>

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
                            <h4 class="header-title">Update User</h4>
                            @if (Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form id="formSubmit" method="POST" action="{{ url('update-user') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" aria-describedby="emailHelp"
                                        placeholder="Enter email" value="{{ $data->email }}" disabled>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" aria-describedby="nameHelp"
                                        placeholder="Enter name" value="{{ old('name', $data->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" aria-describedby="passwordHelp"
                                        placeholder="Enter Password" value="{{ old('password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Role</label>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror"
                                        id="role">
                                        <option value="Admin" {{ old('role', $data->role ) === 'Admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="Kasir" {{ old('role', $data->role) === 'Kasir' ? 'selected' : '' }}>Pengguna</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <button class="btn btn-primary" type="submit" id="btnLogin">Submit</button>
                                <button style="display: none;" id="btnLoginLoading" class="btn btn-primary"
                                    type="button" disabled>
                                    Processing...</button>
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
@endpush
