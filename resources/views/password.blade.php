@extends('layout-cms.home')
@section('title_page','Change Password')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('change.password') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="current_password">Old Password</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autofocus>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">New Password Confirmation</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Update</button>
        </div>
    </form>

@endsection
