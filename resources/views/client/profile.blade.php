@extends( "layouts.client_master" )
@section( "title", "Trang cá nhân" )

@section('css')
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section( "content" )

<div class="bg-gray-100">
    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <div class="w-full md:w-3/12 md:mx-2">
                <div class="bg-white p-3 border-t-4 border-blue-400">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto" src="{{ url_image( auth()->user()->avata ) }}" alt="Avata">
                    </div>
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1 text-center">{{ auth()->user()->name }}</h1>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto"><span
                                    class="bg-blue-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Thành viên kể từ</span>
                            <span class="ml-auto">{{ auth()->user()->created_at->format('d-m-Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-full">
                <!-- Profile tab -->
                <x-errors.any />
                <div class="flex flex-wrap" id="tabs-id">
                    <div class="w-full">
                      <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-blue-600" onclick="changeAtiveTab(event,'tab-profile')">
                            <i class="fas fa-space-shuttle text-base mr-1"></i>  Profile
                          </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-600 bg-white" onclick="changeAtiveTab(event,'tab-settings')">
                            <i class="fas fa-cog text-base mr-1"></i>  Settings
                          </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-600 bg-white" onclick="changeAtiveTab(event,'tab-options')">
                            <i class="fas fa-briefcase text-base mr-1"></i>  Options
                          </a>
                        </li>
                      </ul>
                      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="px-4 py-5 flex-auto">
                          <div class="tab-content tab-space">
                            <div class="block" id="tab-profile">
                                <!-- About Section -->
                                <div class="bg-white p-3  rounded-sm">
                                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                        <span clas="text-green-500">
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide">Thông tin cá nhân</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm">
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Họ và tên</div>
                                                <div class="px-4 py-2">{{ auth()->user()->name }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Ngày sinh</div>
                                                <div class="px-4 py-2">{{ auth()->user()->birthday }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Giới tính</div>
                                                <div class="px-4 py-2">
                                                    @if ( auth()->user()->gender == 0 )
                                                        <span>Nữ <i class="fa-solid fa-user-graduate"></i></span>
                                                    @else
                                                        <span>Nam </span><i class="fa-solid fa-user-tie"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Số điện thoại</div>
                                                <div class="px-4 py-2">{{  auth()->user()->phonenumber }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Địa chỉ</div>
                                                <div class="px-4 py-2">{{  auth()->user()->address }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden" id="tab-settings">
                                <div class="bg-white p-3 rounded-sm">
                                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                        <span clas="text-green-500">
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide">Thay đổi thông tin</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="m-auto max-w-3xl">
                                            <form action="{{ route( 'account.changeinfo' ) }}" method="post" class="mt-5">
                                                @csrf
                                                <x-account.divInput type="text" name="name" label="Họ và tên" value="{{ \Auth::user()->name }}" />
                                                <div class="relative z-0 mb-6 w-full group">
                                                    <label for="" class="text-sm w-full @error("gender") text-red-400 @enderror">Giới tính @error("gender") {{ $message }}@enderror</label>
                                                    <div class="mt-2">
                                                        <input type="radio" name="gender" value="1" id="male"  @if ( old("gender", \Auth::user()->gender ) ) checked @endif>
                                                        <label for="male" class="w-full">Nam</label>
                                                        <input type="radio" name="gender" value="0" id="female"  @if ( old("gender", \Auth::user()->gender ) == 0 ) checked @endif>
                                                        <label for="female" class="w-full">Nữ</label>
                                                    </div>
                                                </div>
                                                <x-account.divInput type="email" name="email" label="Địa chỉ email" value="{{ \Auth::user()->email }}" />
                                                <x-account.divInput type="date" name="birthday" label="Ngày sinh" value="{{ \Auth::user()->birthday }}" />
                                                <x-account.divInput type="tel" name="phonenumber" label="Số điện thoại" value="{{ \Auth::user()->phonenumber }}" />
                                                <button type="submit" class=" mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden" id="tab-options">
                                <div class="bg-white p-3 rounded-sm">
                                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                        <span clas="text-green-500">
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide">Thay đổi thông tin</span>
                                    </div>
                                    <div class="text-gray-700 mt-3">
                                        <div class="m-auto max-w-3xl">
                                            <form action="{{ route( 'account.changePassword' ) }}" method="post">
                                                @csrf
                                                <div class="mb-6">
                                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu mới</label>
                                                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                                                </div>
                                                <div class="mb-6">
                                                    <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nhập lại mật khẩu</label>
                                                    <input type="password" name="confirm_password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                                                </div>
                                                <button type="submit" class=" mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section( "script" )
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        $( "#changeAvata" ).click( function () {
            $( "#inputAvate" ).click();
        });

        $( "#inputAvate" ).change( function () {
            $( "#formChangAvata").submit();
        });
    </script>

    <script type="text/javascript">
        function changeAtiveTab( event, tabID){
          let element = event.target;

          while(element.nodeName !== "A"){
            element = element.parentNode;

          }

          ulElement = element.parentNode.parentNode;
          aElements = ulElement.querySelectorAll("li > a");
          tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");

          for(let i = 0 ; i < aElements.length; i++){
            aElements[i].classList.remove("text-white");
            aElements[i].classList.remove("bg-blue-600");
            aElements[i].classList.add("text-blue-600");
            aElements[i].classList.add("bg-white");
            tabContents[i].classList.add("hidden");
            tabContents[i].classList.remove("block");
          }

          element.classList.remove("text-blue-600");
          element.classList.remove("bg-white");
          element.classList.add("text-white");
          element.classList.add("bg-blue-600");
          document.getElementById(tabID).classList.remove("hidden");
          document.getElementById(tabID).classList.add("block");
        }
      </script>
@endsection
