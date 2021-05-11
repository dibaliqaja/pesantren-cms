@extends('layout-cms.home')
@section('title_page','Tambah Data Pengguna')
@section('content')

    <form action="{{ route('pengguna.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="santri_id">Nama Santri</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('santri_id') is-invalid @enderror" name="santri_id" required>
                    <option selected disabled>Select Santri</option>
                    @foreach ($data as $santri)
                        <option value="{{ $santri->id }}">{{ $santri->name }}</option>
                    @endforeach
                </select>

                @error('santri_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('role') is-invalid @enderror" name="role" required>
                    <option selected disabled>Select Role</option>
                    <option value="Administrator" @if (Auth::user()->role == 'Pengurus') disabled @endif>Administrator</option>
                    <option value="Pengurus">Pengurus</option>
                    <option value="Santri">Santri</option>
                </select>

                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Tambah</button>
            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

@endsection
