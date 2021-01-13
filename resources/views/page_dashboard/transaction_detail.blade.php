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
                                <h4 class="card-title">Daftar {{ $title }}</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <p class="card-text"></p>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table nowrap table-striped table-bordered complex-headers">
                                            <thead>
                                                <tr>
                                                    <th width="20px">No</th>
                                                    <th width="60px">Tanggal</th>
                                                    <th>No.Rek</th>
                                                    <th>Nama Nasabah</th>
                                                    <th width="60px">Pendapatan</th>
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
                url: "{{ route('transaction.detail_data', $parameterId) }}",
                dataSrc: "data"
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
                { data: null, 'sortable': true,
                    render: function ( data, type, row ) {
                        return '<b> '+data.income+' </b>';
                    }
                }
            ]
        });
    });
</script>
@endsection
