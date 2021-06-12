<x-admin.app-layout>

    <x-slot name="tabTitle"> ব্যবসার মূলধন পরিসর </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> ব্যবসার মূলধন পরিসর </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
             {{ Form::open(['route'=>['admin.settings.capital_ranges.store'],'method'=>'post', 'class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
               @include('admin.settings.capital_range.form',['buttonText'=>'সেভ করুন '])

           {{ Form::close() }}

        </div>
        <!-- /.card-body -->
    </div>

    @push('scripts')
        <script> 
      
        </script>
    @endpush


</x-admin.app-layout>