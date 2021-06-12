@if (Request::routeIs('admin.settings.pourashava_information.create'))
    <form action="{{ route('admin.settings.pourashava_information.store') }}" method="post"
        enctype="multipart/form-data">
    @else
        {{-- @if (Storage::exists($information->logo))
            <img src="{{ Storage::url($settings.pourashava_information->logo) }}" class="img img-thumbnail mb-2"
                style="width: 25px;">
        @endif --}}
        <form action="{{route('admin.settings.pourashava_information.store',$information)}}" method="post"
            enctype="multipart/form-data">
            @method('put')
@endif
      @csrf
    <div class="row">
      <div class="form-group col-md-6 row">
        <div class="col-md-10">
          <x-label for="logo" :require="true">লগো  </x-label>
          <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo" placeholder="logo" onchange="poura_admin_image(this);" required autofocus>
          @error('logo')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="col-md-2 mt-4">
            @if (Request::routeIs('admin.settings.pourashava_information.create'))
                <img id="poura_admin" src="" class="img img-thumbnail mb-2" style="width: 100px;">
            @else
                <img id="poura_admin" src="{{ asset('uploads/' . $information->logo) }}"
                    class="img img-thumbnail mb-2" style="width: 100px;">
            @endif
        </div>
      </div>
      <div class="form-group col-md-6">
          <x-label for="name" :require="true"> নাম </x-label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name"  required autofocus>
          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group col-md-6">
          <x-label for="youtube_url" :require="true"> ইউটিউব লিঙ্ক</x-label>
          <input type="text" name="youtube_url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" placeholder="youtube_url"  required>
          @error('youtube_url')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group col-md-6">
          <x-label for="facebook_url" :require="true">  ফেসবুক লিঙ্ক</x-label>
          <input type="text" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" placeholder="facebook_url"  required>
          @error('facebook_url')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
    </div>
    <div class="form-group float-right">
        <a href="{{ route('admin.home') }}" class="btn btn-danger"> ক্যান্সেল </a>
        <button type="submit" class="btn btn-info"> <i class="fa fa-save mr-1"></i> সেভ করুন </button>
    </div>
  </form>
