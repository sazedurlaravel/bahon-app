<x-admin.app-layout>

    <x-slot name="tabTitle"> ডিজিটাল সেন্টার অ্যাডমিন </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> ডিজিটাল সেন্টার অ্যাডমিন </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">

            @if (Request::routeIs('admin.digital_center_admins.create'))
                <form action="{{ route('admin.digital_center_admins.store') }}" method="post"
                    enctype="multipart/form-data">
                @else
                    {{-- @if (Storage::exists($digitalCenterAdmin->picture))
                <img src="{{ Storage::url($digitalCenterAdmin->picture) }}" class="img img-thumbnail mb-2" style="width: 100px;">
            @endif --}}
                    <form action="{{ route('admin.digital_center_admins.update', $digitalCenterAdmin) }}"
                        method="post" enctype="multipart/form-data">
                        @method('put')
            @endif

            @csrf

            <div class="row">

                <!-- picture -->
                <div class="form-group col-md-6 row">
                    <div class="col-md-10">
                        <x-label for="picture"> প্রোফাইল পিকচার </x-label>
                        <input type='file' name="picture" class="form-control @error('picture') is-invalid @enderror"
                            onchange="digital_center_admin_image(this);" />

                        @error('picture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="col-md-2 mt-4">
                        @if (Request::routeIs('admin.digital_center_admins.create'))
                            <img id="digital_center_admin" src="" class="img img-thumbnail mb-2" style="width: 100px;">
                        @else
                            <img id="digital_center_admin"
                                src="{{ asset('uploads/' . $digitalCenterAdmin->picture) }}"
                                class="img img-thumbnail mb-2" style="width: 100px;">
                        @endif

                    </div>
                </div>

                <!-- name -->
                <div class="form-group col-md-6">
                    <x-label for="name" :require="true"> ব্যবহারকারীর নাম </x-label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('name', isset($digitalCenterAdmin) ? $digitalCenterAdmin->name : '') }}"
                        required autofocus>
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
                        id="email"
                        value="{{ old('email', isset($digitalCenterAdmin) ? $digitalCenterAdmin->email : '') }}"
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
                        value="{{ old('mobile', isset($digitalCenterAdmin) ? $digitalCenterAdmin->mobile : '') }}"
                        required>
                    @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group float-right">
                <a href="{{ route('admin.digital_center_admins.index') }}" class="btn btn-danger"> ক্যান্সেল </a>
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
    function digital_center_admin_image(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#digital_center_admin')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
