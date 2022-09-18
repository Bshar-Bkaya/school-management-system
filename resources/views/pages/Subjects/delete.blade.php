<!-- Deleted Subject -->
<div class="modal fade" id="delete_subject{{$subject->id}}" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
          حذف مادة دراسية
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('Subjects.destroy','test')}}" method="post">
          {{method_field('delete')}}
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{$subject->id}}">

          <h5> {{ trans('Grades_trans.Warning_Grade') }} {{$subject->name}}</h5>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
              data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
            <button class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
