<x-admin.app-layout>

    <x-slot name="tabTitle"> গাড়ীর ধরণ/শ্রেণী </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> গাড়ীর ধরণ/শ্রেণী </h1>
            </x-slot>
            <a href="{{ route('admin.settings.vehicle_types.create') }}" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> নতুন গাড়ীর ধরণ/শ্রেণী </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> সিরিয়াল </th>
                        <th> গাড়ীর ধরণ/শ্রেণী </th>
                        <th> লাইসেন্স নবায়ন ফিস (টাকা) </th>
                        <th> অ্যাকশন </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($vehicleTypes as $vehicleType)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $vehicleType->type }} </td>
                            <td> {{ $vehicleType->fee }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('admin.settings.vehicle_types.edit', $vehicleType) }}"> এডিট </a>
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