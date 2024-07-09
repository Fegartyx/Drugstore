@extends('layouts.app')

@section('title', 'Edit Product')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Forms Edit Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Products</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Products</h2>

                <div class="card">
                    <form action="/features/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                       class="form-control @error('name')
                                is-invalid
                            @enderror"
                                       name="name" value="{{ $product->name }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    id="slug" name="slug" readonly required
                                    value="{{ old('slug', $product->slug) }}">
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label>Description</label>
                                <input type="description"
                                       class="form-control @error('description')
                                is-invalid
                            @enderror"
                                       name="description" value="{{ $product->description }}">
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                       class="form-control @error('price')
                                is-invalid
                            @enderror"
                                       name="price" value="{{ $product->price }}">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number"
                                       class="form-control @error('stock')
                                is-invalid
                            @enderror"
                                       name="stock" value="{{ $product->stock }}">
                                @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                    @foreach ($categories as $category)
                                        @if (old('category_id', $product->category_id) == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <label>{{ $product->status }}</label>
                                <label>{{ $product->status == 'available' ? 'available' : 'unavailable' }}</label>
                                <label>{{ $product->status == 'unavailable' ? 'available' : 'unavailable' }}</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="available"
                                        {{ old('status', $product->status == 'available' ? 'selected' : '') }}>
                                        Available
                                    </option>
                                    <option value="unavailable"
                                        {{ old('status', $product->status == 'unavailable' ? 'selected' : '') }}>
                                        Not Available
                                    </option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Input Image</label>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <input
                                    class="form-control @error('image')
                    is-invalid
                @enderror"
                                    onchange="previewImage()" type="file" id="image" name="image">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Release Date</label>
                                <div class="input-group">
                                    <input type="Date"
                                           class="form-control @error('release_date')
                                is-invalid
                            @enderror"
                                           name="release_date"
                                           value="{{ old('release_date', $product->release_date) }}">>
                                </div>
                                @error('release_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Expire Date</label>
                                <div class="input-group">
                                    <input type="date"
                                           class="form-control @error('expire_date')
                                is-invalid
                            @enderror"
                                           name="expire_date" value="{{ old('expire_date', $product->expire_date) }}">>
                                </div>
                                @error('expire_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
