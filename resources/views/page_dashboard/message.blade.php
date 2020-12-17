@extends('layout_dashboard')
@section('title', $title ?? '')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper">
        <div class="sidebar-left">
            <div class="sidebar">
                <!-- Chat Sidebar area -->
                <div class="sidebar-content card">
                    <span class="sidebar-close-icon">
                        <i class="feather icon-x"></i>
                    </span>
                    <div class="chat-fixed-search">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-profile-toggle position-relative d-inline-flex">
                                <div class="avatar">
                                    <img src="{{ asset('/') }}images/portrait/small/avatar-s-11.jpg" alt="user_avatar" height="40" width="40">
                                    <span class="avatar-status-online"></span>
                                </div>
                                <div class="bullet-success bullet-sm position-absolute"></div>
                            </div>
                            <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
                                <input type="text" class="form-control round" id="chat-search" placeholder="Cari Pesan Nasabah">
                                <div class="form-control-position">
                                    <i class="feather icon-search"></i>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div id="users-list" class="chat-user-list list-group position-relative">
                        <h3 class="primary p-1 mb-0">Pesan</h3>
                        <ul class="chat-users-list-wrapper media-list" id="record">
                        </ul>
                    </div>
                </div>
                <!--/ Chat Sidebar area -->

            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="chat-overlay"></div>
                    <section class="chat-app-window">
                        <div class="start-chat-area">
                            <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                            <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                        </div>
                        <div class="active-chat d-none">
                            <div class="chat_navbar">
                                <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                    <div class="vs-con-items d-flex align-items-center">
                                        <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                        <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                            <img src="{{ asset("") }}images/portrait/small/avatar-s-1.jpg" alt="" height="40" width="40" />
                                            <span class="avatar-status-busy"></span>
                                        </div>
                                        <h6 class="mb-0" id="customerNameMessage"></h6>
                                    </div>
                                    <span class="favorite"><i class="feather icon-star font-medium-5"></i></span>
                                </header>
                            </div>
                            <div class="user-chats">
                                <div class="chats this-is-message" id="messageContent">
                                    {{-- <div class="chat chat-left">
                                        <div class="chat-body">
                                            <div class="chat-content">
                                                <p>Hey John, I am looking for the best admin template.</p>
                                                <p>Could you please help me to find it out?</p>
                                            </div>
                                            <div class="chat-content">
                                                <p>It should be Bootstrap 4 compatible.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="chat-app-form">
                                <form id="form_send_message" class="chat-app-input d-flex">
                                    <input id="customerId" type="hidden" name="customer_id">
                                    <input type="text" name="message" class="form-control" placeholder="Tulis pesan di sini">
                                    <button id="buttonSubmit" type="submit" class="btn btn-primary send"><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">Kirim</span></button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CRUD -->
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
        });

        loadData();
        function loadData() {
            $.ajax({
                type  : 'GET',
                url   : "{{ route('message.data')}}",
                success : function(row){
                    var html = '';
                    var i;
                    for(i=0; i<row.data.length; i++){
                        var avatar = "{{ asset("/") }}images/portrait/small/avatar-s-3.jpg";
                        html += '<li class="message-list" data-id="'+row.data[i].customer_id+'">'+
                                '<div class="pr-1">'+
                                    '<span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="'+avatar+'" height="42" width="42" alt=" ">'+
                                        '<i></i>'+
                                    '</span>'+
                                '</div>'+
                                '<div class="user-chat-info">'+
                                    '<div class="contact-info">'+
                                        '<h5 class="font-weight-bold mb-0">'+row.data[i].customer_name+'</h5>'+
                                        '<p class="truncate">'+row.data[i].message+'</p>'+
                                    '</div>'+
                                    '<div class="contact-meta">'+
                                        '<span class="float-right mb-25">'+row.data[i].created_at+'</span>'+
                                    '</div>'+
                                '</div>'+
                            '</li>';
                    }
                    $('#record').html(html);
                }
            });
        }

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

        // click list chat active
        $(document).on('click',"ul.chat-users-list-wrapper li",function(){
            if($('ul.chat-users-list-wrapper li').hasClass('active')){
                $('ul.chat-users-list-wrapper li').removeClass('active');
            }
            $(this).addClass('active');

            if($('ul.chat-users-list-wrapper li').hasClass('active')){
                $('.start-chat-area').addClass('d-none');
                $('.active-chat').removeClass('d-none');
            }
            else{
                $('.start-chat-area').removeClass('d-none');
                $('.active-chat').addClass('d-none');
            }
            // autoscroll to bottom of Chat area
            $('.user-chats').animate({
                scrollTop: $('.user-chats').get(0).scrollHeight
            }, 1500);
        });

        // message detail
        loadDetail();
        function loadDetail() {
            var valueCustomerId = $('#customerId').val()
            $.ajax({
                url: "{{ route('message.detail') }}",
                type: "POST",
                data: {
                    customer_id: valueCustomerId
                },
                success: function(row) {
                    //$('#datatable').DataTable().ajax.reload();
                    $('#customerId').val(row.data.customer_id);
                    $('#customerNameMessage').text(row.data.customer_name);
                    var html = '';
                    var j;
                    for(j=0; j<row.data.content.length; j++){
                        var ownMessage = '';
                        if(row.data.content[j].sender == "customer"){
                            ownMessage = "chat-left";
                        }
                        html += '<div class="chat '+ownMessage+'">'+
                                    '<div class="chat-body">'+
                                        '<div class="chat-content">'+
                                            '<p>'+row.data.content[j].message+'</p>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';

                    }
                    $('#messageContent').html(html);
                }
            });
        }

        // list click
        $('#record').on('click', '.message-list','#buttonSubmit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('message.detail') }}",
                type: "POST",
                data: {
                    customer_id: id
                },
                success: function(row) {
                    //$('#datatable').DataTable().ajax.reload();
                    $('#customerId').val(row.data.customer_id);
                    $('#customerNameMessage').text(row.data.customer_name);
                    loadDetail();
                    // var html = '';
                    // var j;
                    // for(j=0; j<row.data.content.length; j++){
                    //     var ownMessage = '';
                    //     if(row.data.content[j].sender == "customer"){
                    //         ownMessage = "chat-left";
                    //     }
                    //     html += '<div class="chat '+ownMessage+'">'+
                    //                 '<div class="chat-body">'+
                    //                     '<div class="chat-content">'+
                    //                         '<p>'+row.data.content[j].message+'</p>'+
                    //                     '</div>'+
                    //                 '</div>'+
                    //             '</div>';

                    // }
                    // $('#messageContent').html(html);
                }
            });
        });

        $('#form_send_message').off('submit');
        $('#form_send_message').on('submit', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('message.store') }}",
                data: new FormData($('#form_send_message')[0]),
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    $("#form_send_message")[0].reset();
                    loadDetail();
                }
            })
            return false;
        });

    });
</script>
@endsection
