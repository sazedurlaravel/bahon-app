<div class="row">
    @if (auth()->user()->hasRole('pourashava_admin'))
        <div class="col-12 mb-2">
            <div class="bg-primary p-2 font-weight-bold"> ব্যাক্তিগত তথ্য </div>
        </div>
        <!-- picture -->
        <div class="form-group col-md-6">
            @if (Request::routeIs('admin.business_holders.create'))
                <x-label for="picture" :require="true"> প্রোফাইল পিকচার </x-label>
            @else
                <x-label for="picture"> প্রোফাইল পিকচার </x-label>
            @endif
            <input type="file" name="picture" class="form-control @error('picture') is-invalid @enderror" id="picture">
            @error('picture')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- name -->
        <div class="form-group col-md-6">
            <x-label for="name" :require="true"> ব্যবহারকারীর নাম </x-label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                value="{{ old('name', isset($user) ? $user->name : '') }}" required autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- email -->
        <div class="form-group col-md-6">
            <x-label for="email" :require="true"> ই-মেইল </x-label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                value="{{ old('email', isset($user) ? $user->email : '') }}" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- mobile -->
        <div class="form-group col-md-6">
            <x-label for="mobile" :require="true"> মোবাইল </x-label>
            <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                value="{{ old('mobile', isset($user) ? $user->mobile : '') }}" required>
            @error('mobile')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- father_or_husband_name -->
        <div class="form-group col-md-6">
            <x-label for="father_or_husband_name" :require="true"> পিতা/স্বামীর নাম </x-label>
            <input type="text" name="father_or_husband_name"
                class="form-control @error('father_or_husband_name') is-invalid @enderror" id="father_or_husband_name"
                value="{{ old('father_or_husband_name', isset($user) ? $user->father_or_husband_name : '') }}"
                required>
            @error('father_or_husband_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- mother_name -->
        <div class="form-group col-md-6">
            <x-label for="mother_name" :require="true"> মায়ের নাম </x-label>
            <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror"
                id="mother_name" value="{{ old('mother_name', isset($user) ? $user->mother_name : '') }}" required>
            @error('mother_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- age -->
        <div class="form-group col-md-6">
            <x-label for="age" :require="true"> বয়স </x-label>
            <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" id="age"
                value="{{ old('age', isset($user) ? $user->age : '') }}" required>
            @error('age')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- genger -->
        <div class="form-group col-md-6">
            <x-label for="age" :require="true"> লিঙ্গ</x-label>
            <br>
            {{ Form::radio('gender', 'Male', true) }}
            {{ Form::label('male', 'Male', ['class' => '']) }}
            {{ Form::radio('gender', 'Female', false) }}
            {{ Form::label('female', 'Female', ['class' => '']) }}
            {{ Form::radio('gender', 'Other', false) }}
            {{ Form::label('other', 'Other', ['class' => '']) }}
            @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- @if (Request::routeIs('admin.business_holders.create')) --}}
        <!-- birth_day -->
        <div class="form-group col-md-6">
            <x-label for="birth_day" :require="true"> জন্ম তারিখ </x-label>
            <input type="date" name="birth_day" class="form-control @error('birth_day') is-invalid @enderror"
                id="birth_day" value="{{ old('birth_day', isset($user) ? $user->birth_day : '') }}" required>
            @error('birth_day')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- nid_no -->
        <div class="form-group col-md-6">
            <x-label for="nid_no" :require="true"> জাতীয়তা পরিচয়পত্র নং </x-label>
            <input type="number" name="nid_no" class="form-control @error('nid_no') is-invalid @enderror" id="nid_no"
                value="{{ old('nid_no', isset($user) ? $user->nid_no : '') }}" required>
            @error('nid_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <x-label for="ward_id"> ওয়ার্ড নং </x-label>

            {{ Form::select('ward_id', $wards, null, ['class' => 'form-control select2_global ', 'style' => 'width:100% !important', 'required', 'id' => 'ward_id', 'placeholder' => 'ওয়ার্ড নং নির্বাচন করুন']) }}

            @error('ward_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <!-- village -->
        <div class="form-group col-md-6">
            <x-label for="village" :require="true"> গ্রামের নাম </x-label>
            {{ Form::select('village_id', $villages, null, ['class' => 'form-control select2_global ', 'style' => 'width:100% !important', 'required', 'id' => 'village_id', 'placeholder' => 'গ্রামের নাম নির্বাচন করুন']) }}

            @error('village_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>




        <!-- permanent_address -->
        <div class="form-group col-md-6">
            <x-label for="permanent_address" :require="true"> স্থায়ী ঠিকানা </x-label>
            {{ Form::textarea('permanent_address', null, ['class' => 'form-control', 'rows' => 2]) }}
            @error('permanent_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- present_address -->
        <div class="form-group col-md-6">
            <x-label for="present_address" :require="true"> বর্তমান ঠিকানা </x-label>
            {{ Form::textarea('present_address', null, ['class' => 'form-control', 'rows' => 2]) }}

            @error('present_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- user_registration_fees -->
        <div class="col-12 mb-2">
            <div class="bg-success p-2 font-weight-bold"> ব্যাবসায়িক তথ্য </div>
        </div>
        <div class="form-group col-md-6">
            <x-label for="bussiness_name" :require="true"> ব্যাবসায়িক নাম </x-label>
            {{ Form::text('business_name', $user->businessHolderUser ? $user->businessHolderUser->business_address : null, ['class' => 'form-control', 'required']) }}
            @error('bussiness_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <x-label for="business_address" :require="true"> ব্যাবসায়িক ঠিকানা </x-label>
            {{ Form::text('business_address', $user->businessHolderUser ? $user->businessHolderUser->business_address : null, ['class' => 'form-control', 'placeholder' => 'ব্যাবসায়িক ঠিকানা']) }}
            @error('business_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <x-label for="business_tin_no" :require="true"> ব্যাবসায়িক টিন নং </x-label>
            {{ Form::number('business_tin_no', null, ['class' => 'form-control', 'required']) }}
            @error('business_tin_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <x-label for="owner_tin_no" :require="true"> ঔনার টিন নং </x-label>
            {{ Form::number('owner_tin_no', null, ['class' => 'form-control', 'required']) }}
            @error('owner_tin_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <x-label for="ownership_type" :require="true"> ঔনারশিপ ধরণ </x-label>
            <select name="ownership_type"
                class="select2_global form-control @error('ownership_type') is-invalid @enderror" id="ownership_type"
                style="width: 100% !important;" required>
                <option value="" selected disabled> ঔনারশিপ ধরণ/শ্রেণী নির্বাচন করুন </option>

                <option value="ধরণ ১">ধরণ ১</option>
                <option value="ধরণ ২">ধরণ ২</option>

            </select>

            @error('ownership_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <x-label for="business_type" :require="true"> ব্যাবসায়িক ধরণ </x-label>
            <select name="business_type"
                class="select2_global form-control @error('business_type') is-invalid @enderror" id="business_type"
                style="width: 100% !important;" required>
                <option value="" selected disabled> ব্যাবসায়িক ধরণ/শ্রেণী নির্বাচন করুন </option>

                <option value="ধরণ ১">ধরণ ১</option>
                <option value="ধরণ ২">ধরণ ২</option>

            </select>
            @error('business_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <x-label for="business_capital" :require="true"> ব্যাবসায়িক মূলধন </x-label>
            {{ Form::number('business_capital', null, ['class' => 'form-control', 'required']) }}
            @error('business_capital')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <x-label for="last_license_issued" :require="true"> সর্বশেষ লাইসেন্স ইস্যু </x-label>
            {!! Form::selectYear('last_license_issued', 2010, 2030, null, ['class' => 'form-control select2_global', 'style' => 'width:100% !important', 'required', 'placeholder' => 'বছর নির্বাচন করুন']) !!}
            @error('last_license_issued')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



        <!-- user_registration_fees -->
        <div class="col-12 mb-2">
            <div class="bg-warning p-2 font-weight-bold"> লাইসেন্স ফি </div>
        </div>

        <!-- license_fees -->
        <div class="form-group col-md-6">
            <x-label for="license_fees" :require="true"> লাইসেন্স ফি (টাকায়) </x-label>
            <input type="number" name="license_fees" class="form-control @error('license_fees') is-invalid @enderror"
                id="license_fees" value="">
            @error('license_fees')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <x-label for="singboard_tax" :require="true"> সাইনবোর্ড টেক্স </x-label>
            <input type="number" name="singboard_tax" class="form-control @error('singboard_tax') is-invalid @enderror"
                id="singboard_tax" value="">
            @error('singboard_tax')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- service_charge -->
        <div class="form-group col-md-6">
            <x-label for="service_charge" :require="true"> সার্ভিস ফি </x-label>
            <input type="number" name="service_charge"
                class="form-control @error('service_charge') is-invalid @enderror" id="due"
                value="{{ old('pay_from', isset($user) ? $user->pay_from : '') }}" required>
            @error('service_charge')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- due -->
        <div class="form-group col-md-6">
            <x-label for="pay_from">বকেয়া </x-label>
            <input type="number" name="due" class="form-control @error('due') is-invalid @enderror" id="due"
                value="{{ old('pay_from', isset($user) ? $user->pay_from : '') }}" required>
            @error('due')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



        <!-- others_charge -->
        <div class="form-group col-md-6">
            <x-label for="others_charge"> অন্যান্য ফি </x-label>
            <input type="number" name="others_charge" class="form-control @error('others_charge') is-invalid @enderror"
                id="due" value="{{ old('pay_from', isset($user) ? $user->pay_from : '') }}" required>
            @error('others_charge')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- @endif --}}
    @endif
    @if (auth()->user()->hasRole('super_admin'))
        <div class="form-group col-md-6">
            <x-label for="card_no" :require="true"> কার্ড নং </x-label>
            {{ Form::number('card_no', null, ['class' => 'form-control', 'required']) }}
            @error('card_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group col-md-6">
            <x-label for="pin_no" :require="true"> পিন নং </x-label>
            {{ Form::number('pin_no', null, ['class' => 'form-control', 'required']) }}
            @error('pin_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


    @endif

</div>

<div class="form-group float-right">
    <a href="{{ route('admin.business_holders.index') }}" class="btn btn-danger"> ক্যান্সেল </a>
    <button type="submit" class="btn btn-info"> <i class="fa fa-save mr-1"></i> {{ $buttonText }} </button>
</div>
