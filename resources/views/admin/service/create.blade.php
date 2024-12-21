@extends('layouts.admin-master')
@section('title')
{{ isset($pageTitle) ? $pageTitle : 'Service Create' }}
@endsection
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ isset($pageTitle) ? $pageTitle : 'Service Create' }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($pageTitle) ? $pageTitle : 'Service Create' }}
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
                    <h4 class="card-title mb-0">{{ isset($pageTitle) ? $pageTitle : 'Faq Create' }}</h4>
                    <a href="{{ route('admin.service.index') }}" class="btn btn-warning ms-auto">Back</a>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($pageTitle) ? $pageTitle : 'Service Create' }}</h3>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            @if (isset($serviceData))
                                <form method="post" action="{{ route('admin.service.update', $serviceData->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                @else
                                    <form method="post" action="{{ route('admin.service.store') }}" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="name" class="form-label">Service Name</label>
                                    <input class="form-control" type="text" name="name" 
                                           value="{{ isset($serviceData) ? $serviceData->name : '' }}" placeholder="Service Name" 
                                           id="name" required>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="description" class="form-label">Service Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="5" 
                                              placeholder="Describe the service">{{ isset($serviceData) ? $serviceData->description : '' }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input class="form-control" type="number" name="price" 
                                           value="{{ isset($serviceData) ? $serviceData->price : '' }}" placeholder="Price" 
                                           id="price" required>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id='status'>
                                        <option
                                            value="1"{{ isset($serviceData->status) && $serviceData->status == 1 ? 'selected' : '' }}>
                                            Active</option>
                                        <option
                                            value="0"{{ isset($serviceData->status) && $serviceData->status == 0 ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6 mt-4">
        
                                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
