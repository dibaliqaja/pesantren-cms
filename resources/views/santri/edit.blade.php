@extends('layouts.home')
@section('title_page','Edit Data Santri')
@section('content')

    <form action="{{ route('santri.update', $santri->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="name">Nama Santri</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $santri->name) }}">
            
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="birth_date">Tanggal Lahir Santri</label>
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date', $santri->birth_date) }}">
            
                        @error('birth_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="birth_place">Tempat Lahir Santri</label>
                        <input type="text" class="form-control @error('birth_place') is-invalid @enderror" name="birth_place" value="{{ old('birth_place', $santri->birth_place) }}">
            
                        @error('birth_place')
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
                        <label for="address">Alamat Santri</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address', $santri->address) }}</textarea>
            
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="phone">No. HP Santri</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $santri->phone) }}">
            
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="school_old">Asal Sekolah Santri</label>
                        <input type="text" class="form-control @error('school_old') is-invalid @enderror" name="school_old" value="{{ old('school_old', $santri->school_old) }}">
            
                        @error('school_old')
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
                        <label for="school_address_old">Alamat Asal Sekolah Santri</label>
                        <textarea class="form-control @error('school_address_old') is-invalid @enderror" name="school_address_old">{{ old('school_address_old', $santri->school_address_old) }}</textarea>
            
                        @error('school_address_old')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="school_current">Sekolah Sekarang Santri</label>
                        <input type="text" class="form-control @error('school_current') is-invalid @enderror" name="school_current" value="{{ old('school_current', $santri->school_current) }}">
            
                        @error('school_current')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="school_address_current">Alamat Sekolah Sekarang Santri</label>
                        <textarea class="form-control @error('school_address_current') is-invalid @enderror" name="school_address_current">{{ old('school_address_current', $santri->school_address_current) }}</textarea>
            
                        @error('school_address_current')
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
                        <label for="father_name">Nama Ayah Santri</label>
                        <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{ old('father_name', $santri->father_name) }}">
            
                        @error('father_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="father_job">Pekerjaan Ayah Santri</label>
                        <input type="text" class="form-control @error('father_job') is-invalid @enderror" name="father_job" value="{{ old('father_job', $santri->father_job) }}">
            
                        @error('father_job')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="entry_year">Tahun Masuk</label>
                        <input type="text" class="form-control @error('entry_year') is-invalid @enderror" name="entry_year" value="{{ old('entry_year', $santri->entry_year) }}">
            
                        @error('entry_year')
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
                        <label for="mother_name">Nama Ibu Santri</label>
                        <input type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" value="{{ old('mother_name', $santri->mother_name) }}">
            
                        @error('mother_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="mother_job">Pekerjaan Ibu Santri</label>
                        <input type="text" class="form-control @error('mother_job') is-invalid @enderror" name="mother_job" value="{{ old('mother_job', $santri->mother_job) }}">
            
                        @error('mother_job')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="year_out">Tahun Keluar</label>
                        <input type="text" class="form-control @error('year_out') is-invalid @enderror" name="year_out" value="{{ old('year_out', $santri->year_out) }}">
            
                        @error('year_out')
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
                        <label for="parent_phone">No. HP Orang Tua Santri</label>
                        <input type="tel" class="form-control @error('parent_phone') is-invalid @enderror" name="parent_phone" value="{{ old('parent_phone', $santri->parent_phone) }}">
            
                        @error('parent_phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}">            
                        <span class="text-small text-danger font-italic">File extension only: jpg, jpeg, png | Max Upload Image is 2048 Kb</span>            
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    @if ($santri->photo != null)            
                        <img alt="Profile Image Santri" src="{{ '/storage/photo/' . $santri->photo }}" class="rounded-circle m-2" width="100" onerror="this.src='{{ asset('assets/img/avatar/avatar-1.png') }}'">
                    @else
                        <img alt="Profile Image Santri" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle m-2" width="100">
                    @endif
                </div>
            </div>                         
            <div class="form-group">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('santri.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>





        
        
        
        
        
        
        
        
        
        
        
        
        
  
    </form>

@endsection
