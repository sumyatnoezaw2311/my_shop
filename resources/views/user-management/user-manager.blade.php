@extends('layouts.app')

@section("title") Edit Profile @endsection

@section('content')

    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">
                        <i class="feather-users mr-2"></i>
                        User List
                    </h4>
                    <div class="w-100 overflow-auto">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Controls</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td class="text-nowrap">
                                        {{ $user->name }}
                                        @if($user->is_baned == 1)
                                            <span class="ml-1 p-1 badge rounded-pill badge-danger">Banned</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">{{ $user->email }}</td>
                                    <td class="text-nowrap">{{ $user->role? "Admin":"User" }}</td>
                                    <td class="text-nowrap h-100">
                                        @if($user->role == 1)
                                            <form action="{{ route('user-manager.make-admin') }}" id="roleForm{{$user->id}}" class="d-inline-block" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addAlert({{ $user->id }})">Make Admin</button>
                                            </form>

                                            @if($user->is_baned == 1)
                                                <form action="{{ route('user-manager.restore-user') }}" class="d-inline-block" id="banForm{{$user->id}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="restoreAlert({{ $user->id }})">Restore User</button>
                                                </form>
                                            @else
                                                <form action="{{ route('user-manager.ban-user') }}" class="d-inline-block" id="banForm{{$user->id}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="banAlert({{ $user->id }})">Ban User</button>
                                                </form>
                                            @endif
                                            <a onclick="changePassword({{ $user->id }},'{{ $user->name }}')" class="btn btn-sm btn-outline-warning">Change Password</a>
                                        @else
                                            <small class="text-info">This is Admin.</small>
                                        @endif
                                    </td>
                                    <td class="text-nowrap text-left">
                                        <i class="feather-calendar"></i>
                                        {{ date_format($user->created_at,"d M Y") }}<br>
                                        <i class="feather-clock"></i>
                                        {{ date_format($user->created_at,"H:i a") }}
                                    </td>
                                    <td class="text-nowrap text-left">
                                        <i class="feather-calendar"></i>
                                        {{ date_format($user->updated_at,"d M Y") }}<br>
                                        <i class="feather-clock"></i>
                                        {{ date_format($user->updated_at,"H:i a") }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('foot')
    <script>

        function addAlert(id) {
            Swal.fire({
                title: 'Are you sure to update role?',
                text: "This user becomes an admin!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Updated!',
                        'This user is now an admin.',
                        'success',
                    )
                    setTimeout(function(){
                        $("#roleForm"+id).submit();
                    },1000)
                }
            })
        }

        function banAlert(id) {
            Swal.fire({
                title: 'Are you sure to ban?',
                text: "This user is no longer allowed to use!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Banned!',
                        'This user is banned.',
                        'success',
                    )
                    setTimeout(function(){
                        $("#banForm"+id).submit();
                    },1000)
                }
            })
        }

        function restoreAlert(id) {
            Swal.fire({
                title: 'Are you sure to restore?',
                text: "This user is allowed to use!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Updated!',
                        'This user is allowed.',
                        'success',
                    )
                    setTimeout(function(){
                        $("#banForm"+id).submit();
                    },1000)
                }
            })
        }

    function changePassword(id,name) {
        let url = '{{ route('user-manager.change-password') }}';
        Swal.fire({
            title: 'Put new password for <br>'+ name,
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off',
                required: 'required',
                minlength: 8
            },
            showCancelButton: true,
            confirmButtonText: 'Change',
            showLoaderOnConfirm: true,
            preConfirm(newPassword) {
                $.post(url,{
                    id : id,
                    password : newPassword,
                    _token: '{{ csrf_token() }}',
                }).done(function (data){
                    if(data.status ==  200){
                        Swal.fire({
                            icon: "success",
                            title: "Complete",
                            text: data.message,
                        })
                    }else{
                        let errorMessage = data.message.password[0];
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                        })
                    }
                })
            }
            //     preConfirm: (login) => {
            //         return fetch(`//api.github.com/users/${login}`)
            //             .then(response => {
            //                 if (!response.ok) {
            //                     throw new Error(response.statusText)
            //                 }
            //                 return response.json()
            //             })
            //             .catch(error => {
            //                 Swal.showValidationMessage(
            //                     `Request failed: ${error}`
            //                 )
            //             })
            //     },
            //     allowOutsideClick: () => !Swal.isLoading()
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         Swal.fire({
            //             title: `${result.value.login}'s avatar`,
            //             imageUrl: result.value.avatar_url
            //         })
            //     }
        })
    }


    </script>
@endsection
