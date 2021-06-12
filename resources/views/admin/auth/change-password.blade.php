<x-admin.app-layout>

    <x-slot name="tabTitle">Change Password</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> পাসওয়ার্ড পরিবর্তন </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <form action="{{ route('admin.change-password.update') }}" method="post">
                @csrf
                
                <div class="form-group">
                    <x-label for="old_password" :require="true"> পুরাতন পাসওয়ার্ড </x-label>
                    <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" placeholder="Old Password" required autofocus>
                    @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <x-label for="new_password" :require="true"> নতুন পাসওয়ার্ড </x-label>
                    <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="New Password" required>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <x-label for="new_password_confirmation" :require="true"> কনফার্ম পাসওয়ার্ড </x-label>
                    <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="Confirm Password" required>
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