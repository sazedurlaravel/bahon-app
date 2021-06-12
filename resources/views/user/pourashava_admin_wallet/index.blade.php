<x-admin.app-layout>

    <x-slot name="tabTitle">E-Wallet</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1>  ই-ওয়ালেট </h1>
            </x-slot>
            <a onclick="wallet_form(' ই-ওয়ালেট', '{{ route('admin.pourashava_admin_wallets.store') }}')" data-toggle="modal" data-target="#walletForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> রিকুয়েস্ট এড মানি </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        
        <div class="card-body">
            <h3 class="text-center"> টোটাল ব্যালেন্স : {{$wallets->where('status',1)->sum('amount')}} টাকা </h3>
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> টাকার পরিমান </th>
                        <th> তারিখ  </th>
                        <th> স্ট্যাটাস </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($wallets as $wallet)
                    <tr>
                        <td> {{ ++$loop->index }} </td>
                        <td> {{ $wallet->amount }} </td>
                        <td> {{ $wallet->date }} </td>
                        <td> @if ($wallet->status == 0)
                            <a href="#" class="badge badge-warning">Pending</a>
                            @else
                            <a href="#" class="badge badge-success">Success</a>
                            @endif
                        
                        <td>
                            <div class="dropdown">
                                <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-align-left"></i>
                                </a>

                                <div  @if ($wallet->status == 0) class="dropdown-menu dropdown-menu-right"  @endif aria-labelledby="dropdownMenuLink">
                                
                                    {{-- <a onclick="wallet_form(' ই-ওয়ালেট', '{{ route('admin.pourashava_admin_wallets.store') }}')" data-toggle="modal" data-target="#walletForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> এডিট </a> --}}
                               
                                    @if ($wallet->status == 0)
                                    <a class="dropdown-item" onclick="wallet_form('আপডেট ই-ওয়ালেট', '{{ route('admin.pourashava_admin_wallets.update', $wallet->id) }}','{{ $wallet->amount }}')" data-toggle="modal" data-target="#walletForm" href="#"> এডিট </a>
                                    @endif
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

    {{-- modal form --}}
    <div class="modal fade" id="walletForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="walletFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletFormLabel"> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="walletFormTag" method="POST">
                        @csrf
                        <div id="" class="form-group">
                            <x-label for="amount" :require="true"> টাকার পরিমান </x-label>
                            <div class="input-group mb-2">
                                <input type="text" name="amount" class="form-control @error('amount.*') is-invalid @enderror" id="amount" required>
                            
                             @error('amount.*')
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
        
           function wallet_form(name, form_url, amount = null) {
               $("#walletFormTag").attr("action", form_url)
 
                $("#walletFormLabel").text(name)

        
                if(amount) {
                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#walletFormTag").prepend(put_method_field)
                    }
                    
                    // division value added in input field
                    $("#amount").val(amount)

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