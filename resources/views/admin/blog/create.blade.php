@extends('layouts.admin-master')
@section('title')
{{ isset($pageTitle) ? $pageTitle : 'Blog Create' }}
@endsection
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ isset($pageTitle) ? $pageTitle : 'Blog Create' }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($pageTitle) ? $pageTitle : 'Blog Create' }}
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
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-warning ms-auto">Back</a>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <!-- Hidden input for author ID -->
                        <input type="hidden" name="author_id" value="{{ auth()->id() }}">
            
                        <div class="card-header">
                            <h3 class="card-title">{{ $pageTitle ?? 'Blog Create' }}</h3>
                        </div>
            
                        <!-- Error Alert -->
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
            
                        <div class="card-body">
                            <!-- Form Start -->
                            <form method="post" 
                                  action="{{ isset($blogData) ? route('admin.blog.update', $blogData->id) : route('admin.blog.store') }}" 
                                  enctype="multipart/form-data">
                                @csrf
                                @if (isset($blogData))
                                    @method('PUT')
                                @endif
                                
                                <div class="row">
                                    <!-- Blog Title -->
                                    <div class="mb-3 col-lg-12">
                                        <label for="title" class="form-label">Blog Title</label>
                                        <input class="form-control" 
                                               type="text" 
                                               name="title" 
                                               id="title" 
                                               value="{{ old('title', $blogData->title ?? '') }}" 
                                               placeholder="Blog Title" 
                                               required>
                                    </div>
            
                                    <!-- Blog Content -->
                                    <div class="mb-3 col-lg-12">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea class="form-control" 
                                                  name="content" 
                                                  id="content" 
                                                  rows="5" 
                                                  placeholder="Describe the blog">{{ old('content', $blogData->content ?? '') }}</textarea>
                                    </div>
            
                                    <!-- Long Content -->
                                    <div class="mb-3 col-lg-12">
                                        <label for="long_content" class="form-label">Long Content</label>
                                        <input class="form-control" 
                                               type="text" 
                                               name="long_content" 
                                               id="summernote" 
                                               value="{{ old('long_content', $blogData->long_content ?? '') }}" 
                                               placeholder="Long Content" 
                                               required>
                                    </div>
            
                                    <!-- Blog Image -->
                                    <div class="mb-3 col-lg-6">
                                        <label for="blog_image" class="form-label">Blog Image</label>
                                        <input type="file" 
                                               class="form-control" 
                                               id="blog_image" 
                                               name="blog_image" 
                                               accept="image/*">
                                        @if (isset($blogData->blog_image) && $blogData->blog_image)
                                            <div class="mt-2">
                                                <img src="{{ url('/').'/'.('storage/' . $blogData->blog_image) }}" alt="Image Preview" width="100">
                                            </div>
                                        @endif
                                    </div>
            
                                    <!-- Blog Status -->
                                    <div class="mb-3 col-lg-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="draft" {{ old('status', $blogData->status ?? '') == 'draft' ? 'selected' : '' }}>
                                                Draft
                                            </option>
                                            <option value="published" {{ old('status', $blogData->status ?? '') == 'published' ? 'selected' : '' }}>
                                                Published
                                            </option>
                                        </select>
                                    </div>
            
                                    <!-- Submit Button -->
                                    <div class="mb-3 col-lg-6 mt-4">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form End -->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>    
@endsection
@section('scripts')

@endsection
