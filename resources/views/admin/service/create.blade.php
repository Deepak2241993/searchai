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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            @if (isset($serviceData))
                                <form method="post" action="{{ route('admin.service.update', $serviceData->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                @else
                                    <form method="post" action="{{ route('admin.service.store') }}"
                                        enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="name" class="form-label">Service Name</label>
                                    <input class="form-control" type="text" name="name"
                                        value="{{ isset($serviceData) ? $serviceData->name : '' }}"
                                        placeholder="Service Name" {{ isset($serviceData)?'readonly':''}} id="name" required>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="service_slug" class="form-label">Service Slug</label>
                                    <input class="form-control" readonly type="text" name="service_slug"
                                        value="{{ isset($serviceData) ? $serviceData->service_slug : '' }}"
                                        placeholder="Service Slug" {{ isset($serviceData)?'readonly':''}} id="service_slug" required>
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" id="short_description" rows="5"
                                        placeholder="Shortly describe the service">{{ isset($serviceData) ? $serviceData->short_description : '' }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="long_description" class="form-label">Long Description</label>
                                    <textarea class="form-control" name="long_description" id="summernote" rows="5"
                                        placeholder="Describe the service">{{ isset($serviceData) ? $serviceData->long_description : '' }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input class="form-control" type="text" name="price"
                                        value="{{ isset($serviceData) ? $serviceData->price : '' }}" placeholder="Price"
                                        id="price" required>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="price" class="form-label">Tax %</label>
                                    <input class="form-control" type="number" name="tax"
                                        value="{{ isset($serviceData) ? $serviceData->tax : '' }}" placeholder="tax"
                                        id="tax" required>
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
                                <div class="mb-3 col-lg-6">
                                    <label for="images" class="form-label">Upload Images</label>
                                    <input class="form-control" type="file" name="images[]" id="images" multiple>
                                    <!-- Preview uploaded images dynamically -->
                                    <small class="form-text text-muted">You can upload multiple images.</small>
                                   @if(isset($serviceData))
                                   @php
                                        $image = explode('|', $serviceData->images);
                                    @endphp
                                    @foreach ($image as $value)
                                        <image src="{{ $value }}" height="100" width="100">
                                    @endforeach
                                    @endif
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
  
    <script>
        $("#name").on("change", function() {
            var element = $(this);
            $("button[type=submit]").prop("disabled", true);

            $.ajax({
                url: "{{ route('admin.getslug') }}",
                type: "GET",
                data: {
                    title: element.val(),
                },
                dataType: "json",
                success: function(response) {
                    $("button[type=submit]").prop("disabled", false);

                    if (response.status === true) {
                        $("#service_slug").val(response.slug);
                    }
                },
                error: function(jqXHR, exception) {
                    console.error("Something went wrong");
                    $("button[type=submit]").prop("disabled", false);
                },
            });
        });
    </script>
@endsection
