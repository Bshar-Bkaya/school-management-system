@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
{{trans('main_trans.promotion')}}
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('main_trans.promotion')}}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">

  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <h6 style="color: red;font-family: Cairo">المرحلة الدراسية القديمة</h6>
        <br>

        <form method="post" action="{{ route('Promotions.store') }}">
          @csrf
          <div class="form-row">
            <div class="form-group col">
              <label for="inputState">{{trans('Students_trans.Grade')}}</label>
              <select class="custom-select mr-sm-2" name="Grade_id" required onchange="getClassrooms(this.value)">
                <option selected disabled>{{trans('parents.Choose')}}...</option>
                @foreach($Grades as $Grade)
                <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col">
              <label for="Classroom_id">{{trans('Students_trans.classrooms')}} :
                <span class="text-danger">*</span></label>
              <select class="custom-select mr-sm-2" name="Classroom_id" id="select_classroom_id" required
                onchange="getSections(this.value)">

              </select>
            </div>

            <div class="form-group col">
              <label for="section_id">{{trans('Students_trans.section')}} : </label>
              <select class="custom-select mr-sm-2" name="section_id" id="select_section_id" required>

              </select>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span
                    class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="academic_year">
                  <option selected disabled>{{trans('parents.Choose')}}...</option>
                  @php
                  $current_year = date("Y");
                  @endphp
                  @for($year=$current_year; $year <= $current_year + 1 ;$year++) <option value="{{ $year }}">{{ $year }}
                    </option>
                    @endfor
                </select>
              </div>
            </div>

          </div>
          <br>
          {{-- New --}}
          <h6 style="color: red;font-family: Cairo">المرحلة الدراسية الجديدة</h6>
          <br>

          <div class="form-row">
            <div class="form-group col">
              <label for="inputState">{{trans('Students_trans.Grade')}}</label>
              <select class="custom-select mr-sm-2" name="Grade_id_new" onchange="getClassroomsNew(this.value)">
                <option selected disabled>{{trans('parents.Choose')}}...</option>
                @foreach($Grades as $Grade)
                <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col">
              <label for="Classroom_id">{{trans('Students_trans.classrooms')}}: <span
                  class="text-danger">*</span></label>
              <select class="custom-select mr-sm-2" name="Classroom_id_new" id="select_classroom_id_new"
                onchange="getSectionsNew(this.value)">

              </select>
            </div>
            <div class="form-group col">
              <label for="section_id">:{{trans('Students_trans.section')}} </label>
              <select class="custom-select mr-sm-2" name="section_id_new" id="select_section_id_new">

              </select>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="academic_year">{{trans('Students_trans.academic_year')}} :
                  <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="academic_year_new">
                  <option selected disabled>{{trans('parents.Choose')}}...</option>
                  @php
                  $current_year = date("Y");
                  @endphp
                  @for($year=$current_year; $year<= $current_year + 1 ;$year++) <option value="{{ $year}}">{{ $year }}
                    </option>
                    @endfor
                </select>
              </div>
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


  function getClassroomsNew($id) {
    let classroom = document.getElementById("select_classroom_id_new");
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

  function getSectionsNew($id) {
    let classroom = document.getElementById("select_section_id_new");
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
