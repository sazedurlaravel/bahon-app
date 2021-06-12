<x-admin.app-layout>

    <x-slot name="tabTitle"> সেবা ব্যবহারকারী </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> সেবা ব্যবহারকারী </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">

            @if (Request::routeIs('admin.users.create'))
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
            @else
            @if (Storage::exists($user->picture))
                <img src="{{ Storage::url($user->picture) }}" class="img img-thumbnail mb-2" style="width: 100px;">
            @endif
                <form action="{{ route('admin.users.update', $user) }}" method="post" enctype="multipart/form-data">
                    @method('put')
            @endif

                @csrf

                <div class="row">

                    <!-- picture -->
                    <div class="form-group col-md-6">
                        @if(Request::routeIs('admin.users.create'))
                            <x-label for="picture" :require="true"> প্রোফাইল পিকচার </x-label>
                        @else
                            <x-label for="picture"> প্রোফাইল পিকচার </x-label>
                        @endif
                        <input type="file" name="picture" class="form-control @error('picture') is-invalid @enderror" id="picture" @if(Request::routeIs('admin.users.create')) required @endif>
                        @error('picture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- name -->
                    <div class="form-group col-md-6">
                        <x-label for="name" :require="true"> ব্যবহারকারীর নাম </x-label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', isset($user) ? $user->name : '') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <!-- email -->
                    <div class="form-group col-md-6">
                        <x-label for="email" :require="true"> ই-মেইল </x-label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- mobile -->
                    <div class="form-group col-md-6">
                        <x-label for="mobile" :require="true"> মোবাইল </x-label>
                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile" value="{{ old('mobile', isset($user) ? $user->mobile : '') }}" required>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- father_or_husband_name -->
                    <div class="form-group col-md-6">
                        <x-label for="father_or_husband_name" :require="true"> পিতা/স্বামীর নাম </x-label>
                        <input type="text" name="father_or_husband_name" class="form-control @error('father_or_husband_name') is-invalid @enderror" id="father_or_husband_name" value="{{ old('father_or_husband_name', isset($user) ? $user->father_or_husband_name : '') }}" required>
                        @error('father_or_husband_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- mother_name -->
                    <div class="form-group col-md-6">
                        <x-label for="mother_name" :require="true"> মায়ের নাম </x-label>
                        <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" value="{{ old('mother_name', isset($user) ? $user->mother_name : '') }}" required>
                        @error('mother_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- age -->
                    <div class="form-group col-md-6">
                        <x-label for="age" :require="true"> বয়স </x-label>
                        <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" id="age" value="{{ old('age', isset($user) ? $user->age : '') }}" required>
                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @if (Request::routeIs('admin.users.create'))
                        <!-- birth_day -->
                        <div class="form-group col-md-6">
                            <x-label for="birth_day" :require="true"> জন্ম তারিখ </x-label>
                            <input type="date" name="birth_day" class="form-control @error('birth_day') is-invalid @enderror" id="birth_day" value="{{ old('birth_day', isset($user) ? $user->birth_day : '') }}" required>
                            @error('birth_day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- nid_no -->
                        <div class="form-group col-md-6">
                            <x-label for="nid_no" :require="true"> জাতীয়তা পরিচয়পত্র নং </x-label>
                            <input type="number" name="nid_no" class="form-control @error('nid_no') is-invalid @enderror" id="nid_no" value="{{ old('nid_no', isset($user) ? $user->nid_no : '') }}" required>
                            @error('nid_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- division -->
                        <div class="form-group col-md-6">
                            <x-label for="division_id"> বিভাগ </x-label>
                            <select name="division_id" class="select2_global form-control" id="division_id" style="width: 100% !important;">
                                <option value="" selected disabled> বিভাগ নির্বাচন করুন </option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" {{ old('division_id', isset($user) ? $user->division_id : '') == $division->id ? 'selected' : '' }}> {{ $division->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- zila -->
                        <div class="form-group col-md-6">
                            <x-label for="zila_id"> জেলা </x-label>
                            <select name="zila_id" class="select2_global form-control" id="zila_id" style="width: 100% !important;">
                                <option value="" selected disabled> জেলা নির্বাচন করুন </option>
                                @foreach ($zilas as $zila)
                                    <option value="{{ $zila->id }}" {{ old('zila_id', isset($user) ? $user->zila_id : '') == $zila->id ? 'selected' : '' }}> {{ $zila->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- pourashava -->
                        <div class="form-group col-md-6">
                            <x-label for="pourashava_id" :require="true"> পৌরসভা </x-label>
                            <select name="pourashava_id" class="select2_global form-control @error('pourashava_id') is-invalid @enderror" id="pourashava_id" style="width: 100% !important;" required>
                                <option value="" selected disabled> পৌরসভা নির্বাচন করুন </option>
                                @foreach ($pourashavas as $pourashava)
                                    <option value="{{ $pourashava->id }}" {{ old('pourashava_id', isset($user) ? $user->pourashava_id : '') == $pourashava->id ? 'selected' : '' }}> {{ $pourashava->name }} </option>
                                @endforeach
                            </select>
                            @error('pourashava_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- post_code -->
                        <div class="form-group col-md-6">
                            <x-label for="post_code" :require="true"> পোষ্ট কোড </x-label>
                            <input type="number" name="post_code" class="form-control @error('post_code') is-invalid @enderror" id="post_code" value="{{ old('post_code', isset($user) ? $user->post_code : '') }}" required>
                            @error('post_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- word_no -->
                        <div class="form-group col-md-6">
                            <x-label for="word_no" :require="true"> ওয়ার্ড নং </x-label>
                            <input type="number" name="word_no" class="form-control @error('word_no') is-invalid @enderror" id="word_no" value="{{ old('word_no', isset($user) ? $user->word_no : '') }}" required>
                            @error('word_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- village -->
                        <div class="form-group col-md-6">
                            <x-label for="village" :require="true"> গ্রামের নাম </x-label>
                            <input type="text" name="village" class="form-control @error('village') is-invalid @enderror" id="village" value="{{ old('village', isset($user) ? $user->village : '') }}" required>
                            @error('village')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- permanent_address -->
                        <div class="form-group col-md-6">
                            <x-label for="permanent_address" :require="true"> স্থায়ী ঠিকানা </x-label>
                            <input type="text" name="permanent_address" class="form-control @error('permanent_address') is-invalid @enderror" id="permanent_address" value="{{ old('permanent_address', isset($user) ? $user->permanent_address : '') }}" required>
                            @error('permanent_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- vehicle_type_id -->
                        {{-- <div class="form-group col-md-6">
                            <x-label for="vehicle_type_id" :require="true"> গাড়ীর ধরণ/শ্রেণী </x-label>
                            <select name="vehicle_type_id" class="select2_global form-control @error('vehicle_type_id') is-invalid @enderror" id="vehicle_type_id" style="width: 100% !important;" required>
                                <option value="" selected disabled> গাড়ীর ধরণ/শ্রেণী নির্বাচন করুন </option>
                                @foreach ($vehicleTypes as $vehicleType)
                                    <option value="{{ $vehicleType->id }}" {{ old('vehicle_type_id', isset($user) ? $user->vehicle_type_id : '') == $vehicleType->id ? 'selected' : '' }}> {{ $vehicleType->type . ' - ' . $vehicleType->fee }} টাকা </option>
                                @endforeach
                            </select>
                            @error('vehicle_type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <!-- user_registration_fees -->
                        <div class="col-12 mb-2">
                            <div class="bg-primary p-2 font-weight-bold"> রেজিষ্ট্রেশন ফি </div>
                        </div>

                        <!-- user_registration_fee -->
                        <div class="form-group col-md-6">
                            <x-label for="user_registration_fee" :require="true"> রেজিষ্ট্রেশন ফি (টাকায়) </x-label>
                            <input readonly class="form-control @error('user_registration_fee') is-invalid @enderror" id="user_registration_fee" value="{{ auth()->user()->user_registration_fee }}">
                        </div>

                        <!-- pay_from -->
                        <div class="form-group col-md-6">
                            <x-label for="pay_from" :require="true"> মোবাইল নং (ফি পাঠানো) </x-label>
                            <input type="text" name="pay_from" class="form-control @error('pay_from') is-invalid @enderror" id="pay_from" value="{{ old('pay_from', isset($user) ? $user->pay_from : '') }}" required>
                            @error('pay_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- transaction_id -->
                        <div class="form-group col-md-6">
                            <x-label for="transaction_id" :require="true"> ট্রানজেকশন আইডি </x-label>
                            <input type="text" name="transaction_id" class="form-control @error('transaction_id') is-invalid @enderror" id="transaction_id" value="{{ old('transaction_id', isset($user) ? $user->transaction_id : '') }}" required>
                            @error('transaction_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endif

                </div>

                <div class="form-group float-right">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger"> ক্যান্সেল </a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-save mr-1"></i> সেভ করুন </button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>

</x-admin.app-layout>