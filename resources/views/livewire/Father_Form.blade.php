<div class="col-xs-12">
  <div class="col-md-12">
    <br>
    <div class="form-row">
      <div class="col">
        <label for="Email">{{trans('parents.Email')}}</label>
        <input id="Email" type="email" wire:model="Email" class="form-control">
        @error('Email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="password">{{trans('parents.Password')}}</label>
        <input id="password" type="password" wire:model="Password" class="form-control">
        @error('Password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="col">
        <label for="title">{{trans('parents.Name_Father')}}</label>
        <input type="text" wire:model="Name_Father" class="form-control">
        @error('Name_Father')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="title">{{trans('parents.Name_Father_en')}}</label>
        <input type="text" wire:model="Name_Father_en" class="form-control">
        @error('Name_Father_en')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-3">
        <label for="title">{{trans('parents.Job_Father')}}</label>
        <input type="text" wire:model="Job_Father" class="form-control">
        @error('Job_Father')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-3">
        <label for="title">{{trans('parents.Job_Father_en')}}</label>
        <input type="text" wire:model="Job_Father_en" class="form-control">
        @error('Job_Father_en')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="col">
        <label for="title">{{trans('parents.National_ID_Father')}}</label>
        <input type="text" wire:model="National_ID_Father" class="form-control">
        @error('National_ID_Father')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="title">{{trans('parents.Passport_ID_Father')}}</label>
        <input type="text" wire:model="Passport_ID_Father" class="form-control">
        @error('Passport_ID_Father')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="col">
        <label for="title">{{trans('parents.Phone_Father')}}</label>
        <input type="text" wire:model="Phone_Father" class="form-control">
        @error('Phone_Father')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

    </div>


    <div class="form-row">
      <div class="form-group col-md-6">
        <label>{{trans('parents.Nationality_Father_id')}}</label>
        <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Father_id">
          <option selected>{{trans('parents.Choose')}}...</option>
          @foreach($Nationalities as $National)
          <option value="{{$National->id}}">{{$National->Name}}</option>
          @endforeach
        </select>
        @error('Nationality_Father_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group col">
        <label for="bloods">{{trans('parents.Blood_Type_Father_id')}}</label>
        <select id="bloods" class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Father_id">
          <option selected>{{trans('parents.Choose')}}...</option>
          @foreach($Type_Bloods as $Type_Blood)
          <option value="{{$Type_Blood->id}}">{{$Type_Blood->Name}}</option>
          @endforeach
        </select>
        @error('Blood_Type_Father_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group col">
        <label>{{trans('parents.Religion_Father_id')}}</label>
        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Father_id">
          <option selected>{{trans('parents.Choose')}}...</option>
          @foreach($Religions as $Religion)
          <option value="{{$Religion->id}}">{{$Religion->Name}}</option>
          @endforeach
        </select>
        @error('Religion_Father_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>


    <div class="form-group">
      <label for="exampleFormControlTextarea1">{{trans('parents.Address_Father')}}</label>
      <textarea id="exampleFormControlTextarea1" class="form-control" wire:model="Address_Father" rows="4"></textarea>
      @error('Address_Father')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    @if($updateMode)
    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit_edit"
      type="button">{{trans('parents.Next')}}
    </button>
    @else
    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
      type="button">{{trans('parents.Next')}}
    </button>
    @endif

  </div>
</div>