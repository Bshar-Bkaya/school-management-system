@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
{{ trans('section.title_page') }}
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('section.title_page') }}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
          {{ trans('section.add_section') }}
        </a>
      </div>

      <div class="card card-statistics h-100">
        <div class="card-body">
          <div class="accordion gray plus-icon round">
            @php
            $edit_i = 0;
            @endphp
            @foreach ($Grades as $grade)
            <div class="acd-group">
              <a href="#" class="acd-heading">{{ $grade->Name }}</a>
              <div class="acd-des">

                <div class="row">
                  <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                      <div class="card-body">
                        <div class="d-block d-md-flex justify-content-between">
                          <div class="d-block">
                          </div>
                        </div>
                        <div class="table-responsive mt-15">
                          <table class="table center-aligned-table mb-0">
                            <thead>
                              <tr class="text-dark">
                                <th>#</th>
                                <th>{{ trans('section.Name_Section') }}</th>
                                <th>{{ trans('section.Name_Class') }}</th>
                                <th>{{ trans('section.Status') }}</th>
                                <th>{{ trans('section.Processes') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($grade->sections as $section)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $section->Name }}</td>
                                <td>{{ $section->classroom->Name_Class }}</td>
                                <td>
                                  @if ($section->Status === 1)
                                  <label class="badge badge-success">{{ trans('section.Status_Section_AC') }}</label>
                                  @else
                                  <label class="badge badge-danger">{{ trans('section.Status_Section_No') }}</label>
                                  @endif
                                </td>
                                <td>
                                  <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $section->id }}">{{ trans('section.Edit') }}
                                  </a>
                                  <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $section->id }}">{{ trans('section.Delete') }}
                                  </a>
                                </td>
                              </tr>

                              <!--تعديل قسم -->
                              <div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                        id="exampleModalLabel">
                                        {{ trans('section.edit_Section') }}
                                      </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">

                                      <form action="{{ route('Section.update', 'test') }}" method="POST">
                                        {{ method_field('patch') }}
                                        {{ csrf_field() }}
                                        <div class="row">
                                          <div class="col">
                                            <input type="text" name="Name_Section_Ar" class="form-control"
                                              value="{{ $section->getTranslation('Name', 'ar') }}">
                                          </div>

                                          <div class="col">
                                            <input type="text" name="Name_Section_En" class="form-control"
                                              value="{{ $section->getTranslation('Name', 'en') }}">

                                            <input id="id" type="hidden" name="id" class="form-control"
                                              value="{{ $section->id }}">
                                          </div>
                                        </div>
                                        <br>

                                        <div class="col">
                                          <label for="inputName" class="control-label">
                                            {{ trans('section.Name_Grade') }}
                                          </label>

                                          <select name="grade_id" class="custom-select"
                                            onchange="getClassrooms_edit(this.value,{{ $edit_i }})">
                                            <!--placeholder-->
                                            <option value="{{ $grade->id }}" selected>
                                              -- {{ $grade->Name }} --
                                            </option>

                                            @foreach ($list_Grades as $list_Grade)
                                            <option value="{{ $list_Grade->id }}">
                                              {{ $list_Grade->Name }}
                                            </option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                          <label for="inputName" class="control-label">
                                            {{ trans('section.Name_Class') }}
                                          </label>
                                          <select name="classroom_id" class="custom-select"
                                            id="select_classroom_id_edit{{ $edit_i++ }}">
                                            <option value="{{ $section->classroom->id }}">
                                              {{ $section->classroom->Name_Class }}
                                            </option>
                                          </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                          <label for="inputName_111"
                                            class="control-label">{{ trans('Teacher_trans.Name_Teacher') }}</label>
                                          <select id="inputName_111" name="teacher_id[]" class="form-control" multiple>
                                            <option class="p-2 text-center text-bold" value="" disabled>
                                              -- حدد المعلمين --
                                            </option>
                                            @foreach( $section->teachers as $st)
                                            <option class="px-2 py-2 d-inline-block text-danger" value="{{ $st->id }}"
                                              selected disabled>
                                              {{ $st->Name }}
                                            </option>
                                            @endforeach

                                            @foreach( $list_teachers as $teacher)
                                            <option class="p-1" value="{{ $teacher->id }}">
                                              {{ $teacher->Name }}
                                            </option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                          <div class="form-check">
                                            @if ($section->Status === 1)
                                            <input type="checkbox" class="form-check-input" name="Status"
                                              id="exampleCheck1" checked>
                                            @else
                                            <input type="checkbox" class="form-check-input" name="Status"
                                              id="exampleCheck1">
                                            @endif
                                            <label class="form-check-label" for="exampleCheck1">
                                              {{ trans('section.Status') }}
                                            </label>
                                          </div>
                                        </div>

                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            {{ trans('section.Close') }}
                                          </button>
                                          <button type="submit" class="btn btn-danger">
                                            {{ trans('section.submit') }}
                                          </button>
                                        </div>
                                      </form>

                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- delete_modal_Section -->
                              <div class="modal fade" id="delete{{ $section->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('section.delete_Section') }}
                                      </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="{{ route('Section.destroy','test') }}" method="post">
                                        {{ method_field('Delete') }}
                                        @csrf
                                        {{ trans('section.Warning_Section') }}
                                        <input id="id" type="hidden" name="id" class="form-control"
                                          value="{{ $section->id }}">
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            {{ trans('section.Close') }}
                                          </button>
                                          <button type="submit" class="btn btn-danger">
                                            {{ trans('section.submit') }}
                                          </button>
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
            @endforeach
          </div>
        </div>

        <!--اضافة قسم جديد -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                  {{ trans('section.add_section') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <form action="{{ route('Section.store') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col">
                      <input type="text" name="Name_Section_Ar" class="form-control"
                        placeholder="{{ trans('section.Section_name_ar') }}">
                    </div>

                    <div class="col">
                      <input type="text" name="Name_Section_En" class="form-control"
                        placeholder="{{ trans('section.Section_name_en') }}">
                    </div>
                  </div>
                  <br>

                  <div class="col">
                    <label for="inputName_1" class="control-label">{{ trans('section.grade') }}</label>
                    <select id="inputName_1" name="grade_id" class="custom-select"
                      onchange="getClassrooms_add(this.value)">
                      <option class="p-3" value="">-- حدد المرحلة --</option>
                      @foreach( $list_Grades as $grade)
                      <option class="p-3" value="{{ $grade->id }}"> {{ $grade->Name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <br>

                  <div class="col">
                    <label for="select_classroom_id_add" class="control-label">{{ trans('section.Name_Class') }}</label>
                    <select id="select_classroom_id_add" name="classroom_id" class="custom-select"></select>
                  </div>
                  <br>

                  <div class="col">
                    <label for="inputName_11" class="control-label">{{ trans('Teacher_trans.Name_Teacher') }}</label>
                    <select id="inputName_11" name="teacher_id[]" class="form-control" multiple>
                      <option class="p-3 text-center text-bold" value="" disabled>
                        -- حدد المعلمين --
                      </option>
                      @foreach( $list_teachers as $teacher)
                      <option class="p-1" value="{{ $teacher->id }}"> {{ $teacher->Name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <br>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                      {{ trans('section.Close') }}
                    </button>
                    <button type="submit" class="btn btn-danger">{{ trans('section.submit') }}</button>
                  </div>
                </form>
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
{{-- Start Ajax To Select Classroom When User Select The Grade --}}
<script>
  function getClassrooms_add($id) {
    let classroom = document.getElementById("select_classroom_id_add");
    console.log($id)
    let myRequest = new XMLHttpRequest();
    while (classroom.firstChild) {
      classroom.removeChild(classroom.firstChild);
    }
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

  function getClassrooms_edit($id,$edit_i) {
    let classroom_edit = document.getElementById("select_classroom_id_edit" + $edit_i);
    while (classroom_edit.firstChild) {
      classroom_edit.removeChild(classroom_edit.firstChild);
    }
    let myRequest = new XMLHttpRequest();
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
            classroom_edit.appendChild(myoption);
          }
        }
      }
    };
    myRequest.open("GET", `http://127.0.0.1:8000/classes/${$id}`, true);
    // myRequest.open("GET",`http://schoole-system.test/classes/${$id}`,true);
    myRequest.send();
  }
</script>
{{-- End Ajax To Select Classroom When User Select The Grade --}}

@endsection
