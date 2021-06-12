<x-admin.app-layout>

    <x-slot name="tabTitle">পৌরসভা তথ্য</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> পৌরসভা তথ্য</h1>
            </x-slot>

                  <a href="{{ route('admin.information.create') }}" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i>নতুন পৌরসভা তথ্য </a>

        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">

            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> নাম </th>
                        <th> মোবাইল </th>
                        <th> ই-মেইল </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($informations as $information)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $information->name }} </td>
                            <td> {{ $information->service_email }} </td>
                            <td> {{ $information->service_phone }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        @if (auth()->user()->hasRole('super_admin'))
                                        <a class="dropdown-item" href="{{ route('admin.information.edit', $information->id) }}"> এডিট </a>
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


</x-admin.app-layout>
