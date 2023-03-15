<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <input type="text" id="type_slug" value="Car" hidden>
                <div class="form-group">
                    <label>Name</label>
                    <input id="name" type="text"
                        class="form-control akm-check @error('name')
                        is-invalid
                    @enderror"
                        name="name" value="{{ old('name') ?? $car->name }}">
                    @error('name')
                        <small id="" class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input id="slug" type="text"
                        class="form-control @error('slug')
                    is-invalid
                    @enderror"
                        name="slug" value="{{ old('slug') ?? $car->slug }}">
                    @error('slug')
                        <small id="invalid-slug" class="invalid-feedback">{{ $message }}</small>
                    @enderror
                    <small id="slug_status" class="invalid-feedback" hidden>Slug is Already
                        Exist</small>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="">Brand</label>
                        <select id="brandId"
                            class="form-control akm-check @error('brandId')
                        is-invalid
                    @enderror"
                            name="brandId">
                            @foreach ($data['brand'] as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ Request::old('brandId') || $car->brandId == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brandId')
                            <small id="" class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Year</label>
                        <select id="year"
                            class="form-control akm-check @error('year')
                        is-invalid
                        @enderror"
                            name="year">
                            <option value=""></option>
                            @for ($i = 1950; $i <= $data['years']; $i++)
                                <option value="{{ $i }}"
                                    {{ Request::old('year') || $car->year == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @error('year')
                            <small id="" class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="number"
                        class="form-control akm-check @error('capacity')
                    is-invalid
                    @enderror"
                        name="capacity" value="{{ old('capacity') ?? $car->capacity }}">
                    @error('capacity')
                        <small id="" class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                {{ currency($data['currency'])->getSymbol() }}
                            </div>
                        </div>
                        <input name="price" type="text"
                            class="form-control currency akm-check @error('price')
                        is-invalid
                        @enderror"
                            value="{{ old('price') ?? $car->price }}">
                        @error('price')
                            <small id="" class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <label for="featured-image-input">Featured Image</label>
                <div
                    class="featured-image-backend form-control @error('image')
                is-invalid
                @enderror">
                    <img class="w-100 h-100 featured-image-preview {{ $car['image'] ? 'd-block' : 'd-none' }}"
                        {{ $car['image'] ? 'src=' . asset('/storage/upload/images/' . $car->image) . '' : '' }}
                        alt="">
                </div>
                <input type="file" id="featured-image-input" name="image" class="d-none akm-check"
                    onchange="previewImage()" />
                @error('image')
                    <small id="" class="invalid-feedback">{{ $message }}</small>
                @enderror
                <button type="button" onclick="document.getElementById('featured-image-input').click()"
                    class="btn btn-primary w-100 mt-4">Choose</button>
            </div>
        </div>
    </div>
</div>
