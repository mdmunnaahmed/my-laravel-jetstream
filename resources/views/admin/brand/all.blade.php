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
                    @if (session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="las la-times"></i></button>
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset('img/' . $brand->brand_img) }}" alt="" style="max-width: 200px; max-height: 60px; object-fit:contain"></td>
                                    <td>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('edit.brand', $brand->id) }}">Edit</a>
                                        <a href="{{ route('destroy.brand', $brand->id) }}" class="text-danger ml-2">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $brands->links() }}
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Update Brand</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }} " method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="brand_name" value="{{ $brand2->brand_name ?? '' }}">
                                    @error('brand_name')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="img" class="form-label">Brand Image</label>
                                    <input type="file" class="form-control" id="img" name="brand_img" value="{{ $brand2->brand_img ?? '' }}">
                                    @error('brand_img')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary bg-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Deleted at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brandTrash as $brand3)
                                <tr>
                                    <td>{{ $brandTrash->firstItem() + $loop->index }}</td>
                                    <td>{{ $brand3->brand_name }}</td>
                                    <td><img src="{{ asset('img/' . $brand3->brand_img) }}" alt="" style="max-width: 200px; max-height: 60px; object-fit:contain"></td>
                                    <td>{{ Carbon\Carbon::parse($brand3->deleted_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('restore.brand', $brand3->id) }}">Restore</a>
                                        <a href="{{ route('pdelete.brand', $brand3->id) }}" class="text-danger ml-2">Permanently Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $brandTrash->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
