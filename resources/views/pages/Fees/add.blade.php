@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
اضافة رسوم جديدة
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
اضافة رسوم جديدة
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        <form action="{{ route('Fees.store') }}" method="post" autocomplete="off">
          @csrf
          <div class="form-row">
            <div class="form-group col">
              <label for="inputEmail4">الاسم باللغة العربية</label>
              <input type="text" value="{{ old('title_ar') }}" name="title_ar" class="form-control">
            </div>

            <div class="form-group col">
              <label for="inputEmail4">الاسم باللغة الانجليزية</label>
              <input type="text" value="{{ old('title_en') }}" name="title_en" class="form-control">
            </div>

            <div class="form-group col">
              <label for="inputEmail4">المبلغ</label>
              <input type="number" value="{{ old('amount') }}" name="amount" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col">
              <label for="select_Grade_id">المرحلة الدراسية</label>
              <select class="custom-select mr-sm-2" name="Grade_id" id="select_Grade_id"
                onchange="getClassrooms(this.value)">
                <option selected disabled>{{trans('parents.Choose')}}...</option>
                @foreach($Grades as $Grade)
                <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col">
              <label for="select_classroom_id">الصف الدراسي</label>
              <select class="custom-select mr-sm-2" name="Classroom_id" id="select_classroom_id">

              </select>
            </div>
            <div class="form-group col">
              <label for="year">السنة الدراسية</label>
              <select class="custom-select mr-sm-2" name="year" id="year">
                <option selected disabled>{{trans('parents.Choose')}}...</option>
                @php
                $current_year = date("Y")
                @endphp
                @for($year=$current_year; $year <= $current_year + 1 ;$year++) <option value="{{ $year }}">{{ $year }}
                  </option>
                  @endfor
              </select>
            </div>

            <div class="form-group col">
              <label for="inputZip">نوع الرسوم</label>
              <select class="custom-select mr-sm-2" name="Fee_type">
                <option value="1">رسوم دراسية</option>
                <option value="2">رسوم باص</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="description">ملاحظات</label>
            <textarea class="form-control" name="description" id="description" rows="4"></textarea>
          </div>
          <br>
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
</script>

@endsection
