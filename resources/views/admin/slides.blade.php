@extends('layouts.admin')
@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">All Sliders</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Sliders</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="table-container rounded-3 p-3 w-100 mt-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div class="search-bar">
                <input type="text" class="rounded-3" placeholder="Search Here...">
                <i class="fa fa-search fa-lg pointer"></i>
            </div>
            <a href="{{ route('admin.add-slide') }}" class="add-btn">+ Add New</a>
        </div>
        @if (Session::has('status'))
            <p class="alert alert-success">{{ Session::get('status') }}</p>
        @endif
        <div class="w-100 overflow-x-auto">
            <table class="w-100 table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Tagline</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Link</th>
                    <th>Action</th>
                </tr>
                @foreach ($slides as $slide)
                    <tr>
                        <td>{{ $slide->id }}</td>
                        <td><img src="{{ asset('uploads/slides/'.$slide->image) }}" alt="" height="100" width="100"></td>
                        <td>{{ $slide->tagline }}</td>
                        <td>{{ $slide->title }}</td>
                        <td>{{ $slide->subtitle }}</td>
                        <td>{{ $slide->link }}</td>
                        <td>
                            <a href="" class="text-primary me-2"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.slide-edit',['id'=>$slide->id]) }}" class="text-success me-2"><i class="fa fa-pencil"></i></a>
                            <button class="text-danger bg-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-bs-id="{{ $slide->id }}"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $slides->links('pagination::bootstrap-5') }}
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="{{ route('admin.slide-delete', ['id' => 1]) }}" method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    var exampleModal = document.getElementById('exampleModal');
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        
        // Extract info from data-bs-* attributes
        var brandId = button.getAttribute('data-bs-id');
        
        // Update the form action dynamically
        var form = document.getElementById('deleteForm');
        form.action = '/admin/slide/delete/' + brandId;
    });
</script>
@endpush
