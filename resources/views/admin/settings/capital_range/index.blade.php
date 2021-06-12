<x-admin.app-layout>

    <x-slot name="tabTitle">ব্যবসার মূলধন পরিসর</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> ব্যবসার মূলধন পরিসর</h1>
            </x-slot>
            @can('create_user')
                <a href="{{ route('admin.settings.capital_ranges.create') }}" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন মূলধন পরিসর</a>
            @endcan
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> মালিকানার ধরণ </th>
                        <th> ব্যবসার ধরণ </th>
                        <th> মূলধন পরিসর </th>
                        <th>  লাইসেন্স ফি </th>
                        <th> অ্যাকশন </th>
                       
                    </tr>
                </thead>

                <tbody>
                    @foreach ($capital_ranges as $capital_range)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            
                            <td> {{ $capital_range->business_type->ownership_type->name }} </td>
                            <td> {{ $capital_range->business_type->name }} </td>
                            <td> {{ $capital_range->capital_range }} </td>
                            <td> {{ $capital_range->licence_fee }} </td>
                        
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                       
                                        <a class="dropdown-item" href="{{ route('admin.settings.capital_ranges.edit', $capital_range->id) }}"> এডিট </a>
                                       
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


</x-admin.app-layout>