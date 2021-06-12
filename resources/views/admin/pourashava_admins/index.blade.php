<x-admin.app-layout>

    <x-slot name="tabTitle"> পৌরসভা অ্যাডমিন </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> পৌরসভা অ্যাডমিন </h1>
            </x-slot>
            <a href="{{ route('admin.pourashava_admins.create') }}" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন পৌরসভা অ্যাডমিন </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> নাম </th>
                        <th> ই-মেইল </th>
                        <th> মোবাইল </th>
                        <th> মেয়াদ শেষ </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pourashavaAdmins as $pourashavaAdmin)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $pourashavaAdmin->name }} </td>
                            <td> {{ $pourashavaAdmin->email }} </td>
                            <td> {{ $pourashavaAdmin->mobile }} </td>
                            <td> {{ $pourashavaAdmin->valid_to->format('d-m-Y') }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('admin.pourashava_admins.show', $pourashavaAdmin) }}"> বিস্তারিত </a>
                                        <a class="dropdown-item" href="{{ route('admin.pourashava_admins.edit', $pourashavaAdmin) }}"> এডিট </a>
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