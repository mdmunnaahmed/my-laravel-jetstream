<x-app-layout>
    <x-slot name="header">
        <div class=" d-flex flex-wrap justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Update Brand</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.brand', $brand->id) }} " method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="brand_name" value="{{ $brand->brand_name ?? '' }}">
                                    @error('brand_name')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="img" class="form-label">Brand Image</label>
                                    <input type="file" class="form-control" id="img" name="brand_img" value="{{ $brand->brand_img ?? '' }}">
                                    @error('brand_img')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <img src="{{ asset('img/') }}/{{ $brand->brand_img ?? '' }}" alt="" style="max-width: 200px; max-height: 60px; object-fit:contain">
                                <button type="submit" class="btn btn-primary bg-primary mt-3">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
