@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <i class="fas fa-home"></i>
                    {{ __('You are logged in!') }}
                    <button class="test btn btn-primary">test</button>

                        <br>
                    {{ Request::url() }}
                        <br>
                        <br>
                        <br>
                        <br>
                    <button class="btn btn-primary testAlert">Test Alert</button>
                    <button class="btn btn-primary testToast">Test Toast</button>
                        <br>
                        <br>
                        <br>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('foot')
    <script>

        $(".testAlert").click(function (){
            Swal.fire({
                icon: 'success',
                title: 'Hello Test',
                text: "I'm testing!",
                footer: '<a href="">Why do I have this issue?</a>'
            })
        });
    </script>
@endsection
