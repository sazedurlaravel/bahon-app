<x-user.app-layout>

    <x-slot name="tabTitle">E-Wallet</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1>  ই-ওয়ালেট ট্রাঞ্জেকশন হিস্টরি </h1>
            </x-slot>
           
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        
        <div class="card-body">
           
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> টাকার পরিমান </th>
                        <th> ট্রাঞ্জেকশন আইডি  </th>
                        <th> সেবা ব্যবহারের নাম</th>
                        <th> তারিখ</th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($userWalletTransactions as $transaction)
                    <tr>
                        <td> {{ ++$loop->index }} </td>
                        <td> {{ $transaction->amount }} </td>
                        <td> {{ $transaction->transaction_id }} </td>
                        <td> {{ $transaction->service_name }} </td>
                        <td> {{ $transaction->created_at }} </td>
                        
                        
                        <td>
                            <div class="dropdown">
                                <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-align-left"></i>
                                </a>

                              
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    
   
   

</x-user.app-layout>