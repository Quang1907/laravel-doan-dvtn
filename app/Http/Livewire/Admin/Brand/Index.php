<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;

    public $name, $slug, $status, $brand_id;

    public function rules() {
        return [
            "name" => "required|string",
            "slug" => "required|string",
        ];
    }

    protected $messages = [
        "name.required" => "Vui lòng không để trống tên",
        "name.string" => "Tên phải là chuỗi ký tự",
        "slug.required" => "Vui lòng không để trống slug",
        "slug.string" => "Slug phải là chuỗi ký tự",
    ];

    public function storeBrand() {
        $this->validate();
        $brand = [
            "name" => $this->name,
            "slug" => Str::slug( $this->slug ),
            "status" => ( $this->status == "on" ) ? 1 : 0,
        ];
        Brand::create( $brand );
        session()->flash( "message", "Brand Created Sucessfully" );
        $this->dispatchBrowserEvent( "close-modal" );

        $this->resetInput();
    }

    public function editBrand( int $brand_id ) {
        $brand = Brand::findOrfail( $brand_id );
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->brand_id = $brand_id;
    }

    public function updateBrand() {
        $this->validate();
        $brand = [
            "name" => $this->name,
            "slug" => Str::slug( $this->slug ),
            "status" => ( $this->status == true ) ? 1 : 0,
        ];
        Brand::findOrFail( $this->brand_id )->update( $brand );
        session()->flash( "message", "Brand Updated Sucessfully" );
        $this->dispatchBrowserEvent( "close-modal" );

        $this->resetInput();
    }

    public function deleteBrand( $brand_id ) {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand() {
        Brand::findOrFail( $this->brand_id )->delete();
        session()->flash( "message", "Brand Deleted Sucessfully" );
        $this->dispatchBrowserEvent( "close-modal" );

        $this->resetInput();
    }

    public function render()
    {
        $brands = Brand::orderBy( "id" , "DESC" )->paginate( 10 );
        return view('livewire.admin.brand.index' , [ 'brands' => $brands ] )
            ->extends( "layouts.admin_master" )
            ->section( "content" );
    }

    public function closeModal() {
        $this->resetInput();
    }

    public function opendModal() {
        $this->resetInput();
    }

    public function resetInput() {
        $this->name = null;
        $this->slug = null;
        $this->start = null;
        $this->brand_id = null;
    }
}
