<x-admin.app-layout>

    <x-slot name="tabTitle">Ownership Type</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> মালিকানার ধরণ </h1>
            </x-slot>

            <a onclick="modal_form('নতুন মালিকানার ধরণ', '{{ route('admin.settings.ownerships.store') }}')" data-toggle="modal" data-target="#modalForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন মালিকানার ধরণ </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> নাম </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($ownerships as $ownership)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $ownership->name }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" onclick="modal_form('এডিট মালিকানার ধরণ', '{{ route('admin.settings.ownerships.update', $ownership->id) }}', '{{ $ownership->name }}')" data-toggle="modal" data-target="#modalForm" href="#"> এডিট </a>
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
                    মালিকানার ধরণ
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modalFormTag" method="POST">
                        @csrf

                        <div id="new_input" class="form-group">
                            <x-label for="division_name" :require="true"> নাম </x-label>
                            <div class="input-group mb-2">
                                <input type="text" name="names[]" class="form-control @error('names.*') is-invalid @enderror" id="ownership_name" value="{{ old('names.0') }}" required>
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
            // division form manipulate
            function modal_form(name, form_url, ownership_name = null) {
                $("#modalFormTag").attr("action", form_url)
                $("#modalFormLabel").text(name)
                if(ownership_name) {
                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#modalFormTag").prepend(put_method_field)
                    }
                    
                    // division value added in input field
                    $("#ownership_name").val(ownership_name)

                } else {
                    if($('#put_method').length) {
                        // put method is exist, remove this field
                        $("#put_method").remove();
                    }
                }
            }
        </script>
    @endpush

</x-admin.app-layout>