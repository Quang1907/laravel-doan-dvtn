@extends('layouts.admin_master')
@section("title", "Trang quản lý nhiệm vụ")

@section( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.css" integrity="sha512-U4eJImzWCUkxYrmi9Skaj6ksVj+JBsLR2CEam6IJEVyKtHUAxOIRSoqgB0xkqKrduL8LTuWEdX8B+zDFPbQHmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <main>
        <div class="container">
            <div id="calendar" class="mt-5"></div>
        </div>

        <!-- Modal Body -->
        <div class="modal fade" id="bookingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Thêm sự kiện</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="title">Tên hoạt động</label>
                            <input type="text" id="title" class="form-control" />
                            <span id="titleError" class="text-danger"></span>
                        </div>
                        <div class="mb-2">
                            <label for="title">Nội dung hoạt động</label>
                            <textarea type="text" id="content" name="content" class="form-control"></textarea>
                            <span id="contentError" class="text-danger"></span>
                        </div>
                        <div class="mb-2">
                            <label for="title">Ngày bắt đầu</label>
                            <input type="time" id="timeStart" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="title">Ngày kết thúc</label>
                            <input type="time" id="timeEnd" class="form-control">
                        </div>
                        <div>
                            <label for="" class="form-label w-full">Category name</label>
                            <select class="form-control category w-full" id="user_id" multiple="multiple">
                                <option value="0">Tất cả tổ dân phố</option>
                                @foreach ( $users as $user )
                                    <option @if ( in_array( $user->id, old( "user_id" , [] ) ) ) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <span id="userError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary  bg-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveBtn" class="btn btn-sm btn-primary bg-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Thông tin hoạt động</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="show-content">
                        Body
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnClose" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="btnDelete" >Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('script')

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale/vi.js" integrity="sha512-PUhgWdMNC44LhASLJxwlCgGrNz3zXIxSk76m2oA/W+dOZ9TKBHVTAc1+7+8qgJjAiVzJ9B2fZ5gvW9zhWsP8VA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $( document ).ready( function () {
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('content', options);

        $('.category').select2();
        $(".select2-container").css("width", "750px");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var bookings = @json( $events );

        var calendar = $( "#calendar" ).fullCalendar( {
            editable    : true,

            header  : {
                left    : 'prev,next today',
                center  : 'title',
                right   : 'month,agendaWeek,agendaDay'
            },
            // defaultView : "agendaWeek",

            events      : bookings,
            selectable  : true,
            selectHelper: true,

            select      : function ( start_date, end_date, allDays ) {

                $("#bookingModal").modal( "toggle" );

                $("#saveBtn").click( function () {
                    var title   = $( "#title" ).val();
                    var user_id = $('#user_id').select2("val");
                    var content = CKEDITOR.instances['content'].getData();

                    var date    = $.fullCalendar.formatDate( start_date, "Y-MM-DD" );
                    if ( $( "#timeStart").val() && $( "#timeEnd").val()) {
                        var start   = date + " " + $( "#timeStart").val();
                        var end     = date + " " + $( "#timeEnd").val();
                    }else{
                        var start   =  moment( start_date ).format( "Y-MM-DD HH:mm:ss" );
                        var end     =  moment( end_date ).format( "Y-MM-DD HH:mm:ss" );
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route( 'calendar.store' ) }}",
                        dataType: 'json',
                        data: { title, start, content, end, user_id },
                        success : function ( response ) {
                            console.log(response.content);
                            Swal.fire( "Event created successfully!", response , "success");
                            $( '#calendar' ).fullCalendar('renderEvent', {
                                'id' : response.id,
                                'title' : response.title,
                                'content' : response.content,
                                'start' : response.start,
                                'end'   : response.end,
                                'color'   : response.color,
                            });
                            reset();
                        },
                        error   : function ( error ) {
                            var message = error.responseJSON.errors;
                            if ( message ) {
                                $( "#titleError" ).html( message.title );
                                $( "#userError" ).html( message.user_id );
                                $( "#contentError" ).html( message.content );
                            }
                        }
                    });
                } );
            },

            eventDrop: function ( event ) {
                var id = event.id;
                var start   =  moment( event.start ).format( "Y-MM-DD HH:mm:ss" );
                var end     =  moment( event.end ).format( "Y-MM-DD HH:mm:ss" );

                $.ajax({
                    type: "PATCH",
                    url: "{{ route( 'calendar.update', '' ) }}" + '/' + id,
                    dataType:'json',
                    data: {  start, end },
                    success : function ( response ) {
                        Swal.fire("Good job!", response , "success");
                    },
                    error   : function ( error ) {
                        var message = error.responseJSON;
                        if ( message ) {
                            Swal.fire("Error!", message , "error");
                        }
                    }
                });
            },

            eventClick: function ( event ) {
                var html = '<h3 class="p-0 m-0">Tên hoạt động: '+ event.title +'</h3>'+
                    '<h3 class="p-0 m-0">Thoi gian bat dau: '+  $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss") +'</h3>'+
                    '<h3 class="p-0 m-0">Thoi gian ket thuc: '+  $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss") +'</h3>'+
                    event.content;
                $("#show-content").html( html );

                $("#modalId").toggle();
                $("#btnDelete").click( function () {
                    var id = event.id;
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-sm btn-success',
                            cancelButton: 'btn btn-sm btn-danger bg-danger mx-2'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: "{{ route( 'calendar.destroy', '' ) }}" + '/' + id,
                                dataType:'json',
                                success : function ( response ) {
                                    $('#calendar').fullCalendar('removeEvents', response);
                                    $("#modalId").toggle();
                                },
                                error   : function ( error ) {
                                    var message = error.responseJSON;
                                    if ( message ) {
                                        Swal.fire("Error!", message , "error");
                                    }
                                }
                            });
                            swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                        } else if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                            )
                        }
                    })
                });
            },

            eventResize:function( event )  {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;

                $.ajax({
                    url     : "{{ route( 'calendar.update', '' ) }}" + '/' + id,
                    type    : "PATCH",
                    data    : { title:title, start:start, end:end, id:id},
                    success : function ( response ) {
                        Swal.fire("Good job!", response , "success");
                    },
                    error   : function ( error ) {
                        var message = error.responseJSON;
                        if ( message ) {
                            Swal.fire("Error!", message , "error");
                        }
                    }
                })
            },

            selectAllow: function ( event ) {
                return moment( event.start ).utcOffset( false ).isSame( moment( event.end ).subtract(1, "second" ).utcOffset(false), "day" );
            }
        } );

        $("#bookingModal").on("hidden.bs.modal", function () {
            $('#saveBtn').unbind();
        });

        $("#btnClose").click( function ( ) {
            $("#modalId").toggle();
        } );

        $( ".fc-event" ).css( "font-size", "15px");
        $(".fc-widget-header").css({
            "background": "blue",
            "color": "white"
        })
    } );

    function reset() {
        $( "#title" ).val("")
        $( "#titleError" ).html( "" );
        $("#bookingModal").modal( "hide" );
        $('#user_id').val(null).trigger('change');
        $( "#timeStart").val("");
        $( "#timeEnd").val("");
        CKEDITOR.instances['content'].setData("");
    }
</script>
@endsection
