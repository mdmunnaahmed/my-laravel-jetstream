<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-4 p-4 align-items-center">
                                @foreach ($multipic as $image)
                                    <img src="{{ asset('img/' . $image->img) }}" alt="" style="max-width: 100px">
                                    <a href="{{ route('multipic.destroy',$image->id ) }}" class="btn btn-danger">Delete Pics</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @if (session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="las la-times"></i></button>
                        </div>
                    @endif
                    <form action="{{ route('multipic.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-5">
                            <input type="file" class="form-control" name="img[]" multiple>
                        </div>
                        <button class="btn btn-primary text-dark mt-4" type="submit">Upload Images</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="py-12">
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
                                <th scope="col">Brand Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                    <td><img src="{{ asset('img/' . $brand->brand_img) }}" alt="" style="max-width: 200px; max-height: 60px; object-fit:contain"></td>
                                    <td>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('edit.brand', $brand->id) }}">Edit</a>
                                        <a href="{{ route('destroy.brand', $brand->id) }}" onclick="return confirm('are you sure?')" class="text-danger ml-2">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>
