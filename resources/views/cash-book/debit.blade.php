@extends('layouts.home')
@section('title_page','Tambah Pemasukan')
@section('content')

    <form action="{{ route('buku-kas.debit.store') }}" method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
            
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="debit">Pemasukan</label>
                        <input type="number" min="1" class="form-control @error('debit') is-invalid @enderror" name="debit" value="{{ old('debit') }}" required>
            
                        @error('debit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="note">Keterangan</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" name="note" required>{{ old('note') }}</textarea>
            
                        @error('note')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <button class="btn btn-primary">Tambah</button>
                        <a href="{{ route('buku-kas.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>          
        </div>                   
    </form>

@endsection
