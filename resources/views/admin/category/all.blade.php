<x-app-layout>

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
                                <th scope="col">SL No</th>
                                <th scope="col">Categroy Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $loop->index }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->user->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($category->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('edit.category', $category->id) }}">Edit</a>
                                        <a href="{{ route('delete.category', $category->id) }}" class="text-danger ml-2">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Category</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name">
                                    @error('category_name')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary bg-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Categroy Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Deleted at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catTrash as $cate)
                                <tr>
                                    <td>{{ $catTrash->firstItem() + $loop->index }}</td>
                                    <td>{{ $cate->category_name }}</td>
                                    <td>{{ $cate->user->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($cate->deleted_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('restore.category', $cate->id) }}">Restore</a>
                                        <a href="{{ route('pdelete.category', $cate->id) }}" class="text-danger ml-2">Permanently Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $catTrash->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
