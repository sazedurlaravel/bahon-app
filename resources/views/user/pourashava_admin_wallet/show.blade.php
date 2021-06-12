<x-admin.app-layout>

    <x-slot name="tabTitle"> ডিজিটাল সেন্টার অ্যাডমিন </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> ডিজিটাল সেন্টার অ্যাডমিন </h1>
            </x-slot>
            <a href="{{ url()->previous() }}" class="btn btn-primary"> ফিরে যান </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card">
        <div class="card-body">
            @if (Storage::exists($digitalCenterAdmin->picture))
                <img src="{{ Storage::url($digitalCenterAdmin->picture) }}" class="img img-thumbnail mb-2"
                    style="width: 100px;">
            @endif

            <div class="row">

                <!-- name -->
                <div class="col-md-6 border p-3">
                    নাম: {{ $digitalCenterAdmin->name }}
                </div>

                <!-- email -->
                <div class="col-md-6 border p-3">
                    ই-মেইল: {{ $digitalCenterAdmin->email }}
                </div>

                <!-- mobile -->
                <div class="col-md-12 border p-3">
                    মোবাইল: {{ $digitalCenterAdmin->mobile }}
                </div>

            </div>

            <div class="float-right mt-3">
                <a href="{{ route('admin.digital_center_admins.index') }}" class="btn btn-danger"> ক্যান্সেল </a>
            </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>

</x-admin.app-layout>
