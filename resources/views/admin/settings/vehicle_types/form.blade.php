<x-admin.app-layout>

    <x-slot name="tabTitle"> গাড়ীর ধরণ/শ্রেণী </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> গাড়ীর ধরণ/শ্রেণী </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">

            @if (Request::routeIs('admin.settings.vehicle_types.create'))
                <form action="{{ route('admin.settings.vehicle_types.store') }}" method="post">
            @else
                <form action="{{ route('admin.settings.vehicle_types.update', $vehicleType) }}" method="post">
                    @method('put')
            @endif

                @csrf

                <div class="row">

                    <!-- type -->
                    <div class="form-group col-md-6">
                        <x-label for="type" :require="true"> গাড়ীর ধরণ/শ্রেণী </x-label>
                        <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" id="type" value="{{ old('type', isset($vehicleType) ? $vehicleType->type : '') }}" required autofocus>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <!-- fee -->
                    <div class="form-group col-md-6">
                        <x-label for="fee" :require="true"> লাইসেন্স নবায়ন ফিস (টাকা) </x-label>
                        <input type="text" name="fee" class="form-control @error('fee') is-invalid @enderror" id="fee" value="{{ old('fee', isset($vehicleType) ? $vehicleType->fee : '') }}" required>
                        @error('fee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="form-group float-right">
                    <a href="{{ route('admin.settings.vehicle_types.index') }}" class="btn btn-danger"> ক্যান্সেল </a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-save mr-1"></i> সেভ করুন </button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>

</x-admin.app-layout>