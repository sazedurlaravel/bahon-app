@if (Request::routeIs('admin.information.create'))
    <form action="{{ route('admin.information.store') }}" method="post"
        enctype="multipart/form-data">
    @else
        {{-- @if (Storage::exists($information->logo))
            <img src="{{ Storage::url($information->logo) }}" class="img img-thumbnail mb-2"
                style="width: 25px;">
        @endif --}}
        <form action="{{ route('admin.information.update', $information) }}" method="post"
            enctype="multipart/form-data">
            @method('put')
@endif
      @csrf
    <div class="row">
      <div class="form-group col-md-6 row">
        <div class="col-md-10">
          <x-label for="logo" :require="true"> লগো  </x-label>
          <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo" placeholder="logo" onchange="poura_admin_image(this);" required autofocus>
          @error('logo')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="col-md-2 mt-4">
            @if (Request::routeIs('admin.information.create'))
                <img id="poura_admin" src="" class="img img-thumbnail mb-2" style="width: 100px;">
            @else
                <img id="poura_admin" src="{{ asset('uploads/' . $information->logo) }}"
                    class="img img-thumbnail mb-2" style="width: 100px;">
            @endif
        </div>
      </div>
      <div class="form-group col-md-6">
          <x-label for="name" :require="true"> নাম </x-label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name"    value="{{ old('name', isset($information) ? $information->name : '') }}"  required autofocus>
          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group col-md-6">
          <x-label for="service_email" :require="true"> ই-মেইল </x-label>
          <input type="email" name="service_email" class="form-control @error('service_email') is-invalid @enderror" id="service_email" value="{{ old('name', isset($information) ? $information->service_email : '') }}"  required>
          @error('service_email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group col-md-6">
          <x-label for="service_phone" :require="true"> মোবাইল </x-label>
          <input type="number" name="service_phone" class="form-control @error('service_phone') is-invalid @enderror" id="service_phone" value="{{ old('name', isset($information) ? $information->service_phone : '') }}"  required>
          @error('phone')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group col-md-6 row">
        <div class="col-md-10">
          <x-label for="banner" :require="true"> ব্যানার </x-label>
          <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror" id="banner" placeholder="banner" onchange="banner_image(this);" required autofocus>
          @error('logo')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="col-md-2 mt-4">
            @if (Request::routeIs('admin.information.create'))
                <img id="main_banner" src="" class="img img-thumbnail mb-2" style="width: 100px;">
            @else
                <img id="main_banner" src="{{ asset('uploads/' . $information->banner) }}"
                    class="img img-thumbnail mb-2" style="width: 100px;">
            @endif
        </div>
      </div>
    </div>
    <div class="form-group float-right">
        <a href="{{ route('admin.home') }}" class="btn btn-danger"> ক্যান্সেল </a>
        <button type="submit" class="btn btn-info"> <i class="fa fa-save mr-1"></i> সেভ করুন </button>
    </div>
  </form>
