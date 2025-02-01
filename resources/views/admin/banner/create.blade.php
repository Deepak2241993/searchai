@extends('layouts.admin-master')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Banner Create' }}
@endsection
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ isset($pageTitle) ? $pageTitle : 'Banner Create' }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($pageTitle) ? $pageTitle : 'Banner Create' }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content py-4"> 
        <div class="container-fluid">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center rounded">
                    <h4 class="card-title mb-0">{{ isset($pageTitle) ? $pageTitle : 'Banner Create' }}</h4>
                    <a href="{{ route('admin.banner.index') }}" class="btn btn-warning ms-auto">Back</a>
                </div>
            </div> 
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($pageTitle) ? $pageTitle : 'Banner Create' }}</h3>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            @if (isset($bannerData))
                                <form method="post" action="{{ route('admin.banner.update', $bannerData->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                @else
                                    <form method="post" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="row">
                                <!-- Title Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="title" 
                                        name="title" 
                                        value="{{ isset($bannerData) ? $bannerData->title : '' }}" 
                                        placeholder="Enter title" 
                                        required>
                                </div>

                                <!-- Description Field -->
                                <div class="mb-3 col-lg-12">
                                    <label for="summernote" class="form-label">Description</label>
                                    <textarea 
                                        class="form-control" 
                                        id="summernote" 
                                        name="description" 
                                        rows="5" 
                                        placeholder="Enter description" 
                                        required>{{ isset($bannerData) ? $bannerData->description : '' }}</textarea>
                                </div>

                                <!-- Image Upload Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="image" class="form-label">Image</label>
                                    <input 
                                        type="file" 
                                        class="form-control" 
                                        id="image" 
                                        name="image" 
                                        accept="image/*">
                                    @if(isset($bannerData) && $bannerData->image)
                                        <div class="mt-2">
                                            <img src="{{ url('/').'/'.('storage/' . $bannerData->image) }}" alt="Image Preview" width="100">
                                        </div>
                                    @endif
                                </div>

                                <!-- Status Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select 
                                        class="form-control" 
                                        id="status" 
                                        name="status">
                                        <option 
                                            value="1" {{ isset($bannerData->status) && $bannerData->status == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option 
                                            value="0" {{ isset($bannerData->status) && $bannerData->status == 0 ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>

                                <!-- Order Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="order" class="form-label">Order</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="order" 
                                        name="order" 
                                        value="{{ isset($bannerData) ? $bannerData->order : '' }}" 
                                        placeholder="Enter display order" 
                                        required>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3 col-lg-6 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($bannerData) ? 'Update' : 'Submit' }}
                                    </button>
                                </div>
                            </div>

                            </form>
                            
                        </div> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('scripts')

@endsection
