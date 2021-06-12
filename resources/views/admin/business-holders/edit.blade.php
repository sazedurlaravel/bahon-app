<x-admin.app-layout>

    <x-slot name="tabTitle"> ব্যাবসায়িক সেবা ব্যবহারকারী </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> ব্যাবসায়িক সেবা ব্যবহারকারী </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
           
           {{ Form::model($user, ['route'=>['admin.business_holders.update',$user->id],'method'=>'put', 'class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
           @include('admin.business-holders.form',['buttonText'=>'আপডেট  করুন '])
          {{ Form::close() }}

        </div>
        <!-- /.card-body -->
    </div>

</x-admin.app-layout>