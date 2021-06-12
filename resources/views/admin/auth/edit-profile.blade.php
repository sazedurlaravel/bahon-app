<x-admin.app-layout>

    <x-slot name="tabTitle">Profile</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> প্রোফাইল </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <form action="{{ route('admin.profile.update') }}" method="post">
                @csrf
                
                <div class="form-group">
                    <x-label for="name" :require="true"> নাম </x-label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name', Auth::user()->name) }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <x-label for="email" :require="true"> ই-মেইল </x-label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group float-right">
                    <a href="{{ route('admin.home') }}" class="btn btn-danger"> ক্যান্সেল </a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-save mr-1"></i> সেভ করুন </button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>


</x-admin.app-layout>