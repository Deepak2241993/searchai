@extends('layouts.admin-master')
@section('title')
{{ isset($pageTitle) ? $pageTitle : 'Faq Create' }}
@endsection
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ isset($pageTitle) ? $pageTitle : 'Faq Create' }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($pageTitle) ? $pageTitle : 'Faq Create' }}
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
                    <a href="{{ route('admin.faq.index') }}" class="btn btn-warning ms-auto">Back</a>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($pageTitle) ? $pageTitle : 'Faq Create' }}</h3>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            @if (isset($faqData))
                                <form method="post" action="{{ route('admin.faq.update', $faqData->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                @else
                                    <form method="post" action="{{ route('admin.faq.store') }}" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-6 self">
                                    <label for="question" class="form-label">Question</label>
                                    <input class="form-control" type="text" name="question"
                                        value="{{ isset($faqData) ? $faqData->question : '' }}" placeholder="Question"
                                        id="question" required>
                                </div>
                                <div class="mb-3 col-lg-6 self">
                                    <label for="answer" class="form-label">Answer</label>
                                    <textarea onKeyDown="textCounter(this,60);" onKeyUp="textCounter(this,'q17length' ,60)" class="form-control"
                                        name="answer" id="answer" rows="5" cols="">{{ isset($faqData) ? $faqData->answer : '' }}</textarea><br>
                                    <i>Maximum of 60 characters - <input style="color:red;font-size:12pt;font-style:italic;"
                                            readonly type="text" id='q17length' name="q17length" size="3" maxlength="3"
                                            value="60"> characters left</i>
        
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id='status'>
                                        <option
                                            value="1"{{ isset($faqData->status) && $faqData->status == 1 ? 'selected' : '' }}>
                                            Active</option>
                                        <option
                                            value="0"{{ isset($faqData->status) && $faqData->status == 0 ? 'selected' : '' }}>
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
