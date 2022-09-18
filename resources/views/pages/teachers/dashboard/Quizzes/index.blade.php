@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
قائمة الاختبارات
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
قائمة الاختبارات
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <div class="col-xl-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <a href="{{route('quizzes.create')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
                اضافة اختبار جديد
              </a>
              <br><br>
              <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                  style="text-align: center">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>اسم الاختبار</th>
                      <th>اسم المعلم</th>
                      <th>المرحلة الدراسية</th>
                      <th>الصف الدراسي</th>
                      <th>القسم</th>
                      <th>العمليات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($quizzes as $quizze)
                    <tr>
                      <td>{{ $loop->iteration}}</td>
                      <td>{{$quizze->name}}</td>
                      <td>{{$quizze->teacher->Name}}</td>
                      <td>{{$quizze->grade->Name}}</td>
                      <td>{{$quizze->classroom->Name_Class}}</td>
                      <td>{{$quizze->section->Name}}</td>
                      <td>
                        <a href="{{route('quizzes.edit',$quizze->id)}}" class="btn btn-info btn-sm" role="button"
                          aria-pressed="true" title="تعديل">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                          data-target="#delete_exam{{ $quizze->id }}" title="حذف">
                          <i class="fa fa-trash"></i>
                        </button>
                        <a href="{{route('quizzes.show',$quizze->id)}}" class="btn btn-warning btn-sm"
                          title="عرض الاسئلة" role="button" aria-pressed="true">
                          <i class="fa fa-binoculars"></i>
                        </a>
                        <a href="{{route('student.quizze',$quizze->id)}}" class="btn btn-primary btn-sm"
                          title="عرض الطلاب المختبرين" role="button" aria-pressed="true">
                          <i class="fa fa-street-view"></i>
                        </a>
                      </td>
                    </tr>

                    @include('pages.teachers.dashboard.Quizzes.delete')
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
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
