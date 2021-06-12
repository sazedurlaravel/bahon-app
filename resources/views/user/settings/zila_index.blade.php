<x-admin.app-layout>

    <x-slot name="tabTitle">zila</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> জেলা </h1>
            </x-slot>
            <a onclick="zila_form('নতুন জেলা', '{{ route('admin.settings.zilas.store') }}')" data-toggle="modal" data-target="#zilaForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন জেলা </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> নাম </th>
                        <th> বিভাগ </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($zilas as $zila)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $zila->name }} </td>
                            <td> {{ optional($zila->division)->name }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" onclick="zila_form('এডিট জেলা', '{{ route('admin.settings.zilas.update', $zila->id) }}', '{{ $zila->name }}', '{{ $zila->division_id }}')" data-toggle="modal" data-target="#zilaForm" href="#"> এডিট </a>
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

    {{-- zila form modal --}}
    <div class="modal fade" id="zilaForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="zilaFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="zilaFormLabel">
                        জেলা
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="zilaFormTag" method="POST">
                        @csrf

                        <div class="form-group">
                            <x-label for="division_id" :require="true"> বিভাগ </x-label>
                            <select name="division_id" class="select2_division form-control @error('name') is-invalid @enderror" id="division_id" required style="width: 100% !important;">
                                <option value="" selected disabled> বিভাগ নির্বাচন করুন </option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}> {{ $division->name }} </option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div id="new_input" class="form-group">
                            <x-label for="zila_name" :require="true"> জেলার নাম </x-label>
                            <div class="input-group mb-2">
                                <input type="text" name="names[]" class="form-control @error('names.*') is-invalid @enderror" id="zila_name" value="{{ old('names.0') }}" required>
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
            // zila form manipulate
            function zila_form(name, form_url, zila_name = null, division_id = null) {
                $("#zilaFormTag").attr("action", form_url)
                $("#zilaFormLabel").text(name)
                if(zila_name) {
                    // select this division
                    $("#division_id").val(division_id).change()

                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#zilaFormTag").prepend(put_method_field)
                    }
                    
                    // zila value added in input field
                    $("#zila_name").val(zila_name)

                } else {
                    if($('#put_method').length) {
                        // put method is exist, remove this field
                        $("#put_method").remove();
                    }
                }
            }

            // select2
            $(document).ready(function() {
                $('.select2_division').select2({
                    dropdownParent: $('#zilaForm'),
                    width: 'resolve'
                });
            });
        </script>
    @endpush

</x-admin.app-layout>