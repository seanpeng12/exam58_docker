@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    {{--@if(App\Models\BackpackUser::find(1)->hasRole('admin'))
                        <h1>Wood!</h1>
                    @endif--}}

                    @role('admin')
                        <h1>Wood!</h1>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
