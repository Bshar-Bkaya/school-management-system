<div class="modal fade" id="delete_exam{{$question->id}}" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">حذف سؤال</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('questions.destroy','test')}}" method="post">
          {{method_field('delete')}}
          {{csrf_field()}}
          <h5> {{ trans('My_Classes_trans.Warning_Grade') }} {{$question->name}}</h5>
          <input type="hidden" name="id" value="{{$question->id}}">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              {{ trans('Students_trans.Close') }}
            </button>
            <button type="submit" class="btn btn-danger">
              {{ trans('Students_trans.submit') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
