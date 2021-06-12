<x-admin.app-layout>

    <x-slot name="tabTitle"> Pourashava Admin</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> পৌরসভা অ্যাডমিন </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card">
        <div class="card-body">
            @if (Storage::exists($pourashavaAdmin->picture))
                <img src="{{ Storage::url($pourashavaAdmin->picture) }}" class="img img-thumbnail mb-2"
                    style="width: 100px;">
            @endif
            <div class="row">
                <!-- name -->
                <div class="col-md-6 border p-3">
                    পৌরসভা নাম: {{ $pourashavaAdmin->pourashava_name }}
                </div>
                <!-- name -->
                <div class="col-md-6 border p-3">
                    পৌরসভা URL: {{ url($pourashavaAdmin->pourashava_url) }}
                </div>
                <!-- name -->
                <div class="col-md-6 border p-3">
                    নাম: {{ $pourashavaAdmin->name }}
                </div>

                <!-- email -->
                <div class="col-md-6 border p-3">
                    ই-মেইল: {{ $pourashavaAdmin->email }}
                </div>

                <!-- mobile -->
                <div class="col-md-6 border p-3">
                    মোবাইল: {{ $pourashavaAdmin->mobile }}
                </div>

            
                <!-- division -->
                <div class="col-md-6 border p-3">
                    বিভাগ: {{ $pourashavaAdmin->pourashava->zila->division->name }}
                </div>

                <!-- zila -->
                <div class="col-md-6 border p-3">
                    জেলা: {{ $pourashavaAdmin->pourashava->zila->name }}
                </div>

                <!-- pourashava -->
                <div class="col-md-6 border p-3">
                    পৌরসভা: {{ $pourashavaAdmin->pourashava->name }}
                </div>

                <!-- post_code -->
                <div class="col-md-6 border p-3">
                    পোষ্ট কোড: {{ $pourashavaAdmin->post_code }}
                </div>

                <!-- admin_account_renew_fee -->
                <div class="col-md-6 border p-3">
                    সফটওয়্যার ব্যবহারের ফি: {{ $pourashavaAdmin->admin_account_renew_fee }} টাকা
                </div>

                <!-- user_registration_fee -->
                <div class="col-md-6 border p-3">
                    সেবা ব্যবহারকারীর রেজিষ্ট্রেশন ফি: {{ $pourashavaAdmin->user_registration_fee }} টাকা
                </div>

                <!-- user_account_renew_fee -->
                <div class="col-md-6 border p-3">
                    সেবা ব্যবহারকারীর অ্যাকাউন্ট নবায়ন ফি: {{ $pourashavaAdmin->user_account_renew_fee }} টাকা
                </div>

                <!-- valid_to -->
                <div class="col-md-12 border p-3">
                    মেয়াদ শেষ: {{ $pourashavaAdmin->valid_to->format('d-m-Y') }}
                </div>

            </div>

            <div class="float-right mt-3">
                <a href="{{ route('admin.pourashava_admins.index') }}" class="btn btn-danger"> ক্যান্সেল </a>
            </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>

</x-admin.app-layout>
