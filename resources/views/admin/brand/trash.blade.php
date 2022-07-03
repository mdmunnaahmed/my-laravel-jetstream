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
                            @if (count($trash) >= 1)
                                @foreach ($trash as $brand)
                                    <tr>
                                        <td>{{ $trash->firstItem() + $loop->index }}</td>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset('img/' . $brand->brand_img) }}" alt="" style="max-width: 200px; max-height: 60px; object-fit:contain"></td>
                                        <td>{{ Carbon\Carbon::parse($brand->deleted_at)->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('restore.brand', $brand->id) }}">Restore</a>
                                            <a href="{{ route('pdelete.brand', $brand->id) }}" class="text-danger ml-2">Permanently Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center border-0">
                                        <p class="text-muted">No data found</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $trash->links() }}
                    <a href="{{ route('all.brand') }}" class="btn btn-primary">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
