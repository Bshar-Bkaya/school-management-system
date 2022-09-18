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
              <a href="{{route('Quizzes.create')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
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
                        <a href="{{route('Quizzes.edit',$quizze->id)}}" class="btn btn-info btn-sm" role="button"
                          aria-pressed="true">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                          data-target="#delete_exam{{ $quizze->id }}" title="حذف">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>

                    <!-- Deleted Quizze -->
                    <div class="modal fade" id="delete_exam{{$quizze->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                              حذف مادة دراسية
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('Quizzes.destroy','test')}}" method="post">
                              {{method_field('delete')}}
                              {{csrf_field()}}
                              <input type="hidden" name="id" value="{{$quizze->id}}">

                              <h5> {{ trans('Grades_trans.Warning_Grade') }} {{$quizze->name}}</h5>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                  data-dismiss="modal">{{trans('classroom.Close')}}</button>
                                <button class="btn btn-danger">{{trans('classroom.submit')}}</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
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
