<x-admin.app-layout>

    <x-slot name="tabTitle"> Pourashava </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> পৌরসভা </h1>
            </x-slot>
            <a onclick="pourashava_form('নতুন পৌরসভা', '{{ route('admin.settings.pourashavas.store') }}')" data-toggle="modal" data-target="#pourashavaForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন পৌরসভা </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> নাম </th>
                        <th> জেলা </th>
                        <th> বিভাগ </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pourashavas as $pourashava)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $pourashava->name }} </td>
                            <td> {{ optional($pourashava->zila)->name }} </td>
                            <td> {{ optional($pourashava->zila->division)->name }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" onclick="pourashava_form('এডিট পৌরসভা', '{{ route('admin.settings.pourashavas.update', $pourashava->id) }}', '{{ $pourashava->name }}', '{{ $pourashava->zila_id }}')" data-toggle="modal" data-target="#pourashavaForm" href="#"> এডিট </a>
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

    {{-- pourashava form modal --}}
    <div class="modal fade" id="pourashavaForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="pourashavaFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pourashavaFormLabel">
                        পৌরসভা
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pourashavaFormTag" method="POST">
                        @csrf

                        <div class="form-group">
                            <x-label for="division_id"> বিভাগ </x-label>
                            <select type="text" name="division_id" class="select2_zila form-control" id="division_id" style="width: 100% !important;">
                                <option value="" selected disabled> বিভাগ নির্বাচন করুন </option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}> {{ $division->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="add_zila_fields" class="form-group">
                            <x-label for="zila_id" :require="true"> জেলা </x-label>
                            <select type="text" name="zila_id" class="select2_zila form-control @error('name') is-invalid @enderror" id="zila_id" required style="width: 100% !important;">
                                <option value="" selected disabled> জেলা নির্বাচন করুন </option>
                                @foreach ($zilas as $zila)
                                    <option value="{{ $zila->id }}" {{ old('zila_id') == $zila->id ? 'selected' : '' }}> {{ $zila->name }} </option>
                                @endforeach
                            </select>
                            @error('zila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div id="new_input" class="form-group">
                            <x-label for="pourashava_name" :require="true"> পৌরসভার নাম </x-label>
                            <div class="input-group mb-2">
                                <input type="text" name="names[]" class="form-control @error('names.*') is-invalid @enderror" id="pourashava_name" value="{{ old('names.0') }}" required>
                                <div onclick="add_input('names[]')" class="input-group-append">
                                    <button type="button" class="btn btn-success"><i class="fas fa-plus-square"></i></button>
                                </div>
                                @error('names.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
            // pourashava form manipulate
            function pourashava_form(name, form_url, pourashava_name = null, zila_id = null) {
                $("#pourashavaFormTag").attr("action", form_url)
                $("#pourashavaFormLabel").text(name)
                if(pourashava_name) {
                    // select this zila
                    $("#zila_id").val(zila_id).change()

                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#pourashavaFormTag").prepend(put_method_field)
                    }
                    
                    // pourashava value added in input field
                    $("#pourashava_name").val(pourashava_name)

                } else {
                    if($('#put_method').length) {
                        // put method is exist, remove this field
                        $("#put_method").remove();
                    }
                }
            }

            // select2
            $(document).ready(function() {
                $('.select2_zila').select2({
                    dropdownParent: $('#pourashavaForm'),
                    width: 'resolve'
                });
            });
        </script>
    @endpush

</x-admin.app-layout>