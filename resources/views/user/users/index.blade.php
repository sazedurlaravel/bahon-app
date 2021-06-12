<x-admin.app-layout>

    <x-slot name="tabTitle"> সেবা ব্যবহারকারী </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> সেবা ব্যবহারকারী </h1>
            </x-slot>
            @can('create_user')
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন ব্যবহারকারী </a>
            @endcan
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
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->mobile }} </td>
                            <td> {{ $user->valid_to->format('d-m-Y') }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('admin.users.show', $user) }}"> বিস্তারিত </a>
                                        <a class="dropdown-item" href="{{ route('admin.users.card', $user) }}"> কার্ড </a>
                                        @can('edit_user')
                                            <a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}"> এডিট </a>
                                        @endcan
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