@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
تعديل كتاب {{$book->title}}
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
تعديل كتاب {{$book->title}}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <div class="col-xs-12">
          <div class="col-md-12">
            <br>
            <form action="{{route('library.update','test')}}" method="post" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="form-row">
                <div class="col">
                  <label for="title">اسم الكتاب</label>
                  <input type="text" name="title" value="{{$book->title}}" class="form-control">
                  <input type="hidden" name="id" value="{{$book->id}}" class="form-control">
                </div>
              </div>
              <br>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                    <select class="custom-select mr-sm-2" name="Grade_id" onchange="getClassrooms(this.value)">
                      <option selected disabled>{{trans('parents.Choose')}}...</option>
                      @foreach($grades as $grade)
                      <option value="{{ $grade->id }}" {{$book->Grade_id == $grade->id ?'selected':''}}>
                        {{ $grade->Name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                        class="text-danger">*</span></label>
                    <select class="custom-select mr-sm-2" name="Classroom_id" id="select_classroom_id"
                      onchange="getSections(this.value)">
                      <option value="{{$book->Classroom_id}}">{{$book->classroom->Name_Class}}</option>
                    </select>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label for="section_id">{{trans('Students_trans.section')}} : </label>
                    <select class="custom-select mr-sm-2" name="section_id" id="select_section_id">
                      <option value="{{$book->section_id}}">{{$book->section->Name}}</option>
                    </select>
                  </div>
                </div>
              </div><br>

              <div class="form-row">
                <div class="col">
                  <embed src="{{ URL::asset('attachments/library/'. $book->file_name) }}" type="application/pdf"
                    height="150px" width="100px">
                  <br><br>
                  <div class="form-group">
                    <label for="academic_year">المرفقات : <span class="text-danger">*</span></label>
                    <input type="file" accept="application/pdf" name="file_name">
                  </div>
                </div>
              </div>

              <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ البيانات</button>
            </form>
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
