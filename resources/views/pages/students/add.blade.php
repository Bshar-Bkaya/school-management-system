@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
{{trans('main_trans.add_student')}}
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('main_trans.add_student')}}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        <form action="{{ route('Students.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
          @csrf
          <h6 style="font-family: 'Cairo', sans-serif;color: blue">
            {{trans('Students_trans.personal_information')}}
          </h6>
          <br>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{trans('Students_trans.name_ar')}} : <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name_ar">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>{{trans('Students_trans.name_en')}} : <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name_en">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{trans('Students_trans.email')}} : </label>
                <input type="email" class="form-control" name="email">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>{{trans('Students_trans.password')}} :</label>
                <input type="password" class="form-control" name="password">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="gender">{{trans('Students_trans.gender')}} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="gender_id">
                  <option selected disabled>{{trans('parents.Choose')}}...</option>
                  @foreach($Genders as $Gender)
                  <option value="{{ $Gender->id }}">{{ $Gender->Name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="nal_id">{{trans('Students_trans.Nationality')}} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="nationalitie_id">
                  <option selected disabled>{{trans('parents.Choose')}}...</option>
                  @foreach($nationals as $nal)
                  <option value="{{ $nal->id }}">{{ $nal->Name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="bg_id">{{trans('Students_trans.blood_type')}} : </label>
                <select class="custom-select mr-sm-2" name="blood_id">
                  <option selected disabled>{{trans('parents.Choose')}}...</option>
                  @foreach($bloods as $bg)
                  <option value="{{ $bg->id }}">{{ $bg->Name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>{{trans('Students_trans.Date_of_Birth')}} :</label>
                <input type="text" class="form-control" id="datepicker-action" name="Date_Birth"
                  data-date-format="yyyy-mm-dd">
              </div>
            </div>
          </div>

          {{-- Start Student Information --}}
          <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Students_trans.Student_information')}}</h6>
          <br>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="Grade_id" onchange="getClassrooms(this.value)">
                  <option selected disabled>{{trans('parents.Choose')}}...</option>
                  @foreach($my_classes as $c)
                  <option value="{{ $c->id }}">{{ $c->Name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                    class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="Classroom_id" id="select_classroom_id"
                  onchange="getSections(this.value)">

                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="section_id">{{trans('Students_trans.section')}} : </label>
                <select class="custom-select mr-sm-2" name="section_id" id="select_section_id">

                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="parent_id">{{trans('Students_trans.parent')}} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="parent_id">
                  <option selected disabled>{{trans('parents.Choose')}}...</option>
                  @foreach($parents as $parent)
                  <option value="{{ $parent->id }}">{{ $parent->Name_Father }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="academic_year">
                  {{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span>
                </label>
                <select class="custom-select mr-sm-2" name="academic_year">
                  <option selected disabled>{{trans('parents.Choose')}}...</option>
                  @php
                  $current_year = date("Y");
                  @endphp
                  @for($year=$current_year; $year != $current_year + 2 ;$year++)
                  <option value="{{$year}}">{{ $year }} </option>
                  @endfor
                </select>
              </div>
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="photo">
                  الصورة الشخصية
                </label>
                <input type="file" accept="image/*" name="photo" id="photo">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="photos">
                  {{trans('Students_trans.Attachments')}} : <span class="text-danger">*</span>
                </label>
                <input type="file" accept="image/*" name="photos[]" multiple id="photos">
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
