<x-admin.app-layout>

    <x-slot name="tabTitle">village</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> গ্রাম </h1>
            </x-slot>
            <a onclick="village_form('নতুন গ্রাম', '{{ route('admin.settings.villages.store') }}')" data-toggle="modal" data-target="#villageForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন গ্রাম </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">

            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> নাম </th>
                        <th> ওয়ার্ড নাম্বার </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($villages as $village)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $village->name }} </td>
                            <td> {{ $village->wardnumber->number }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" onclick="village_form('এডিট গ্রাম', '{{ route('admin.settings.villages.update', $village->id) }}', '{{ $village->name }}', '{{ $village->wardnumber_id }}')" data-toggle="modal" data-target="#villageForm" href="#"> এডিট </a>
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

    {{-- village form modal --}}
    <div class="modal fade" id="villageForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="villageFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="villageFormLabel">
                        গ্রাম
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="villageFormTag" method="POST">
                        @csrf

                        <div class="form-group">
                            <x-label for="wardnumber_id" :require="true"> ওয়ার্ড নাম্বার </x-label>
                            <select name="wardnumber_id" class="select2_wardnumber form-control @error('name') is-invalid @enderror" id="wardnumber_id" required style="width: 100% !important;">
                                <option value="" selected disabled> ওয়ার্ড নাম্বার নির্বাচন করুন </option>
                                @foreach ($wardnumbers as $wardnumber)
                                    <option value="{{ $wardnumber->id }}" {{ old('wardnumber_id') == $wardnumber->id ? 'selected' : '' }}> {{ $wardnumber->number }} </option>
                                @endforeach
                            </select>
                            @error('wardnumber_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div id="new_input" class="form-group">
                            <x-label for="village_name" :require="true"> গ্রামের নাম </x-label>
                            <div class="input-group mb-2">
                                <input type="text" name="names[]" class="form-control @error('names.*') is-invalid @enderror" id="village_name" value="{{ old('names.0') }}" required>
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
            // village form manipulate
            function village_form(name, form_url, village_name = null, wardnumber_id = null) {
                $("#villageFormTag").attr("action", form_url)
                $("#villageFormLabel").text(name)
                if(village_name) {
                    // select this wardnumber
                    $("#wardnumber_id").val(wardnumber_id).change()

                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#villageFormTag").prepend(put_method_field)
                    }

                    // village value added in input field
                    $("#village_name").val(village_name)

                } else {
                    if($('#put_method').length) {
                        // put method is exist, remove this field
                        $("#put_method").remove();
                    }
                }
            }

            // select2
            $(document).ready(function() {
                $('.select2_wardnumber').select2({
                    dropdownParent: $('#villageForm'),
                    width: 'resolve'
                });
            });
        </script>
    @endpush

</x-admin.app-layout>
