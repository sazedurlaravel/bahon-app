<div class="row">
  
    
        <div class="form-group col-md-4">
            <x-label for="ownership_type_id" :require="true"> মালিকানার ধরণ </x-label>
            {{ Form::select('', $ownership_types, $capital_range ?  $capital_range->business_type ? $capital_range->business_type->ownership_type_id : null :null  ,['class'=>'form-control select2_global','id'=>'ownership_type_id','required','placeholder'=>'মালিকানার ধরণ নির্বাচন করুন'] )}}
            
            @error('ownership_type_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       
        <div class="form-group col-md-4">
            <x-label for="business_type_id" :require="true"> ব্যবসার ধরণ </x-label>
            {{ Form::select('business_type_id', $business_types,null,['class'=>'form-control select2_global','id'=>'business_type_id','required','placeholder'=>'ব্যবসার ধরণ নির্বাচন করুন'] )}}
            
            @error('business_type_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <x-label for="capital_range" :require="true">মূলধন পরিসর </x-label>
            {{ Form::text('capital_range',null,['class'=>'form-control','id'=>'capital_range'] )}}            
            @error('capital_range')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    

        <!-- user_licence_fees -->
        <div class="col-12 mb-2">
            <div class="bg-warning p-2 font-weight-bold"> লাইসেন্স ফি </div>
        </div>

        <!-- license_fees -->
        <div class="form-group col-md-6">
            <x-label for="licence_fee" :require="true"> লাইসেন্স ফি (টাকায়) </x-label>
            {{ Form::number('licence_fee',null,['class'=>'form-control', 'id'=>"licence_fee"] )}}

           
            @error('licence_fee')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="form-group col-md-6">
            <x-label for="business_tax" :require="true"> ব্যবসার কর </x-label>
            {{ Form::number('business_tax',null,['class'=>'form-control', 'id'=>"business_tax"] )}}

            
            @error('business_tax')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <x-label for="signboard_tax" :require="true"> সাইনবোর্ড কর </x-label>
            {{ Form::number('signboard_tax',null,['class'=>'form-control', 'id'=>"signboard_tax"] )}}

           
            @error('signboard_tax')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <!-- service_charge -->
        <div class="form-group col-md-6">
            <x-label for="service_charge"> সার্ভিস ফি </x-label>

            {{ Form::number('service_charge',null,['class'=>'form-control', 'id'=>"service_charge"] )}}
          
            @error('service_charge')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      
      
</div>

<div class="form-group float-right">
    <a href="{{ route('admin.business_holders.index') }}" class="btn btn-danger"> ক্যান্সেল </a>
    <button type="submit" class="btn btn-info"> <i class="fa fa-save mr-1"></i> {{ $buttonText }} </button>
</div>
