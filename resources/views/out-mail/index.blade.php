@extends('layouts.home')
@section('title_page','Data Surat Keluar')
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
            <a href="{{ route('surat-keluar.create') }}" class="btn btn-primary">Tambah Surat Keluar</a><br><br>
        </div>
        <div class="col-md-4 mb-3">
            <form action="#" class="flex-sm">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                        <button onclick="window.location.href='{{ route('surat-keluar.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
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
                    <th>No. Surat</th>
                    <th>Tgl. Surat</th>
                    <th>Keterangan</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Tgl. Catat</th>
                    <th>File</th>
                    <th width="13%">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $outmail => $result)
                    <tr>
                        <td>{{ $outmail + $data->firstitem() }}</td>
                        <td>{{ $result->mail_number }}</td>
                        <td>{{ $result->mail_date }}</td>
                        <td>{{ $result->note }}</td>
                        <td>{{ $result->sender }}</td>
                        <td>{{ $result->recipient }}</td>
                        <td>{{ $result->record_date }}</td>
                        <td>
                            @if ($result->file_out == null)
                                <small class="text-warning">No File</small>
                            @else
                                <a href="javascript:void(0)" class="text-info" id="file-out" onclick="viewFile('{{ $result->file_out }}')" data-toggle="modal" data-target="#modalFileOut">{{ $result->file_out }}</a>
                            @endif
                        </td>
                        <td align="center">
                            <a href="{{ route('surat-keluar.edit', $result->id) }}" type="button" class="btn btn-sm btn-info"><i class="fas fa-pen"></i></a>
                            @if (Auth::user()->role == 'Administrator')
                                <a href="javascript:void(0)" id="btn-delete" class="btn btn-sm btn-danger" onclick="deleteData('{{ $result->id }}')" data-toggle="modal" data-target="#deleteSuratModal"><i class="fas fa-trash"></i></a>
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
        <span class="ml-3">Data Keseluruhan: <span class="text-primary font-weight-bold">{{ DB::table('out_mails')->count() }}</span> Surat Keluar tercatat.</span>
    </div>
    <div class="mt-3 float-right">
        {{ $data->links() }}
    </div>

@endsection

@section('modal')
    <!-- Modal Delete -->
    <div class="modal fade" id="deleteSuratModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="javascript:void(0)" id="deleteForm" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Hapus Surat Keluar</h4>
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

    <!-- Modal File In -->
    <div class="modal fade" id="modalFileOut" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="max-width: max-content; width: 690px; height: 610px">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Tampil File Surat Keluar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <embed src="" id="embed-file" width="600" height="500" alt="pdf" />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function viewFile(data) {
            let url = window.location.origin+'/storage/out-mail/'+data;
            $('#embed-file').attr('src', url);
        }

        function deleteData(id) {
            let url = '{{ route("surat-keluar.destroy", ":id") }}';
            url     = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
