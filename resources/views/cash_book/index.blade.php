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
            <a href="javascript:void(0)" id="new-cash-debit" class="btn btn-info mr-3">Tambah Debit</a>
            <a href="javascript:void(0)" id="new-cash-credit" class="btn btn-warning">Tambah Kredit</a><br><br>
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
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

@endsection

@section('modal')
<!-- Modal Cash -->
<div class="modal fade" id="ajaxModel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cashForm" name="cashForm" class="form-horizontal">
                   <input type="hidden" name="cash_id" id="cash_id">
                    <div class="form-group">
                        <label for="date" class="col-sm-2 control-label">Tanggal</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="date" name="date" placeholder="Enter date" required>
                            <span id="dateError" class="alert-message text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="note" name="note" placeholder="Enter note" required></textarea>
                            <span id="noteError" class="alert-message text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group" id="debit-form">
                        <label for="debit" class="col-sm-2 control-label">Debit</label>
                        <div class="col-sm-12">
                            <input type="number" min="0" class="form-control" id="debit" name="debit" placeholder="Enter debit">
                            <span id="debitError" class="alert-message text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group" id="credit-form">
                        <label for="credit" class="col-sm-2 control-label">Kredit</label>
                        <div class="col-sm-12">
                            <input type="number" min="0" class="form-control" id="credit" name="credit" placeholder="Enter credit">
                            <span id="creditError" class="alert-message text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group ml-3">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
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

            let table = $('#cash-table').DataTable({
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
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#new-cash-debit').click(function () {
                $('#saveBtn').val("new-cash");
                $('#cash_id').val('');
                $('#cashForm').trigger("reset");
                $('#modelHeading').html("Tambah Debit");
                $('#dateError').text('');
                $('#noteError').text('');
                $('#debitError').text('');
                $('#debit-form').show();
                $('#credit-form').hide();
                $('#ajaxModel').modal('show');
            });

            $('#new-cash-credit').click(function () {
                $('#saveBtn').val("new-cash");
                $('#cash_id').val('');
                $('#cashForm').trigger("reset");
                $('#modelHeading').html("Tambah Kredit");
                $('#dateError').text('');
                $('#noteError').text('');
                $('#creditError').text('');
                $('#debit-form').hide();
                $('#credit-form').show();
                $('#ajaxModel').modal('show');
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#cashForm').serialize(),
                    url: "{{ route('buku-kas.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#cashForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#dateError').text(data.responseJSON.errors.date);
                        $('#noteError').text(data.responseJSON.errors.note);
                        $('#debitError').text(data.responseJSON.errors.debit);
                        $('#creditError').text(data.responseJSON.errors.credit);
                    }
                });
            });

            $('body').on('click', '.deleteCash', function () {
                var cash_id = $(this).data("id");
                let _url = `/buku-kas/${cash_id}`;
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                        type: "DELETE",
                        url: _url,
                        success: function (data) {
                            table.draw();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });
    </script>
@endsection
