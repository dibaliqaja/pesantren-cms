@extends('layout-cms.home')
@section('title_page','Syahriah Santri (SPP)')
@section('content')

    @if (Session::has('alert'))
        <div class="alert alert-light alert-dismissible fade show" role="alert">
            {{ Session('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">            
            <form action="#" class="flex-sm">
                <div class="input-group">
                    <select class="form-control select2" name="year" id="year">
                        @for ($year = (int) date('Y'); 1900 <= $year; $year--)
                            <option value="{{ $year }}" @if ($year == $now) selected @endif>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>   
                </div>
                <br>   
        </div>
        <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                        <button onclick="window.location.href='{{ route('syahriah.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th><a href="#"><i class="fas fa-chevron-left"></i></a></th>
                    <th colspan="12">{{ $now }}</th>
                    <th><a href="#"><i class="fas fa-chevron-right"></i></a></th>
                </tr>
                <tr align="center">
                    <th width="5%">No</th>
                    <th class="w-25">Nama Santri</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $syahriah => $result)
                    <tr align="center">
                        <td>{{ $syahriah + 1 }}</td>
                        <td><a href="{{ route('santri.show', $result->id) }}" target="blank">{{ $result->name }}</a></td>
                        {{-- <td>{{ $result->name }} </td> --}}
                        <td>
                            <input type="checkbox" name="month" id="month-jan" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-feb" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-mar" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-apr" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-may" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-jun" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-jul" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-aug" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-sep" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-oct" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-nov" data-id="{{ $result->id }}">
                        </td>
                        <td>
                            <input type="checkbox" name="month" id="month-dec" data-id="{{ $result->id }}">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

@section('modal')
    <!-- Modal Delete -->
    <div class="modal fade" id="deleteKasModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="javascript:void(0)" id="deleteForm" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" onclick="formSubmit()" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteData(id) {
            let url = '{{ route("buku-kas.destroy", ":id") }}';
            url     = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
