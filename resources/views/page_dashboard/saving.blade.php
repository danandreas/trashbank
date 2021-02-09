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
                                        <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-target="#modal_form_input">+ {{ $title }} </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table nowrap table-striped table-bordered complex-headers">
                                            <thead>
                                                <tr>
                                                    <th width="20px">No</th>
                                                    <th width="40px">Tanggal</th>
                                                    <th width="40px">No. Akun</th>
                                                    <th>Nasabah</th>
                                                    <th>Jenis Sampah</th>
                                                    <th>Detail Sampah</th>
                                                    <th width="30px">Berat</th>
                                                    <th>Harga Beli/kg</th>
                                                    <th>Harga Jual/kg</th>
                                                    <th>Harga Total Bank</th>
                                                    <th>Harga Total Nasabah</th>
                                                    <th>Laba</th>
                                                    <th>Metode Pembayaran</th>
                                                    <th>Keterangan</th>
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
<div class="modal fade" id="modal_form_input" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h4 class="modal-title">Input  {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_input" enctype="multipart/form-data" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nasabah*</label>
                        <div class="controls">
                            <div class="form-group">
                                <select id="" name="customer_id" class="select2 form-control" style="width:100%" required>
                                    <option value="">Pilih Nasabah</option>
                                    @foreach ($customer as $c)
                                        <option value="{{ $c->id }}">{{ $c->account_number.' - '.$c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Sampah*</label>
                        <div class="controls">
                            <div class="form-group">
                                <select id="trash_id" name="trash_id" class="select2 form-control" style="width:100%" required>
                                    <option value="">Pilih Jenis Sampah</option>
                                    @foreach ($trash as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="div_trash_detail">
                        <label>Detail Jenis Sampah</label>
                        <div class="controls">
                            <input id="trash_detail" name="trash_detail" type="text" class="form-control" autocomplete="off" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Berat (Kg)*</label>
                        <div class="controls">
                            <input id="weight" name="weight" type="text" class="form-control" autocomplete="off" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <div class="controls">
                            <div class="form-group">
                                <select id="payment_method" name="payment_method" class="select2 form-control" style="width:100%" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="1">{{ myPaymentMethod(1) }}</option>
                                    <option value="2">{{ myPaymentMethod(2) }}</option>
                                    <option value="3">{{ myPaymentMethod(3) }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label>Harga Beli/Kg*</label>
                        <div class="controls">
                            <input id="buying_price" name="buying_price" type="text" class="form-control" autocomplete="off" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga Jual/Kg*</label>
                        <div class="controls">
                            <input id="selling_price" name="selling_price" type="text" class="form-control" autocomplete="off" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table mb-2">
                            <tbody>
                                <tr class="table-info">
                                    <td>Total Harga untuk Bank</td>
                                    <td class="text-right"><p id="bank_total_price"></p></td>
                                </tr>
                                <tr class="table-warning">
                                    <td>Total Harga untuk Nasabah</td>
                                    <td class="text-right"><p id="customer_total_price"></p></td>
                                </tr>
                                <tr class="table-success">
                                    <td>Laba</td>
                                    <td class="text-right"><p id="profit"></p></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>    
                    <div class="form-group">
                        <label>Keterangan</label>
                        <div class="controls">
                            <textarea name="description" class="form-control"></textarea>
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

<script>
    /* Price Calculation */
    $(document).on("change keyup blur", "#weight,#buying_price,#selling_price", function() {
        var weight = $('#weight').val();
        var buying_price = $('#buying_price').val();
        var selling_price = $('#selling_price').val();
        
        var bank_total_price = weight * buying_price;
        var customer_total_price = weight * selling_price;
        var profit = customer_total_price - bank_total_price;

        $('#bank_total_price').text(bank_total_price);
        $('#customer_total_price').text(customer_total_price);
        $('#profit').text(profit);
    });
    /* Payment Method on Change */
    $('#payment_method').change(function() {
            if (this.value == 3){ // 3 = Barter
                $("#selling_price").val(0);
            }
        });
</script>

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
                        <label>Nasabah*</label>
                        <div class="controls">
                            <div class="form-group">
                                <select id="edit_customer_id" name="customer_id" class="select2 form-control" style="width:100%" required>
                                    <option value="">Pilih Nasabah</option>
                                    @foreach ($customer as $c)
                                        <option value="{{ $c->id }}">{{ $c->account_number.' - '.$c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Sampah*</label>
                        <div class="controls">
                            <div class="form-group">
                                <select id="edit_trash_id" name="trash_id" class="select2 form-control" style="width:100%" required>
                                    <option value="">Pilih Jenis Sampah</option>
                                    @foreach ($trash as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="div_edit_trash_detail">
                        <label>Detail Jenis Sampah</label>
                        <div class="controls">
                            <input id="edit_trash_detail" name="trash_detail" type="text" class="form-control" autocomplete="off" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Berat*</label>
                        <div class="controls">
                            <input id="edit_weight" name="weight" type="text" class="form-control" autocomplete="off" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <div class="controls">
                            <textarea id="edit_description" name="description" class="form-control"></textarea>
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

<script>
    // Show - Hide
    $(document).ready(function() {
        // Input
        document.getElementById('div_trash_detail').style.display = 'none';
        $("#trash_detail").attr("disabled", true);
        $('#trash_id').change(function() {
            if (this.value == 0){
                document.getElementById('div_trash_detail').style.display = 'block';
                $("#trash_detail").attr("disabled", false);
            } else {
                document.getElementById('div_trash_detail').style.display = 'none';
                $("#trash_detail").attr("disabled", true);
            }
        });
        // Edit
        $('#edit_trash_id').change(function() {
            if (this.value == 0){
                document.getElementById('div_edit_trash_detail').style.display = 'block';
                $("#edit_trash_detail").attr("disabled", false);
            } else {
                document.getElementById('div_edit_trash_detail').style.display = 'none';
                $("#edit_trash_detail").attr("disabled", true);
            }
        });
    });
</script>

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
                url: '{{ route("saving.data") }}',
                dataSrc: 'data'
            },
            columns: [
                { data: null,'sortable': true,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'created_at' },
                { data: 'account_number' },
                { data: 'customer_name' },
                { data: 'trash_name' },
                { data: 'trash_detail' },
                { data: null, 'sortable': true,
                    render: function ( data, type, row ) {
                        return '<b> '+data.weight+' </b>';
                    }
                },
                { data: 'buying_price', render: $.fn.dataTable.render.number('.', ',', 0, '') },
                { data: 'selling_price', render: $.fn.dataTable.render.number('.', ',', 0, '') },
                { data: 'bank_total_price', render: $.fn.dataTable.render.number('.', ',', 0, '') },
                { data: 'customer_total_price', render: $.fn.dataTable.render.number('.', ',', 0, '') },
                { data: 'profit', render: $.fn.dataTable.render.number('.', ',', 0, '') },
                { data: 'payment_method' },
                { data: 'description' },
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
                url: "{{ route('saving.store') }}",
                data: new FormData($('#form_input')[0]),
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(row) {
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
                url: "{{ route('saving.edit') }}",
                data: {
                    id: id
                },
                success: function(row) {
                    $('#modal_form_edit').modal('show');
                    $('#edit_id').val(row.data.id);
                    $('#edit_customer_id').val(row.data.customer_id).prop('selected', true).trigger('change');
                    $('#edit_trash_id').val(row.data.trash_id).prop('selected', true).trigger('change');
                    $('#edit_trash_detail').val(row.data.trash_detail);
                    $('#edit_weight').val(row.data.weight);
                    $('#edit_description').val(row.data.description);

                    /* -------- Start Show-Hide -------- */
                    if (row.data.trash_id == 0){
                        document.getElementById('div_edit_trash_detail').style.display = 'block';
                        $("#edit_trash_detail").attr("disabled", false);
                    } else {
                        document.getElementById('div_edit_trash_detail').style.display = 'none';
                        $("#edit_trash_detail").attr("disabled", true);
                    }
                    /* -------- End Show-Hide -------- */

                    $('#form_edit').off('submit');
                    $('#form_edit').on('submit', function() {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('saving.update') }}",
                            data: new FormData($('#form_edit')[0]),
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function(row) {
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
                        url: "{{ route('saving.delete') }}",
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
