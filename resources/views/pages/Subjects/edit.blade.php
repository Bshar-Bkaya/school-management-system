@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
تعديل مادة دراسية
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
تعديل مادة دراسية
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
            <form action="{{route('Subjects.update','test')}}" method="post" autocomplete="off">
              {{ method_field('patch') }}
              @csrf
              <div class="form-row">
                <div class="col">
                  <label for="title">اسم المادة باللغة العربية</label>
                  <input type="text" name="Name_ar" value="{{ $subject->getTranslation('name', 'ar') }}"
                    class="form-control">
                  <input type="hidden" name="id" value="{{$subject->id}}">
                </div>
                <div class="col">
                  <label for="title">اسم المادة باللغة الانجليزية</label>
                  <input type="text" name="Name_en" value="{{ $subject->getTranslation('name', 'en') }}"
                    class="form-control">
                </div>
              </div>
              <br>

              <div class="form-row">
                <div class="form-group col">
                  <label for="inputState">المرحلة الدراسية</label>
                  <select class="custom-select my-1 mr-sm-2" name="Grade_id" onchange="getClassrooms(this.value)">
                    <option selected disabled>{{trans('parents.Choose')}}...</option>
                    @foreach($grades as $grade)
                    <option value="{{$grade->id}}" {{$grade->id == $subject->grade_id ?'selected':''}}>
                      {{$grade->Name }}
                    </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col">
                  <label for="inputState">الصف الدراسي</label>
                  <select name="Class_id" class="custom-select" id="select_classroom_id">
                    <option value="{{ $subject->classroom->id }}">
                      {{ $subject->classroom->Name_Class }}
                    </option>
                  </select>
                </div>

                <div class="form-group col">
                  <label for="inputState">اسم المعلم</label>
                  <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                    <option selected disabled>{{trans('parents.Choose')}}...</option>
                    @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}" {{$teacher->id == $subject->teacher_id
                      ?'selected':''}}>
                      {{$teacher->Name}}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ
                البيانات
              </button>
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
</script>
@endsection
