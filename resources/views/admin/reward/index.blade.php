@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('reward::reward.name') !!} <small> {!! trans('cms.manage') !!} {!! trans('reward::reward.names') !!}</small>
@stop

@section('title')
{!! trans('reward::reward.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! URL::to('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('cms.home') !!} </a></li>
    <li class="active">{!! trans('reward::reward.names') !!}</li>
</ol>
@stop

@section('entry')
<div class="box box-warning" id='entry-reward'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="main-list" class="table table-striped table-bordered">
    <thead>
        <th>{!! trans('reward::reward.label.price')!!}</th>
            <th>{!! trans('reward::reward.label.status')!!}</th>

    </thead>
</table>
@stop
@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    $('#entry-reward').load('{{URL::to('admin/reward/reward/0')}}');
    oTable = $('#main-list').dataTable( {
        "ajax": '{{ URL::to('/admin/reward/reward') }}',
        "columns": [
            {data :'price'},
            {data :'status'},

        ],
        "rewardLength": 50
    });

    $('#main-list tbody').on( 'click', 'tr', function () {
        $(this).toggleClass("selected").siblings(".selected").removeClass("selected");

        var d = $('#main-list').DataTable().row( this ).data();

        $('#entry-reward').load('{{URL::to('admin/reward/reward')}}' + '/' + d.id);

    });
});
</script>
@stop

@section('style')
@stop