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
            {{ Form::model($capital_range, ['route'=>['admin.settings.capital_ranges.update',$capital_range->id],'method'=>'put', 'class'=>'form-horizontal']) }}
            @include('admin.settings.capital_range.form',['buttonText'=>'আপডেট করুন '])

           {{ Form::close() }}

        </div>
        <!-- /.card-body -->
    </div>

    @push('scripts')
        <script> 
       // get business_types by ownnership_id
       $("#ownership_type_id").change(function() {
                let ownership_type_id = $(this).val()
               
                $("#business_type_id").empty()
                $.get(`{{ url('/') }}/json_response/ownership/${ownership_type_id}/business_types`)
                .done(function( data ) {
                    $("#business_type_id").append(`<option value="" disabled selected> ব্যবসার ধরণ নির্বাচন করুন </option>`)
                    $.each(data.business_types, function(key, business_type) {
                        $("#business_type_id").append(`<option value="${business_type.id}"> ${business_type.name} </option>`);
                    })
                })
            })

        </script>
    @endpush


</x-admin.app-layout>