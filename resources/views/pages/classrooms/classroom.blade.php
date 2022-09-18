@extends('layouts.master')

@section('title')
{{ trans('classroom.Classroom') }}
@stop

@section('css')
@toastr_css
@endsection

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('classroom.Classroom')}}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">

  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
          {{ trans('classroom.add_classroom') }}
        </button>

        <button type="button" class="button x-small" data-toggle="modal" data-target="#btn_delete_all"
          onclick="getChecked()">
          {{ trans('classroom.delete_classes') }}
        </button>

        <br><br>

        <form action="{{ route('Classroom.filter') }}" id="filter_form" method="post">
          @csrf
          <select class="selectpicker p-2" name="Grade_id" onchange="document.getElementById('filter_form').submit()">
            <option selected disabled>---{{ __('classroom.Search_By_Grade') }}---</option>
            <option value="-1" class="text-dribbble text-bold">إظهار الكل</option>
            @foreach ($grades as $Grade)
            <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
            @endforeach
          </select>
        </form>
        <br>

        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr>
                <th><input type="checkbox" onclick="checkAll('box1',this)"></th>
                <th>#</th>
                <th>{{trans('classroom.Name')}}</th>
                <th>{{trans('classroom.Notes')}}</th>
                <th>{{trans('classroom.grade')}}</th>
                <th>{{trans('classroom.Processes')}}</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($classrooms as $classroom)
              <tr>
                <th><input type="checkbox" class="box1" id="{{ $classroom->id }}" value="{{ $classroom->id }}">
                </th>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $classroom->Name_Class }}</td>
                <td>{{ $classroom->Notes }}</td>
                <td>{{ $classroom->Grades->Name}}</td>

                <td>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                    data-target="#edit{{ $classroom->id }}" title="{{ trans('classroom.Edit') }}"><i
                      class="fa fa-edit"></i>
                  </button>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                    data-target="#delete{{ $classroom->id }}" title="{{ trans('classroom.Delete') }}"><i
                      class="fa fa-trash"></i>
                  </button>

                  {{-- <a href="{{ route(" classroom_student",$classroom->id) }}" class="btn btn-warning text-dark
                  btn-sm"
                  title="{{ trans('classroom.show_student') }}"><i class="fa fa-eye"></i>
                  </a> --}}

                  {{-- <a href="{{ route(" classroom_subject",$classroom->id) }}" class="btn btn-dark text-white btn-sm"
                  title="{{ trans('classroom.show_subject') }}"><i class="fa fa-eye"></i>
                  </a> --}}
                </td>
              </tr>

              <!-- edit_modal_Grade -->
              <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('classroom.Edit') }}
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- add_form -->
                      <form action="{{route('Classroom.update','test')}}" method="post">
                        {{method_field('patch')}}
                        @csrf
                        <div class="row">
                          <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('classroom.classroom_name_ar') }}
                              :</label>
                            <input id="Name" type="text" name="Name" class="form-control"
                              value="{{$classroom->getTranslation('Name_Class', 'ar')}}" required>
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $classroom->id }}">
                          </div>
                          <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('classroom.classroom_name_en') }}
                              :</label>
                            <input type="text" class="form-control"
                              value="{{$classroom->getTranslation('Name_Class', 'en')}}" name="Name_en" required>
                          </div>
                        </div>
                        <div class="rom m-3">

                          <label for="Name_en" class="mr-sm-2">{{ trans('classroom.grades') }}
                            :</label>
                          <select name="Grade" class="form-control p-0">
                            @foreach($grades as $grade)
                            <option @if($grade->id == $classroom->Grade_id) selected @endif class="form-control"
                              value="{{ $grade->id }}"> {{ $grade->Name }}
                            </option>
                            @endforeach
                          </select>

                        </div>

                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">{{ trans('classroom.Notes') }}
                            :</label>
                          <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                            rows="3">{{ $classroom->Notes }}</textarea>
                        </div>
                        <br><br>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('classroom.Close') }}</button>
                          <button type="submit" class="btn btn-success">{{ trans('classroom.submit') }}</button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>

              <!-- delete_modal_Grade -->
              <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('classroom.delete_class') }}
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route('Classroom.destroy', 'test')}}" method="post">
                        {{method_field('Delete')}}
                        @csrf
                        {{ trans('Grades_trans.Warning_Grade') }}
                        <input id="id" type="hidden" name="id" class="form-control" value="{{ $classroom->id }}">
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('classroom.Close') }}</button>
                          <button type="submit" class="btn btn-danger">{{ trans('classroom.Delete Data') }}</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- add_modal_Grade -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
            {{ trans('classroom.add_classroom') }}
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <!-- add_form -->
          <form action="{{ route('Classroom.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col">
                <label for="Name" class="mr-sm-2">{{ trans('classroom.classroom_name_ar') }}
                  :</label>
                <input id="Name" type="text" name="Name" class="form-control">
              </div>
              <div class="col">
                <label for="Name_en" class="mr-sm-2">{{ trans('classroom.classroom_name_en') }}
                  :</label>
                <input type="text" class="form-control" name="Name_en">
              </div>
            </div>
            <div class="rom m-3">

              <label for="Name_en" class="mr-sm-2">{{ trans('classroom.grades') }}
                :</label>
              <select name="Grade" class="form-control p-0">
                <option class="form-control font-weight-bold" value="" selected disabled>--- Select Grade ---</option>
                @foreach($grades as $value)
                <option class="form-control" value="{{ $value->id }}"> {{ $value->Name }}</option>
                @endforeach
              </select>

            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">{{ trans('classroom.Notes') }}
                :</label>
              <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <br><br>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary"
                data-dismiss="modal">{{ trans('classroom.Close') }}</button>
              <button type="submit" class="btn btn-success">{{ trans('classroom.submit') }}</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  {{-- Delete All Modal --}}
  <div class="modal fade" id="btn_delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
            {{ trans('classroom.delete_classes') }}
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('Classroom.deleteall')}}" method="post">
            @csrf
            {{ trans('Grades_trans.Warning_Grade') }}
            <input id="selected_box_id" type="hidden" name="selected_box_id[]" class="form-control">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary"
                data-dismiss="modal">{{ trans('classroom.Close') }}</button>
              <button type="submit" class="btn btn-danger">{{ trans('classroom.Delete Data') }}</button>
            </div>
          </form>
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
  function checkAll(className,elm){
    elms = document.getElementsByClassName(className);
    if(elm.checked)
    {
      for (let i = 0; i < elms.length; i++) {
        elms[i].checked = true;
      }
    }
    else
    {
      for (let i = 0; i < elms.length; i++) {
        elms[i].checked = false;
      }
    }
  }
</script>
<script>
  function getChecked(){
    let allbox = document.getElementsByClassName('box1');
    let add = document.getElementById('selected_box_id');
    arr = new Array();
    for (let i = 0; i < allbox.length; i++) {
      if(allbox[i].checked==true) arr.push(allbox[i].id );
    }
    add.value = arr;
  }
</script>
@endsection
