<x-admin.app-layout>

    <x-slot name="tabTitle"> Pourashava Admin</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> পৌরসভা অ্যাডমিন </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">

            @if (Request::routeIs('admin.pourashava_admins.create'))
                <form action="{{ route('admin.pourashava_admins.store') }}" method="post"
                    enctype="multipart/form-data">
                @else
                    {{-- @if (Storage::exists($pourashavaAdmin->picture))
                        <img src="{{ Storage::url($pourashavaAdmin->picture) }}" class="img img-thumbnail mb-2"
                            style="width: 100px;">
                    @endif --}}
                    <form action="{{ route('admin.pourashava_admins.update', $pourashavaAdmin) }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
            @endif

            @csrf

            <div class="row">
                <!-- picture -->
                <div class="form-group col-md-6 row">
                    <div class="col-md-10">
                        <x-label for="picture"> প্রোফাইল পিকচার </x-label>
                        <input type='file' name="picture" class="form-control @error('picture') is-invalid @enderror"
                            onchange="poura_admin_image(this);" />

                        @error('picture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="col-md-2 mt-4">
                        @if (Request::routeIs('admin.pourashava_admins.create'))
                            <img id="poura_admin" src="" class="img img-thumbnail mb-2" style="width: 100px;">
                        @else
                            <img id="poura_admin" src="{{ asset('uploads/' . $pourashavaAdmin->picture) }}"
                                class="img img-thumbnail mb-2" style="width: 100px;">
                        @endif
                    </div>
                </div>

                <!-- name -->
                <div class="form-group col-md-6">
                    <x-label for="name" :require="true"> ব্যবহারকারীর নাম </x-label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('name', isset($pourashavaAdmin) ? $pourashavaAdmin->name : '') }}" required
                        autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- email -->
                <div class="form-group col-md-6">
                    <x-label for="email" :require="true"> ই-মেইল </x-label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" value="{{ old('email', isset($pourashavaAdmin) ? $pourashavaAdmin->email : '') }}"
                        required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- mobile -->
                <div class="form-group col-md-6">
                    <x-label for="mobile" :require="true"> মোবাইল </x-label>
                    <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                        id="mobile"
                        value="{{ old('mobile', isset($pourashavaAdmin) ? $pourashavaAdmin->mobile : '') }}" required>
                    @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                @if (Request::routeIs('admin.pourashava_admins.create'))
                    <!-- division -->
                    <div class="form-group col-md-6">
                        <x-label for="division_id"> বিভাগ </x-label>
                        <select name="division_id" class="select2_global form-control" id="division_id"
                            style="width: 100% !important;">
                            <option value="" selected disabled> বিভাগ নির্বাচন করুন </option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ old('division_id', isset($pourashavaAdmin) ? $pourashavaAdmin->division_id : '') == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- zila -->
                    <div class="form-group col-md-6">
                        <x-label for="zila_id"> জেলা </x-label>
                        <select name="zila_id" class="select2_global form-control" id="zila_id"
                            style="width: 100% !important;">
                            <option value="" selected disabled> জেলা নির্বাচন করুন </option>
                            @foreach ($zilas as $zila)
                                <option value="{{ $zila->id }}"
                                    {{ old('zila_id', isset($pourashavaAdmin) ? $pourashavaAdmin->zila_id : '') == $zila->id ? 'selected' : '' }}>
                                    {{ $zila->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- pourashava -->
                    <div class="form-group col-md-6">
                        <x-label for="pourashava_id" :require="true"> পৌরসভা </x-label>
                        <select name="pourashava_id"
                            class="select2_global form-control @error('pourashava_id') is-invalid @enderror"
                            id="pourashava_id" style="width: 100% !important;" required>
                            <option value="" selected disabled> পৌরসভা নির্বাচন করুন </option>
                            @foreach ($pourashavas as $pourashava)
                                <option value="{{ $pourashava->id }}"
                                    {{ old('pourashava_id', isset($pourashavaAdmin) ? $pourashavaAdmin->pourashava_id : '') == $pourashava->id ? 'selected' : '' }}>
                                    {{ $pourashava->name }} </option>
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
                        <input type="number" name="post_code"
                            class="form-control @error('post_code') is-invalid @enderror" id="post_code"
                            value="{{ old('post_code', isset($pourashavaAdmin) ? $pourashavaAdmin->post_code : '') }}"
                            required>
                        @error('post_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- pourashava_url -->
                    <div class="form-group col-md-6">
                        <x-label for="pourashava_url" :require="true"> পৌরসভা URL </x-label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">{{ url('p') }}/</div>
                            </div>
                            <input type="text" name="pourashava_url"
                                class="form-control @error('pourashava_url') is-invalid @enderror" id="pourashava_url"
                                value="{{ old('pourashava_url', isset($pourashavaAdmin) ? $pourashavaAdmin->pourashava_url : '') }}"
                                required>
                            @error('pourashava_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>

                @endif
                <!-- pourashava_name -->
                <div class="form-group col-md-6">
                    <x-label for="pourashava_name" :require="true"> পৌরসভা নাম </x-label>
                    <input type="text" name="pourashava_name" class="form-control @error('pourashava_name') is-invalid @enderror"
                        id="pourashava_name"
                        value="{{ old('pourashava_name', isset($pourashavaAdmin) ? $pourashavaAdmin->pourashava_name : '') }}"
                        required>
                    @error('pourashava_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6 row">
                    <div class="col-md-10">
                        <x-label for="pourashava_logo" :require="true"> পৌরসভা লগো </x-label>

                        <input type='file' name="pourashava_logo"
                            class="form-control @error('pourashava_logo') is-invalid @enderror"
                            onchange="pourashavaLogo(this);" />

                        @error('pourashava_logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror



                    </div>
                    <div class="col-md-2 mt-4">
                        @if (Request::routeIs('admin.pourashava_admins.create'))
                            <img id="poura_logo" src="" alt="" />
                        @else
                            <img id="poura_logo" src="{{ asset('uploads/' . $pourashavaAdmin->pourashava_logo) }}"
                                alt="" />
                        @endif
                    </div>
                </div>

                <!-- admin_account_renew_fee -->
                <div class="form-group col-md-6">
                    <x-label for="admin_account_renew_fee" :require="true"> সফটওয়্যার ব্যবহারের ফি (টাকায়) </x-label>
                    <input type="text" name="admin_account_renew_fee"
                        class="form-control @error('admin_account_renew_fee') is-invalid @enderror"
                        id="admin_account_renew_fee"
                        value="{{ old('admin_account_renew_fee', isset($pourashavaAdmin) ? $pourashavaAdmin->admin_account_renew_fee : '') }}"
                        required>
                    @error('admin_account_renew_fee')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- user_registration_fee -->
                <div class="form-group col-md-6">
                    <x-label for="user_registration_fee" :require="true"> সেবা ব্যবহারকারীর রেজিষ্ট্রেশন ফি (টাকায়)
                    </x-label>
                    <input type="text" name="user_registration_fee"
                        class="form-control @error('user_registration_fee') is-invalid @enderror"
                        id="user_registration_fee"
                        value="{{ old('user_registration_fee', isset($pourashavaAdmin) ? $pourashavaAdmin->user_registration_fee : '') }}"
                        required>
                    @error('user_registration_fee')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- user_account_renew_fee -->
                <div class="form-group col-md-6">
                    <x-label for="user_account_renew_fee" :require="true"> সেবা ব্যবহারকারীর অ্যাকাউন্ট নবায়ন ফি (টাকায়)
                    </x-label>
                    <input type="text" name="user_account_renew_fee"
                        class="form-control @error('user_account_renew_fee') is-invalid @enderror"
                        id="user_account_renew_fee"
                        value="{{ old('user_account_renew_fee', isset($pourashavaAdmin) ? $pourashavaAdmin->user_account_renew_fee : '') }}"
                        required>
                    @error('user_account_renew_fee')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>

            <div class="form-group float-right">
                <a href="{{ route('admin.pourashava_admins.index') }}" class="btn btn-danger"> ক্যান্সেল </a>
                <button type="submit" class="btn btn-info"> <i class="fa fa-save mr-1"></i> সেভ করুন </button>
            </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>

</x-admin.app-layout>
<style>
    img {
        margin-top: 8px;
        max-width: 60px;
        max-height: 40px;
    }

</style>
<script type="text/javascript">
    function pourashavaLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#poura_logo')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


    function poura_admin_image(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#poura_admin')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
