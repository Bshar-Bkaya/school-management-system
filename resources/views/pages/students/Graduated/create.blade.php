@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
{{trans('main_trans.add_graduate')}}
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('main_trans.add_graduate')}}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">

  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        @if (Session::has('error_Graduated'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{Session::get('error_Graduated')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <form action="{{route('Graduated.store')}}" method="post">
          @csrf
          <div class="form-row">
            <div class="form-group col">
              <label for="inputState">{{trans('Students_trans.Grade')}}</label>
              <select class="custom-select mr-sm-2" name="Grade_id" onchange="getClassrooms(this.value)" required>
                <option selected disabled>{{trans('parents.Choose')}}...</option>
                @foreach($Grades as $Grade)
                <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col">
              <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                  class="text-danger">*</span></label>
              <select class="custom-select mr-sm-2" name="Classroom_id" id="select_classroom_id"
                onchange="getSections(this.value)" required>

              </select>
            </div>

            <div class="form-group col">
              <label for="section_id">{{trans('Students_trans.section')}} : </label>
              <select class="custom-select mr-sm-2" name="section_id" id="select_section_id" required>

              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">تاكيد</button>
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
