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
                                <h4 class="card-title">Judul</h4>
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
                                                    <th>Nama</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Bank</th>
                                                    <th width="100px">Pilihan</th>
                                                </tr>
                                            </thead>
                                            <tbody id="record">
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
                <h4 class="modal-title">Input</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_input" enctype="multipart/form-data" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Bank*</label>
                        <div class="controls">
                            <div class="form-group">
                                <select id="bank_id" name="bank_id" class="select2 form-control" style="width:100%" required>
                                    <option value="">Pilih Bank</option>
                                    @foreach ($bank as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                        <label>Email*</label>
                        <div class="controls">
                            <input id="email" name="email" type="text" class="form-control" autocomplete="off" maxlength="225" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password*</label>
                        <div class="controls">
                            <input id="password" name="password" type="password" class="form-control" autocomplete="off" maxlength="20" required>
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
                <h4 class="modal-title">Input</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_edit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input id="edit_id" name="id" type="hidden" novalidate>
                    <div class="form-group">
                        <label>Bank*</label>
                        <div class="controls">
                            <div class="form-group">
                                <select id="edit_bank_id" name="bank_id" class="select2 form-control" style="width:100%" required>
                                    <option value="">Pilih Bank</option>
                                    @foreach ($bank as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama*</label>
                        <div class="">
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
                        <label>Email*</label>
                        <div class="">
                            <input id="edit_email" name="email" type="text" class="form-control" autocomplete="off" maxlength="225" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="">
                            <input name="password" type="password" class="form-control" autocomplete="off" maxlength="20">
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

        $('#datatable').dataTable();

        // read
        loadData();
        function loadData() {
            $.ajax({
                type  : 'GET',
                url   : "{{ url('/employee/data')}}",
                success : function(row){
                    var html = '';
                    var i;
                    for(i=0; i<row.data.length; i++){
                        html += '<tr>'+
                                '<td>'+(i+1)+'</td>'+
                                '<td>'+row.data[i].name+'</td>'+
                                '<td>'+row.data[i].phone+'</td>'+
                                '<td>'+row.data[i].email+'</td>'+
                                '<td>'+row.data[i].bank_name+'</td>'+
                                '<td align="center">'+
                                    '<button type="button" data-id="'+row.data[i].id+'" class="edit-button btn btn-icon btn-icon rounded-circle btn-primary btn-sm mr-1 mb-1 waves-effect waves-light"><i class="feather icon-edit-1"></i></button>'
                                    +
                                    '<button type="button" data-id="'+row.data[i].id+'" class="delete-button btn btn-icon btn-icon rounded-circle btn-danger btn-sm mr-1 mb-1 waves-effect waves-light"><i class="feather icon-trash"></i></button>'
                                +'</td>'+
                                '</tr>';
                    }
                    $('#record').html(html);
                }
            });
        }
        // create
        $('#form_input').on('submit', function() {
            $.ajax({
                type: "POST",
                url: "{{ url('/employee/store')}}",
                data: new FormData($('#form_input')[0]),
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
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
                    loadData();
                }
            })
            return false;
        });
        // edit
        $('#datatable').on('click', '.edit-button', function() {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{ url('/employee/edit') }}",
                data: {
                    id: id
                },
                success: function(row) {
                    //swal.close();
                    $('#modal_form_edit').modal('show');
                    $('#edit_id').val(row.data.id);
                    $('#edit_phone').val(row.data.phone);
                    $('#edit_name').val(row.data.name);
                    $('#edit_email').val(row.data.email);
                    $('#edit_bank_id').val(row.data.bank_id).prop('selected', true).trigger('change');

                    $('#form_edit').off('submit');
                    $('#form_edit').on('submit', function() {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/employee/update') }}",
                            data: new FormData($('#form_edit')[0]),
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function(data) {
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
                                loadData();
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
                        url: "{{ url('/employee/delete') }}",
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function(data) {
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
                            loadData();
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
