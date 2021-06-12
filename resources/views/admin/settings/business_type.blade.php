<x-admin.app-layout>

    <x-slot name="tabTitle">Business Type</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> ব্যবসার ধরণ </h1>
            </x-slot>

            <a onclick="modal_form('নতুন ব্যবসার ধরণ', '{{ route('admin.settings.business_types.store') }}')" data-toggle="modal" data-target="#modalForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন ব্যবসার ধরণ </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> মালিকানার  ধরণ </th>
                        <th> ব্যবসার ধরণ </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($business_types as $business_type)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $business_type->ownership_type->name }} </td>
                            <td> {{ $business_type->name }} </td>
                           
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        {{-- <a class="dropdown-item" onclick="zila_form('এডিট জেলা', '{{ route('admin.settings.zilas.update', $zila->id) }}', '{{ $zila->name }}', '{{ $zila->division_id }}')" data-toggle="modal" data-target="#zilaForm" href="#"> এডিট </a> --}}

                                        <a class="dropdown-item" onclick="modal_form('এডিট ব্যবসার ধরণ', '{{ route('admin.settings.business_types.update', $business_type->id) }}', '{{ $business_type->name }}', '{{ $business_type->ownership_types_id }}')" data-toggle="modal" data-target="#modalForm" href="#"> এডিট </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal form  --}}
    <div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">
                    ব্যবসার ধরণ
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modalFormTag" method="POST">
                        @csrf
                        <div class="form-group">
                            <x-label for="ownership_type_id" :require="true"> মালিকানার ধরণ</x-label>
                            <select name="ownership_type_id" class="select2_ownership form-control @error('name') is-invalid @enderror" id="ownership_type_id" required style="width: 100% !important;">
                                <option value="" selected disabled> মালিকানার  ধরণ নির্বাচন করুন</option>
                                @foreach ($ownerships as $ownership)
                                    <option value="{{ $ownership->id }}" {{ old('ownership_type_id') == $ownership->id ? 'selected' : '' }}> {{ $ownership->name }} </option>
                                @endforeach
                            </select>
                            @error('ownership_type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div id="new_input" class="form-group">
                            <x-label for="business_type" :require="true"> নাম </x-label>
                            <div class="input-group mb-2">
                                <div class="input-group mb-2">
                                    <input type="text" name="names[]" class="form-control @error('names.*') is-invalid @enderror" id="business_type" value="{{ old('names.0') }}" required>
                                    <div onclick="add_input('names[]')" class="input-group-append" id="add_input">
                                        <button type="button" class="btn btn-success"><i class="fas fa-plus-square"></i></button>
                                    </div>
                                    @error('names.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="float-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> ক্যান্সেল </button>
                            <button type="submit" class="btn btn-primary"> সেভ করুন </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // form manipulate
            function modal_form(name, form_url, business_type_name = null, ownership_type_id = null) {
                $("#modalFormTag").attr("action", form_url)
                $("#modalFormLabel").text(name)
                if(business_type_name) {
                    $("#add_input").hide()
                    add_input
                     // select this division
                     $("#ownership_type_id").val(ownership_type_id).change()
                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#modalFormTag").prepend(put_method_field)
                    }
                    
                    //  value added in input field
                    $("#business_type").val(business_type_name)

                } else {
                    if($('#put_method').length) {
                        // put method is exist, remove this field
                        $("#put_method").remove();
                    }
                }
            }

              // select2
              $(document).ready(function() {
                $('.select2_ownership').select2({
                    dropdownParent: $('#modalForm'),
                    width: 'resolve'
                });
            });
        </script>
    @endpush

</x-admin.app-layout>