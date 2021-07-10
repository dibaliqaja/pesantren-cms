@extends('layout-cms.home')
@section('title_page','Edit Data Pengguna')
@section('content')

    <form action="{{ route('pengguna.update', $user->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="santri_id">Nama Santri</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('santri_id') is-invalid @enderror" name="santri_id" required>
                    <option selected disabled>Pilih Santri</option>
                    @foreach ($data as $santri)
                        <option value="{{ $santri->id }}"
                            @if ($santri->id == $user->santri_id)
                                selected
                            @endif>{{ $santri->name }}</option>
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
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('role') is-invalid @enderror" name="role" required>
                    <option selected disabled>Pilih Role</option>
                    <option value="Administrator" @if ($user->role == 'Administrator') selected @endif @if (Auth::user()->role == 'Pengurus') disabled @endif>Administrator</option>
                    <option value="Pengurus" @if ($user->role == 'Pengurus') selected @endif @if (Auth::user()->role == 'Administrator') disabled @endif>Pengurus</option>
                    <option value="Santri" @if ($user->role == 'Santri') selected @endif @if (Auth::user() == $user) disabled @endif>Santri</option>
                </select>

                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

@endsection
