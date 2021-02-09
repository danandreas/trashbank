@extends('layout_dashboard')
@section('title', $title ?? '')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $title }}</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <p class="card-text"></p>
                                    <div>
                                        <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-target="#modal_form_input">+ {{ $title }}</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table nowrap table-striped table-bordered complex-headers">
                                            <thead>
                                                <tr>
                                                    <th width="20px">No</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Phone</th>
                                                    <th>Alamat</th>
                                                    <th width="100px">Pilihan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->
        </div>
    </div>
</div>

<!-- Modal Input -->
<div class="modal fade text-left" id="modal_form_input" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_input" enctype="multipart/form-data" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode*</label>
                        <div class="controls">
                            <input id="code" name="code" type="text" class="form-control" autocomplete="off" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama*</label>
                        <div class="controls">
                            <input id="name" name="name" type="text" class="form-control" autocomplete="off" maxlength="225" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone*</label>
                        <div class="controls">
                            <input id="phone" name="phone" type="text" class="form-control" autocomplete="off" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat*</label>
                        <div class="controls">
                            <textarea id="address" name="address" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="color: #ea5455">*) Wajib diisi</label>
                    </div><br>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade text-left" id="modal_form_edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_edit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input id="edit_id" name="id" type="hidden" novalidate>
                    <div class="form-group">
                        <label>Kode*</label>
                        <div class="controls">
                            <input id="edit_code" name="code" type="text" class="form-control" autocomplete="off" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama*</label>
                        <div class="controls">
                            <input id="edit_name" name="name" type="text" class="form-control" autocomplete="off" maxlength="225" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone*</label>
                        <div class="controls">
                            <input id="edit_phone" name="phone" type="text" class="form-control" autocomplete="off" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat*</label>
                        <div class="controls">
                            <textarea id="edit_address" name="address" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="color: #ea5455">*) Wajib diisi</label>
                    </div><br>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CRUD -->
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
        });

        // read
        $('#datatable').dataTable({
            processing: true,
            stateSave: true,
            ajax:{
                url: '{{ route("bank.data") }}',
                dataSrc: 'data'
            },
            columns: [
                { data: null,'sortable': true,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'code' },
                { data: 'name' },
                { data: 'phone' },
                { data: 'address' },
                { data: null, 'sortable': false,
                    render: function ( data, type, row ) {
                        return '<button type="button" data-id="'+data.id+'" class="edit-button btn btn-icon btn-icon rounded-circle btn-primary btn-sm mr-1 mb-1 waves-effect waves-light"><i class="feather icon-edit-1"></i></button>'+
                        '<button type="button" data-id="'+data.id+'" class="delete-button btn btn-icon btn-icon rounded-circle btn-danger btn-sm mr-1 mb-1 waves-effect waves-light"><i class="feather icon-trash"></i></button>';
                    }
                }
            ]
        });

        // create
        $('#form_input').on('submit', function() {
            $.ajax({
                type: "POST",
                url: "{{ url('/bank/store')}}",
                data: new FormData($('#form_input')[0]),
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    $('#datatable').DataTable().ajax.reload();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        type: 'success',
                        title: 'Menambahkan {{ strtolower($title) }}'
                    })
                    $('#modal_form_input').modal('hide');
                    $("#form_input")[0].reset();
                }
            })
            return false;
        });
        // edit
        $('#datatable').on('click', '.edit-button', function() {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{ url('/bank/edit') }}",
                data: {
                    id: id
                },
                success: function(row) {
                    //swal.close();
                    $('#modal_form_edit').modal('show');
                    $('#edit_id').val(row.data.id);
                    $('#edit_code').val(row.data.code);
                    $('#edit_name').val(row.data.name);
                    $('#edit_phone').val(row.data.phone);
                    $('#edit_address').val(row.data.address);

                    $('#form_edit').off('submit');
                    $('#form_edit').on('submit', function() {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('bank/update') }}",
                            data: new FormData($('#form_edit')[0]),
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function(data) {
                                $('#datatable').DataTable().ajax.reload();
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    onOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                                Toast.fire({
                                    type: 'success',
                                    title: 'Menyunting {{ strtolower($title) }}'
                                })
                                $('#modal_form_edit').modal('hide');
                                $("#form_edit")[0].reset();
                            }
                        })
                        return false;
                    });
                }
            });
        });
        // delete
        $('#datatable').on('click', '.delete-button', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda yakin menghapus data {{ strtolower($title) }}?",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                confirmButtonColor: '#ff5e5e',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('/bank/delete') }}",
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $('#datatable').DataTable().ajax.reload();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                type: 'success',
                                title: 'Menghapus {{ strtolower($title) }}'
                            })
                        }
                    })
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        type: 'error',
                        title: 'Batal menghapus {{ strtolower($title) }}'
                    })
                }
            })
        });

    });
</script>
@endsection
