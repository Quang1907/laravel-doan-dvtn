@extends('layouts.client_master')
@section('title', 'Lich trinh')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.css"
        integrity="sha512-U4eJImzWCUkxYrmi9Skaj6ksVj+JBsLR2CEam6IJEVyKtHUAxOIRSoqgB0xkqKrduL8LTuWEdX8B+zDFPbQHmw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="flex justify-center mt-3">
        <h4 class="max-w-sm text-center font-bold mt-1">Chú thích :</h4>
        <div class="py-3 px-5 mx-2 bg-blue-500 0 rounded"></div><span class="text-blue-500"> Chưa diễn ra</span>
        <div class="py-3 px-5 mx-2  bg-yellow-500 rounded"></div><span class="text-yellow-500"> Đang diễn ra</span>
        <div class="py-3 px-5 mx-2  bg-green-500 rounded"></div><span class="text-green-500"> Có tham gia</span>
        <div class="py-3 px-5 mx-2  bg-red-500 rounded"></div><span class="text-red-500"> Không tham gia</span>
    </div>

    <h1 class="text-3xl uppercase text-center font-bold mt-2">Lịch hoạt động</h1>
    <div class="container mx-auto">
        <div id="calendar" class="my-5"></div>
    </div>

    <!-- Modal toggle -->
    <button id="btnModal"
        class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button" data-modal-toggle="defaultModal">
        Toggle modal
    </button>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Thông tin hoạt động
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-1" id="show-content"></div>
                <!-- Modal footer -->
                <div
                    class="flex items-center p-3 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button data-modal-toggle="defaultModal" type="button"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Close</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale/vi.js"
        integrity="sha512-PUhgWdMNC44LhASLJxwlCgGrNz3zXIxSk76m2oA/W+dOZ9TKBHVTAc1+7+8qgJjAiVzJ9B2fZ5gvW9zhWsP8VA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.category').select2();
            $(".select2-container").css("width", "750px");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var bookings = @json($events);

            var calendar = $("#calendar").fullCalendar({
                height: 1330,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'agendaWeek'
                },
                defaultView: "agendaWeek",
                events: bookings,
                eventClick: function( event ) {

                    $("#btnModal").click();
                    var html = '<p class="p-0 m-0">Điểm danh: ' + checkActive( event ) + '</p>' +
                        '<p class="p-0 m-0">Tên hoạt động: ' + event.title + '</p>' +
                        '<p class="p-0 m-0">Thời gian bắt đầu: ' + $.fullCalendar.formatDate(event
                            .start, "Y-MM-DD HH:mm:ss") + '</p>' +
                        '<p class="p-0 m-0">Thời gian kết thúc: ' + $.fullCalendar.formatDate(event.end,
                            "Y-MM-DD HH:mm:ss") + '</p>' +
                        '<h3 class="p-0 m-0">Nội dung hoạt động: </h2> ' + event.content;
                    $("#show-content").html(html);
                },
            });

            function checkActive( check ) {
                return ( check.active == true ) ? '<span class="text-xs px-3 bg-green-200 text-green-800 rounded-full">Đã tham gia</span>' : '<span class="text-xs px-3 bg-red-200 text-red-800 rounded-full">Chưa tham gia</span>';
            }
        });
    </script>

@endsection
