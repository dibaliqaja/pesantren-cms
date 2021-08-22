@extends('layouts.home')
@section('title_page','Syahriah/SPP Santri')
@section('content')

    @if (Session::has('alert'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">    
            <a href="{{ route('syahriah.create') }}" class="btn btn-primary">Bayar Syahriah (SPP)</a><br><br>                      
        </div>
        <div class="col-md-4 mb-3">
            <form action="#" class="flex-sm">
                <div class="input-group">
                    <select class="form-control select2" name="year" id="year">
                        @for ($year = (int) date('Y'); 1900 <= $year; $year--)
                            <option value="{{ $year }}" @if ($year == $now) selected @endif>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                        <button onclick="window.location.href='{{ route('syahriah.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
                    </div>
                </div>
                <br> 
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th colspan="14">{{ $now }}</th>
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
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Jan')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Feb')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Mar')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Apr')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'May')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Jun')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Jul')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Aug')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Sep')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Oct')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Nov')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox" style="display: flex">
                                <input type="checkbox" class="custom-control-input" id="cbx-2" disabled @if (\App\Models\Syahriah::where('santri_id', $result->id)->where('month', 'Dec')->where('year', $now)->exists()) checked @endif>
                                <label class="custom-control-label" for="cbx-2"></label>
                            </div>
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

    <br><br><br>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-8">                
                <h4>Riwayat Pembayaran</h4>
            </div>
            <div class="col-md-4">
                <form action="#" class="flex-sm">
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
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Tanggal Bayar</th>
                        <th width="13%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($syahriahs as $syahriah => $result)
                        <tr>
                            <td>{{ $syahriah + $syahriahs->firstitem() }}</td>
                            <td><a href="{{ route('santri.show',$result->santris->id) }}" target="blank">{{ $result->santris->name }}</a></td>
                            <td>{{ $result->santris->address }}</td>
                            <td>{{ $result->month }}</td>
                            <td>{{ $result->year }}</td>
                            <td>{{ $result->date }}</td>
                            <td align="center">
                                <a href="{{ route('syahriah.print', $result->id) }}" type="button" class="btn btn-sm btn-warning"><i class="fas fa-print"></i></a>
                                @if (auth()->user()->role == 'Administrator')      
                                    <a href="javascript:void(0)" id="btn-delete" class="btn btn-sm btn-danger" onclick="deleteData('{{ $result->id }}')" data-toggle="modal" data-target="#deleteSyahriahModal"><i class="fas fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2 float-left">
            <span class="ml-3">Data Keseluruhan: <span class="text-primary font-weight-bold">{{ DB::table('syahriahs')->count() }}</span> Pembayaran syahriah telah terdaftar.</span>
        </div>
        <div class="mt-3 float-right">
            {{ $syahriahs->links() }}
        </div>
    </div>

@endsection

@section('modal')
    <!-- Modal Delete -->
    <div class="modal fade" id="deleteSyahriahModal" tabindex="-1" role="dialog">
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
            let url = '{{ route("syahriah.destroy", ":id") }}';
            url     = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
