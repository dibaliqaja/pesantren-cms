@extends('layouts.home')
@section('title_page','Edit Data Surat Keluar')
@section('content')

    <form action="{{ route('surat-keluar.update', $outmail->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="mail_number">No. Surat</label>
                        <input type="text" class="form-control @error('mail_number') is-invalid @enderror" name="mail_number" value="{{ old('mail_number', $outmail->mail_number) }}">
            
                        @error('mail_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="mail_date">Tgl. Surat</label>
                        <input type="date" class="form-control @error('mail_date') is-invalid @enderror" name="mail_date" value="{{ old('mail_date', $outmail->mail_date) }}">
            
                        @error('mail_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="record_date">Tgl. Catat</label>
                        <input type="date" class="form-control @error('record_date') is-invalid @enderror" name="record_date" value="{{ old('record_date', $outmail->record_date) }}">
            
                        @error('record_date')
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
                        <label for="sender">Pengirim</label>
                        <input type="text" class="form-control @error('sender') is-invalid @enderror" name="sender" value="{{ old('sender', $outmail->sender) }}">
            
                        @error('sender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="recipient">Penerima</label>
                        <input type="text" class="form-control @error('recipient') is-invalid @enderror" name="recipient" value="{{ old('recipient', $outmail->recipient) }}">
            
                        @error('recipient')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="note">Keterangan</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" name="note">{{ old('note', $outmail->note) }}</textarea>
            
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
                        <label for="file_out">File</label>
                        <input type="file" class="form-control-file @error('file_out') is-invalid @enderror" name="file_out" value="{{ old('file_out') }}">
                        <span class="text-small text-danger font-italic">File extension only: jpg, jpeg, png, doc, docx, pdf</span>
            
                        @error('file_out')
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
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
