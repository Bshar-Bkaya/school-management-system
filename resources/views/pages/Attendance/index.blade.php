@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
قائمة الحضور والغياب للطلاب
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
قائمة الحضور والغياب للطلاب
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->

<h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
<form method="post" action="{{ route('Attendance.store') }}">
  @csrf
  <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
    style="text-align: center">
    <thead>
      <tr>
        <th class="alert-success">#</th>
        <th class="alert-success">{{ trans('Students_trans.name') }}</th>
        <th class="alert-success">{{ trans('Students_trans.email') }}</th>
        <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
        <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
        <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
        <th class="alert-success">{{ trans('Students_trans.section') }}</th>
        <th class="alert-success">{{ trans('Students_trans.Processes') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($students as $student)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->gender->Name }}</td>
        <td>{{ $student->grade->Name }}</td>
        <td>{{ $student->classroom->Name_Class }}</td>
        <td>{{ $student->section->Name }}</td>
        <td>
          @php
          $stuAttendance = $student->attendance()->where('attendence_date',date('Y-m-d'))->first();
          @endphp
          @if(isset($stuAttendance->student_id))
          <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
            <input type="radio" class="leading-tight" name="attendences[{{ $student->id }}]" disabled {{
              $stuAttendance->attendence_status == 1 ? 'checked' : '' }}
            value="presence">
            <span class="text-success">حضور</span>
          </label>

          <label class="ml-4 block text-gray-500 font-semibold">
            <input type="radio" class="leading-tight" name="attendences[{{ $student->id }}]" disabled {{
              $stuAttendance->attendence_status == 0 ? 'checked' : '' }}
            value="absent">
            <span class="text-danger">غياب</span>
          </label>

          <a href="#" class="btn btn-info btn-sm ml-3" data-toggle="modal"
            data-target="#delete_attendance{{ $student->id }}" title="{{ trans('section.Edit') }}">
            <i class="fa fa-edit"></i>
          </a>
          @include('pages.Attendance.edit')
          @else
          <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
            <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio" value="presence">
            <span class="text-success">حضور</span>
          </label>

          <label class="ml-4 block text-gray-500 font-semibold">
            <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio" value="absent">
            <span class="text-danger">غياب</span>
          </label>
          @endif

          <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
          <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
          <input type="hidden" name="section_id" value="{{ $student->section_id }}">
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <P>
    <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
  </P>
</form>
<br>
<!-- row closed -->
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
