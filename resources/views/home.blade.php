@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Total Number of Vouchers : {{$vouchers}}</h3>
                    <h3>Total Number of Redemption : {{$redemption}}</h3>
                    <h3>Total Number of Clients : {{$clients}}</h3>
                    <h3>Total Number of Users : {{$users}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
