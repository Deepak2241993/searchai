@extends('layouts.admin-master')
@section('title')
    User Profile
@endsection
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User Profile</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row"> <!--begin::Col-->

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">
                            <i class="fa fa-user" aria-hidden="true"></i> Name
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg rounded-pill" type="text"
                                placeholder="Enter your name" id="name-input" name="name"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email-input" class="col-sm-2 col-form-label">
                            <i class="fa fa-envelope" aria-hidden="true"></i> Email
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg rounded-pill" type="email"
                                placeholder="Enter your email" id="email-input" name="email"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address-input" class="col-sm-2 col-form-label">
                            <i class="fa fa-map-marker" aria-hidden="true"></i> Address
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg rounded-pill" type="address"
                                placeholder="Enter your address" id="address-input" name="address"
                                value="{{ old('phone', optional($user->customerAddress)->address) }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alternate_address-input" class="col-sm-2 col-form-label">
                            <i class="fa fa-map-marker" aria-hidden="true"></i> Alternate Address
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg rounded-pill" type="alternate_address"
                                placeholder="Enter your alternate_address" id="alternate_address-input" name="alternate_address"
                                value="{{ old('phone', optional($user->customerAddress)->alternate_address) }}">
                            @error('alternate_address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- @php
                    dd(($user->customerAddress)->phone);
                    @endphp --}}
                    <div class="row mb-3">
                        <label for="phone-input" class="col-sm-2 col-form-label">
                            <i class="fa fa-phone-square" aria-hidden="true"></i> Phone
                        </label>
                        <div class="col-sm-10">
                            <input type="hidden" id="countryCode" name="country_code">
                            <input class="form-control form-control-lg rounded-pill" type="tel" id="phone"
                                name="phone" placeholder="Phone Number" value="{{ old('phone', optional($user->customerAddress)->phone) }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    {{-- <div class="row mb-3">
                        <label for="profile-pic" class="col-sm-2 col-form-label">
                            <i class="fas fa-image"></i> Profile Picture
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control-file" type="file" id="profile-pic" name="profile_pic">

                            <div class="mt-2">
                                @if ($user->profile_pic)
                                    @php
                                        // Generate the public URL for the profile picture
                                        $profilePicUrl = asset('uploads/profile_pics/' . $user->profile_pic);
                                    @endphp
                                    <!-- Display the image using the generated URL -->
                                    <img id="current-profile-pic" src="{{ $profilePicUrl }}" alt="Profile Picture"
                                        class="img-thumbnail rounded-circle" width="100">
                                @else
                                    <!-- Display the default profile picture if none is set -->
                                    <img id="current-profile-pic" src="{{ asset('path_to_default_image') }}"
                                        alt="Default Profile Picture" class="img-thumbnail rounded-circle" width="100">
                                @endif
                            </div>

                            @error('profile_pic')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="row mt-4">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-lg btn-primary rounded-pill px-5">
                                <i class="fa fa-save" aria-hidden="true"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>



            </div> <!--end::Row--> <!--begin::Row-->

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
