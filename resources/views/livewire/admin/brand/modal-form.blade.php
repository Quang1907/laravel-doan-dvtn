{{-- create brand --}}
<div wire:ignore.self class="modal fade" id="brandModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Add Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeBrand">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Categories</label>
                        <select wire:model.defer="brand_category_id"  required id="" class="form-control">
                            <option value="">--Select Category--</option>
                            @foreach ( $categories as $category )
                                <option value="{{  $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error( "brand_category_id") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" wire:model.defer="name" id="">
                        @error( "name") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Brand Slug</label>
                        <input type="text" class="form-control" wire:model.defer="slug" id="">
                        @error( "slug") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="custom-control custom-checkbox checkbox-outline-success d-inline-block mr-3 mb-3">
                            <input type="checkbox" class="custom-control-input" wire:model.defer="status" id="outline-chekbox-success" {{ ( old( 'status' ) == "on" ) ? "checked" : "" }}>
                            <label class="custom-control-label" for="outline-chekbox-success">Status</label>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary bg-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary bg-primary text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- update brand --}}
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
            </div>
            <div wire:loading >
                <div class="d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-primary spinner-border-sm"
                        role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div wire:loading.remove >
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Categories</label>
                            <select wire:model.defer="brand_category_id"  required id="" class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach ( $categories as $category )
                                    <option value="{{  $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error( "brand_category_id") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" wire:model.defer="name" id="">
                            @error( "name") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Brand Slug</label>
                            <input type="text" class="form-control" wire:model.defer="slug" id="">
                            @error( "slug") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="mb-3 d-flex">
                                <div class="custom-control custom-checkbox checkbox-outline-success d-inline-block mr-3 mb-3">
                                    <input type="checkbox" class="custom-control-input" id="outline-{{ $brand_id }}-chekbox-success"  wire:model.defer="status" id="status" {{ ( old( 'status' ) == true ) ? "checked" : "" }}>
                                    <label class="custom-control-label" for="outline-{{ $brand_id }}-chekbox-success">Status</label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary bg-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary bg-primary text-white">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- delete brand --}}
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Delete Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
            </div>
            <div wire:loading >
                <div class="d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-primary spinner-border-sm"
                        role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div wire:loading.remove >
                <form wire:submit.prevent="destroyBrand">
                    <div class="modal-body">
                        <h6 class="text-danger">Are you sure you want delete this data?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary bg-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary bg-primary text-white">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
