@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
تعديل معالجة رسوم
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
تعديل معالجة رسوم : <label style="color: red">{{$ProcessingFee->student->name}}</label>
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        <form action="{{route('ProcessingFee.update','test')}}" method="post" autocomplete="off">
          @method('PUT')
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>المبلغ : <span class="text-danger">*</span></label>
                <input class="form-control" name="Debit" value="{{$ProcessingFee->amount}}" type="number">
                <input type="hidden" name="student_id" value="{{$ProcessingFee->student->id}}" class="form-control">
                <input type="hidden" name="id" value="{{$ProcessingFee->id}}" class="form-control">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>البيان : <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                  rows="3">{{$ProcessingFee->description}}</textarea>
              </div>
            </div>

          </div>
          <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
            {{trans('Students_trans.submit')}}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- row closed -->
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
