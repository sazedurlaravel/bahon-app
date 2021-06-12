<x-admin.app-layout>

    <x-slot name="tabTitle">E-Wallet</x-slot>
    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1>  ই-ওয়ালেট </h1>
            </x-slot>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        
        <div class="card-body">
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> ইউজার নাম </th>
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
                        <td> {{ $wallet->user->name}} </td>
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

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                
                                    <a class="dropdown-item"
                                        href="{{ route('admin.pourashava_admin_wallets.approve', $wallet->id) }}">
                                        এ্যাপ্রুভ
 </a>
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

   

    @push('scripts')
        <script>
        
        </script>
    @endpush

</x-admin.app-layout>