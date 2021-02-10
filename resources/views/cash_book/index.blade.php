@extends('layout_cms.home')
@section('title_page','Buku Kas')
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
            <a href="{{ route('buku-kas.create') }}" class="btn btn-primary">Tambah Data</a><br><br>
        </div>
    </div>

    <div class="table-responsive">
        <table id="cash-table" class="table table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th width="5%">No</th>
                    <th>Tanggal</th>
                    <th width="30%">Keterangan</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Total</th>
                    {{-- <th width="13%">Action</th> --}}
                </tr>
            </thead>
            {{-- <tbody>
                @forelse ($data as $cash => $result)
                    <tr>
                        <td>{{ $cash + $data->firstitem() }}</td>
                        <td>{{ $result->date }}</td>
                        <td>{{ $result->note }}</td>
                        <td>
                            @php
                                setlocale(LC_MONETARY, "id_id");
                                echo "Rp " . number_format($result->debit);
                            @endphp
                        </td>
                        <td>
                            @php
                                setlocale(LC_MONETARY, "id_id");
                                echo "Rp " . number_format($result->credit);
                            @endphp
                        </td>
                        <td>
                            @php
                                setlocale(LC_MONETARY, "id_id");
                                echo "Rp " . number_format($result->total);
                            @endphp
                        </td>
                        <td align="center">
                            <a href="{{ route('buku-kas.edit', $result->id) }}" type="button" class="btn btn-sm btn-info"><i class="fas fa-pen"></i></a>
                            <a href="javascript:void(0)" id="btn-delete" class="btn btn-sm btn-danger" data-id={{ $result->id }} onclick="deleteData()" data-toggle="modal" data-target="#deleteSantriModal"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody> --}}
        </table>
    </div>

@endsection

@section('modal')
    <!-- Modal Delete -->
    <div class="modal fade" id="deleteSantriModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="javascript:void(0)" id="deleteForm" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Hapus Santri</h4>
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
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#cash-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('buku-kas.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'date', name: 'date'},
                    {data: 'note', name: 'note'},
                    {data: 'debit', name: 'debit', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp '  )},
                    {data: 'credit', name: 'credit', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp '  )},
                    {data: 'total', name: 'total', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp '  )},
                ]
            });
            // $('#createNewMajor').click(function () {
            //     $('#saveBtn').val("create-major");
            //     $('#major_id').val('');
            //     $('#majorForm').trigger("reset");
            //     $('#modelHeading').html("Create New Major");
            //     $('#titleError').text('');
            //     $('#majorError').text('');
            //     $('#ajaxModel').modal('show');
            // });
            // $('body').on('click', '.editMajor', function () {
            //     var major_id = $(this).data('id');
            //     let _url = `/majors/${major_id}/edit`;
            //     $.get(_url, function (data) {
            //         $('#modelHeading').html("Edit Major");
            //         $('#titleError').text('');
            //         $('#majorError').text('');
            //         $('#saveBtn').val("edit-major");
            //         $('#ajaxModel').modal('show');
            //         $('#major_id').val(data.id);
            //         $('#title').val(data.title);
            //         $('#major').val(data.major);
            //     })
            // });
            // $('#saveBtn').click(function (e) {
            //     e.preventDefault();
            //     $.ajax({
            //         data: $('#majorForm').serialize(),
            //         url: "{{ route('buku-kas.store') }}",
            //         type: "POST",
            //         dataType: 'json',
            //         success: function (data) {
            //             $('#majorForm').trigger("reset");
            //             $('#ajaxModel').modal('hide');
            //             table.draw();
            //         },
            //         error: function (data) {
            //             console.log('Error:', data);
            //             $('#titleError').text(data.responseJSON.errors.title);
            //             $('#majorError').text(data.responseJSON.errors.major);
            //         }
            //     });
            // });
            // $('body').on('click', '.deleteMajor', function () {
            //     var major_id = $(this).data("id");
            //     let _url = `/majors/${major_id}`;
            //     if (confirm("Are You sure want to delete !")) {
            //         $.ajax({
            //             type: "DELETE",
            //             url: _url,
            //             success: function (data) {
            //                 table.draw();
            //             },
            //             error: function (data) {
            //                 if (data.status == 500) {
            //                     alert('Major still used in student');
            //                 }
            //                 console.log('Error:', data);
            //             }
            //         });
            //     }
            // });
        });
    </script>
@endsection
