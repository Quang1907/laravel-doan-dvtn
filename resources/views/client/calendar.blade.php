@extends( "layouts.client_master" )
@section( "title", "Lich trinh" )

@section( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.css" integrity="sha512-U4eJImzWCUkxYrmi9Skaj6ksVj+JBsLR2CEam6IJEVyKtHUAxOIRSoqgB0xkqKrduL8LTuWEdX8B+zDFPbQHmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section( "content" )
    <div class="container mx-auto">
        <div id="calendar" class="my-5"></div>

        <!-- Large Modal -->
        <div id="large-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center" aria-hidden="true">
            <div class="relative p-4 m-auto w-full max-w-4xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg dark:bg-gray-700 mt-24 shadow-lg">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Thông tin hoạt động
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-1" id="show-content">
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button data-modal-toggle="large-modal" id="btnClose" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale/vi.js" integrity="sha512-PUhgWdMNC44LhASLJxwlCgGrNz3zXIxSk76m2oA/W+dOZ9TKBHVTAc1+7+8qgJjAiVzJ9B2fZ5gvW9zhWsP8VA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $( document ).ready( function () {
        $('.category').select2();
        $(".select2-container").css("width", "750px");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var bookings = @json( $events );

        var calendar = $( "#calendar" ).fullCalendar( {
            height: 1330,
            header  : {
                left    : 'prev,next today',
                center  : 'title',
                right   : 'agendaWeek'
            },
            defaultView : "agendaWeek",
            events      : bookings,
            eventClick: function ( event ) {
                var html = '<p class="p-0 m-0">Tên hoạt động: '+ event.title +'</p>'+
                    '<p class="p-0 m-0">Thời gian bắt đầu: '+  $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss") +'</p>'+
                    '<p class="p-0 m-0">Thời gian kết thúc: '+  $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss") +'</p>'+
                    '<h3 class="p-0 m-0">Nội dung hoạt động: </h2> ' + event.content;
                $("#show-content").html( html );
                $("#large-modal").toggle();
            },
        } );

        $("#btnClose").click( function ( ) {
            $("#large-modal").toggle();
        } );

        $( ".fc-event" ).css( "font-size", "15px");
        $(".fc-widget-header").css({
            "background": "blue",
            "color": "white"
        })
    } );
</script>
@endsection

