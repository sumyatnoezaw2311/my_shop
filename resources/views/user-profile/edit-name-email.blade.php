@extends('layouts.app')

@section("title") Edit Profile @endsection

@section('content')

    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Name & Email</li>
    </x-bread-crumb>

    <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.changeInformation') }}" method="post">
                            @csrf
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td class="pr-3 pb-3">
                                            <label class="mb-0" for="">
                                                <i class="feather-user mr-2 font-weight-bold"></i>
                                                Name :
                                            </label>
                                        </td>
                                        <td class="pb-3">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}">
                                            @error('name')
                                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-3 pb-3">
                                            <label class="mb-0" for="">
                                                <i class="feather-mail mr-2 font-weight-bold"></i>
                                                Email :
                                            </label>
                                        </td>
                                        <td class="pb-3">
                                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}">
                                            @error("email")
                                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-3 pb-3">
                                            <label class="mb-0" for="">
                                                <i class="feather-phone mr-2 font-weight-bold"></i>
                                                Phone Number :
                                            </label>
                                        </td>
                                        <td class="pb-3">
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ auth()->user()->phone }}">
                                            @error('phone')
                                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-3 pb-3">
                                            <label class="mb-0" for="">
                                                <i class="feather-map-pin mr-2 font-weight-bold"></i>
                                                Address :
                                            </label>
                                        </td>
                                        <td class="pb-3">
                                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ auth()->user()->address }}">
                                            @error('address')
                                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3">
                                            <div class="custom-control custom-checkbox">
                                                <input name="check" type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Are you sure?</label>
                                                <br>
                                                @error('check')
                                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <button class="btn btn-primary float-right" type="submit">Confirm</button>
                                        </td>
{{--                                        <td class="pb-3">--}}
{{--                                            <input class="mr-2" name="check" id="check" type="radio" aria-label="Radio button for following text input">--}}
{{--                                            <label for="check">Are you sure?</label>--}}
{{--                                            <br>--}}
{{--                                            @error('check')--}}
{{--                                            <small class="text-danger font-weight-bold">{{ $message }}</small>--}}
{{--                                            @enderror--}}
{{--                                        </td>--}}
                                    </tr>

                                </tbody>
                            </table>


                        </form>
                    </div>
                </div>
            </div>

    </div>
@endsection
