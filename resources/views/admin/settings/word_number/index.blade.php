<x-admin.app-layout>

    <x-slot name="tabTitle">Ward Number</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> ওয়ার্ড </h1>
            </x-slot>
            <a onclick="wardnumber_form('নতুন ওয়ার্ড', '{{ route('admin.settings.wardnumbers.store') }}')" data-toggle="modal" data-target="#wardnumberForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন ওয়ার্ড </a>
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
                    @foreach ($wardnumbers as $wardnumber)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $wardnumber->number }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" onclick="wardnumber_form('এডিট ওয়ার্ড', '{{ route('admin.settings.wardnumbers.update', $wardnumber->id) }}', '{{ $wardnumber->number }}')" data-toggle="modal" data-target="#wardnumberForm" href="#"> এডিট </a>
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

    {{-- wardnumber form modal --}}
    <div class="modal fade" id="wardnumberForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="wardnumberFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wardnumberFormLabel">
                        ওয়ার্ড
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="wardnumberFormTag" method="POST">
                        @csrf

                        <div id="new_input" class="form-group">
                            <x-label for="wardnumber_number" :require="true"> নাম </x-label>
                            <div class="input-group mb-2">
                                <input type="number" name="numbers[]" class="form-control @error('numbers.*') is-invalid @enderror" id="wardnumber_number" value="{{ old('names.0') }}" required>
                                <div onclick="add_input('numbers[]')" class="input-group-append">
                                  <button type="button" class="btn btn-success"><i class="fas fa-plus-square"></i></button>
                                </div>
                                @error('numbers.*')
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
            // wardnumber form manipulate
            function wardnumber_form(number, form_url, wardnumber_number = null) {
                $("#wardnumberFormTag").attr("action", form_url)
                $("#wardnumberFormLabel").text(number)
                if(wardnumber_number) {
                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#wardnumberFormTag").prepend(put_method_field)
                    }

                    // wardnumber value added in input field
                    $("#wardnumber_number").val(wardnumber_number)
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
