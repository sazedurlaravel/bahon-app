<x-admin.app-layout>

    <x-slot name="tabTitle"> ডিজিটাল সেন্টার অ্যাডমিন </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> ডিজিটাল সেন্টার অ্যাডমিন </h1>
            </x-slot>
            <a href="{{ route('admin.digital_center_admins.create') }}" class="btn btn-primary"> <i
                    class="fas fa-plus mr-1"></i> নতুন ডিজিটাল সেন্টার </a>
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
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($digitalCenterAdmins as $digitalCenterAdmin)
                    <tr>
                        <td> {{ ++$loop->index }} </td>
                        <td> {{ $digitalCenterAdmin->name }} </td>
                        <td> {{ $digitalCenterAdmin->email }} </td>
                        <td> {{ $digitalCenterAdmin->mobile }} </td>
                        <td>
                            <div class="dropdown">
                                <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-align-left"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.digital_center_admins.show', $digitalCenterAdmin) }}">
                                        বিস্তারিত </a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.digital_center_admins.edit', $digitalCenterAdmin) }}">
                                        এডিট </a>
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