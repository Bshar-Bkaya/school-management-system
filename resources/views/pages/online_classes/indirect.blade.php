@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
اضافة حصة جديدة اوفلاين
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
اضافة حصة جديدة اوفلاين
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        <form method="post" action="{{ route('indirect.store.admin') }}" autocomplete="off">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="Grade_id" onchange="getClassrooms(this.value)">
                  <option selected disabled>{{ trans('parents.Choose') }}...</option>
                  @foreach ($Grades as $Grade)
                  <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                    class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="Classroom_id" id="select_classroom_id" onchange="getSections(this.value)">

                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                <select class="custom-select mr-sm-2" name="section_id" id="select_section_id">

                </select>
              </div>
            </div>
          </div><br>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>رقم الاجتماع : <span class="text-danger">*</span></label>
                <input class="form-control" name="meeting_id" type="number">
              </div>
            </div>


            <div class="col-md-2">
              <div class="form-group">
                <label>عنوان الحصة : <span class="text-danger">*</span></label>
                <input class="form-control" name="topic" type="text">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>تاريخ ووقت الحصة : <span class="text-danger">*</span></label>
                <input class="form-control" type="datetime-local" name="start_time">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>مدة الحصة بالدقائق : <span class="text-danger">*</span></label>
                <input class="form-control" name="duration" type="number">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label>كلمة المرور الاجتماع : <span class="text-danger">*</span></label>
                <input class="form-control" name="password" type="text">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>لينك البدء : <span class="text-danger">*</span></label>
                <input class="form-control" name="start_url" type="text">
              </div>
            </div>

            <div class="col-md-8">
              <div class="form-group">
                <label>لينك الدخول للطلاب : <span class="text-danger">*</span></label>
                <input class="form-control" name="join_url" type="text">
              </div>
            </div>
          </div>

          <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
            {{ trans('Students_trans.submit') }}
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

<script>
  function getClassrooms($id) {
    let classroom = document.getElementById("select_classroom_id");
    console.log($id)
    let myRequest = new XMLHttpRequest();
    while (classroom.firstChild) {
      classroom.removeChild(classroom.firstChild);
    }
    // Append Choose Option
    let myfirstoption = document.createElement("option");
    myfirstoption.setAttribute("value", '');
    myfirstoption.setAttribute("disabled", '');
    myfirstoption.setAttribute("selected", '');
    let mytextoption = document.createTextNode('{{trans('parents.Choose')}}...');
    myfirstoption.appendChild(mytextoption);
    classroom.appendChild(myfirstoption);

    myRequest.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let data = JSON.parse(this.responseText);
        for (const key in data) {
          if (Object.hasOwnProperty.call(data, key)) {
            const cls = data[key];
            let myoption = document.createElement("option");
            myoption.setAttribute("value", key);
            let mytextoption = document.createTextNode(cls);
            myoption.appendChild(mytextoption);
            classroom.appendChild(myoption);
          }
        }
      }
    };
    myRequest.open("GET", `http://127.0.0.1:8000/classes/${$id}`, true);
    // myRequest.open("GET",`http://schoole-system.test/classes/${$id}`,true);
    myRequest.send();
  }

  function getSections($id) {
    let classroom = document.getElementById("select_section_id");
    console.log($id)
    let myRequest = new XMLHttpRequest();
    while (classroom.firstChild) {
      classroom.removeChild(classroom.firstChild);
    }
    // Append Choose Option
    let myfirstoption = document.createElement("option");
    myfirstoption.setAttribute("value", '');
    myfirstoption.setAttribute("disabled", '');
    myfirstoption.setAttribute("selected", '');
    let mytextoption = document.createTextNode('{{trans('parents.Choose')}}...');
    myfirstoption.appendChild(mytextoption);
    classroom.appendChild(myfirstoption);

    myRequest.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let data = JSON.parse(this.responseText);
        for (const key in data) {
          if (Object.hasOwnProperty.call(data, key)) {
            const cls = data[key];
            let myoption = document.createElement("option");
            myoption.setAttribute("value", key);
            let mytextoption = document.createTextNode(cls);
            myoption.appendChild(mytextoption);
            classroom.appendChild(myoption);
          }
        }
      }
    };
    myRequest.open("GET", `http://127.0.0.1:8000/sections/${$id}`, true);
    // myRequest.open("GET",`http://schoole-system.test/classes/${$id}`,true);
    myRequest.send();
  }
</script>
@endsection
