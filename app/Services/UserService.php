<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserReponsitory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UserService {
    private $userReponsitory = null;

    public function __construct( UserReponsitory $userReponsitory)
    {
        $this->userReponsitory = $userReponsitory;
    }

    public function checkLogin( Request $request ) {
        $email = $request->email;
        $password = hash( "sha256", $request->password);

        $user = $this->userReponsitory->findbyEmail( $email );
        if ( !empty( $user ) && $password == $user['password']  ) {

            if ( $user['is_active'] == false ) {
                return back()->withErrors(['message' => "Tài khoản của bạn chưa được kích hoạt"])->withInput();
            }

            $remember = !empty($request->remember) ?? false;
            Auth::login( $user, $remember );

            $request->session()->regenerate();
            return redirect()->intended('admin/category');
        }

        return back()->withErrors( ['message' => 'Tài khoản không tồn tại hoặc sai mật khẩu'] )->withInput();
    }

    public function allUser() {
        return $this->userReponsitory->all();
    }

    public function createUser( Request $request ) {
        $data = $request->all();
        if ( $data['password'] == $data['confirm_password'] ) {
            $data['password'] = hash( "sha256", $data['password']);
            return $this->userReponsitory->create( $data );
        }
        return false;
    }

    public function updateUser( Request $request, User $user ) {
        return $this->userReponsitory->update( $request->all(), $user );
    }

    public function register( Request $request ) {
        if ( $request->password == $request->confirm_password ) {
            $request['password'] = hash( "sha256", $request->password );
            $request['token'] = strtoupper( Str::random( 5 ) );
            $customer = $this->userReponsitory->create( $request->all() );
            Mail::send( "client.auth.email", compact( "customer" ), function ( $email ) use ( $customer ) {
                $email->subject( "Đoàn viên thanh niên - xác nhận tài khoản" );
                $email->to( $customer->email, $customer->name );
            });
            return $customer;
        }
    }

    public function updatePassword( Request $request ) {
        $old_password = hash( "sha256", $request->old_password );

        if( auth()->user()->password == $old_password ) {
            $data[ 'password' ] = hash( "sha256", $request->password );
            $user = $this->userReponsitory->findbyEmail( auth()->user()->email );
            $this->userReponsitory->update( $data, $user );
            $user = $this->userReponsitory->findbyEmail( auth()->user()->email );
            Auth::login( $user );
            return redirect()->route( "profile" )->with( "message", "Cập nhật mật khẩu thành công");
        }

        return back()->withErrors( "Mật khẩu cũ không đúng." );
    }

    public function updatetInfo( Request $request ){
        $user = $this->userReponsitory->findbyId( auth()->user()->id );
        $this->userReponsitory->update( $request->all(), $user );
        return Alert::toast('Cập nhật thông tin thành công', 'success');
    }

    public function confirmInfo( Request $request, User $user ) {
        $request['password'] = hash( "sha256", $request['password']);
        return $this->userReponsitory->update( $request->all(), $user );
    }

    public function vertifyEmail( Request $request, User $user ) {
        $request->validate( [ "confirm_token" => "required" ] );
        if ( $request->confirm_token == $user->token ) {
            $this->userReponsitory->update( [ "email_verified_at" => now()->toDateTimeString() ] , $user );
            Alert::toast( 'Vui lòng đợi. Tài khoản của bạn sẽ được duyệt sau ít phút.', 'success' );
            return redirect("");
        }

        return view( "client.auth.vertify_email", compact( "user" ))->with("message", "Mã không chính xác");
    }

    public function changeAvata( Request $request, User $user ) {
        $request->validate( [ "avata" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048" ] );
        $image = $request->file("avata");
        $fileName = time() . $image->getClientOriginalName();
        $image->storeAs( "public", $fileName);
        $data['avata'] = $fileName;
        $this->userReponsitory->update( $data, $user );
        return back();
    }
}
