@extends('layouts.master')

@section('title')
{{ trans('parents.add_parent') }}
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('parents.add_parent') }}
@stop
<!-- breadcrumb -->
@endsection

@section('css')
@livewireStyles
<link href="{{ URL::asset('css/wizard.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        {{-- <livewire:add-parent/> --}}
        @livewire('add-parent')

      </div>
    </div>
  </div>
</div>
<!-- row closed -->
@endsection

@section('js')

@livewireScripts

@endsection
