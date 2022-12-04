@extends('layouts.admin_master')
@section('title', 'Thông tin chi tiết của người dùng')
@section('content')
    <div class="pb-14 pt-4 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="px-4 d-flex justify-content-between item-start space-y-2">
            <div class="mb-2">
                <h1 class="text-3xl uppercase font-bold dark:text-white lg:text-4xl leading-7 lg:leading-9 text-gray-800">
                    Chi tiết đoàn viên
                </h1>
                <p>{{ $user->created_at->format('d-m-Y h:i A') }} </p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-primary mb-0">Back</a>
            </div>
        </div>
        </p>
        <div>
        <div class="m-4">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Start Date</label>
                        <input type="date" name="startDate" value="{{ request()->startDate ?? date( 'Y-m-d' )  }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">End Date</label>
                        <input type="date" name="endDate" value="{{ request()->endDate ?? date( 'Y-m-d' )  }}" class="form-control">
                    </div>
                    <div class="col-md-6 mt-6">
                        <button class="btn btn-primary" >Filter</button>
                    </div>
                </div>
            </form>
        </div>
            <div class="d-flex flex-column px-4 py-6 shadow bg-white rounded space-y-6 mb-2 mx-4">
                <div class="d-flex justify-content-between">
                    <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">User Detail</h3>
                    <h3>Xếp loại: {{ score_rating( $rank ) }} </h3>
                </div>
                <hr>
                <div class="d-flex justify-content-center items-center w-100 flex-column">
                    <div class="d-flex justify-content-between w-100">
                        <p class="h6">User ID</p>
                        <p>{{ $user->id }}</p>
                    </div>
                    <div class="d-flex justify-content-between items-center w-100">
                        <p class="h6">User Name: </p>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between items-center w-100">
                        <p class="h6">Phone Number</p>
                        <p>{{ $user->phonenumber }}</p>
                    </div>
                    <div class="d-flex justify-content-between items-center w-100">
                        <p class="h6">Address</p>
                        <p>{{ $user->address }}</p>
                    </div>
                    <div class="d-flex justify-content-between items-center w-100">
                        <p class="h6">Email</p>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="d-flex justify-content-between items-center w-100">
                        <p class="h6">Birthday</p>
                        <p>{{ $user->birthday }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10 d-flex flex-column shadow bg-white rounded w-100 ">
            <div class="d-flex flex-column justify-content-start items-start w-100">
                <div class="d-flex flex-column justify-content-start items-start  px-4 py-4 w-100">
                    <h3 class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800">
                    Thông tin tham gia hoạt động
                    </h3>
                    <hr>
                    <div class="mt-4 md:mt-6 d-flex justify-content-start items-start w-100">
                        <div class="w-50">
                            <canvas id="events"></canvas>
                        </div>
                        <div class="w-25">
                            <canvas id="absent"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('events');
    var events = JSON.parse( "{!! json_encode( $eventArr ) !!}" );

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [ 'Tổng hoạt động được đề xuất', 'Hoạt động tham gia', 'Hoạt động không tham gia' ],
                datasets: [{
                label: '# Hoạt động',
                data: events,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const absent = document.getElementById('absent');
    var events = JSON.parse( "{!! json_encode( $absentArr ) !!}" );

    new Chart(absent, {
        type: 'pie',
        data: {
            labels: [ 'Xin phép được phê duyệt', 'Xin phép bị từ chối' ],
                datasets: [{
                label: '# Chấp thuận',
                data: events,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
