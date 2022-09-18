@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
{{trans('main_trans.techer_list')}}
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('main_trans.techer_list')}}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <div class="col-xl-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <a href="{{route('Teachers.create')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
                {{ trans('Teacher_trans.Add_Teacher') }}
              </a>
              <br><br>
              <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                  style="text-align: center">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>{{trans('Teacher_trans.Name_Teacher')}}</th>
                      <th>{{trans('Teacher_trans.Gender')}}</th>
                      <th>{{trans('Teacher_trans.Joining_Date')}}</th>
                      <th>{{trans('Teacher_trans.specialization')}}</th>
                      <th>العمليات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; ?>
                    @foreach($Teachers as $Teacher)
                    <tr>
                      <?php $i++; ?>
                      <td>{{ $i }}</td>
                      <td>{{$Teacher->Name}}</td>
                      <td>{{$Teacher->gender->Name}}</td>
                      <td>{{$Teacher->Joining_Date}}</td>
                      <td>{{$Teacher->specialization->Name}}</td>
                      <td>
                        <a href="{{route('Teachers.edit',$Teacher->id)}}" class="btn btn-info btn-sm" role="button"
                          aria-pressed="true">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                          data-target="#delete_Teacher{{ $Teacher->id }}" title="{{ trans('Grades_trans.Delete') }}">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>

                    {{-- Modal Delete Teacher  --}}
                    <div class="modal fade" id="delete_Teacher{{$Teacher->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <form action="{{route('Teachers.destroy','test')}}" method="post">
                          {{method_field('delete')}}
                          {{csrf_field()}}
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ trans('Teacher_trans.Delete_Teacher') }}
                              </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <p> {{ trans('teacher.Warning_Techer') }}</p>
                              <input type="hidden" name="id" value="{{$Teacher->id}}">
                            </div>

                            <div class="modal-footer">
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                  {{ trans('teacher.Close') }}
                                </button>
                                <button type="submit" class="btn btn-danger">
                                  {{ trans('teacher.submit') }}
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
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
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
