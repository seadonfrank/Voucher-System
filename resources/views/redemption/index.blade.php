@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <span><b>Redemption</b></span>
                    <span class="pull-right"></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(count($redemption)>0)
                            <table class="table  table-responsive">
                                <tr>
                                    <th>Id</th>
                                    <th>Voucher Id</th>
                                    <th>Voucher Code</th>
                                    <th>Value</th>
                                    <th>Owner</th>
                                    <th>Created At</th>
                                </tr>
                                @foreach($redemption as $redeemed)
                                <tr>
                                    <td>{{ $redeemed->id }}</td>
                                    <td>{{ $redeemed->voucher_id }}</td>
                                    <td>{{ $redeemed->voucher_code }}</td>
                                    <td>{{ $redeemed->value }}</td>
                                    <td>{{ $redeemed->owner }}</td>
                                    <td>{{ $redeemed->created_at }}</td>
                                </tr>
                                @endforeach
                            </table>
                            @else
                                <h4>No Vouchers have been redeemed yet.</h4>
                            @endif
                            <div class="pull-right">
                                {{ $redemption->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection