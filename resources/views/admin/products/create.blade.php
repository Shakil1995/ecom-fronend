@extends('layouts.app')

@section('title', 'Create New Product')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12 w-75">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>

            <form method="post" action="{{ config('app.backend_url') }}/api/products" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Create Product</h4>
                    </div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="row">
                                <div class="col-12 alert alert-danger p-1 m-0">
                                    <ul class="g-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="row p-3">
                            <label for="name" class="col-md-2 col-form-label">Name <b class="text-danger">*</b></label>
                            <div class="col-md-10">
                                <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Enter Product name" required autofocus>
                            </div>
                        </div>

                        <div class="row p-3">
                            <label for="category" class="col-md-2 col-form-label">Category <b class="text-danger">*</b></label>
                            <div class="col-md-10">
                                <select class="form-control" name="category_id" required>
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                     

                        <div class="row p-3">
                            <label for="image" class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-10">
                                <input type="file" id="image" class="form-control" value="{{ old('image') }}"
                                    name="image" accept="image/*">
                            </div>
                        </div>

                        <div class="row prices p-3">
                            <label for="price" class="col-md-2 col-form-label">Price</label>
                            <div class="row col-md-10">
                                <div class="col-md-4 col-12 g-0" style="padding-right:5px!important">
                                    <select class="form-select" name="price_type_id[]" id="price_type_id">
                                        <option value="" selected>Select Price Type</option>
                                        @foreach ($priceTypes as $ptype)
                                        <option value="{{ $ptype['id'] }}">{{ $ptype['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-4 g-0" style="padding-right:5px!important">
                                    <input type="number" min="0" class="form-control" name="amount[]" id="amount" placeholder="Price"
                                            value="{{ old('amount[]') }}">
                                </div>

                                <div class="col-12 col-md-4 d-flex align-items-end g-0">
                                    <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus"
                                            aria-hidden="true"></span> Add More</a>
                                </div>

                            </div>
                        </div>


                        <div class="row p-3">
                            <label for="description" class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-10">
                                <textarea type="text" id="description" class="form-control" value="{{ old('description') }}" name="description"
                                    placeholder="Enter Product Details"></textarea>
                            </div>
                        </div>

                   

                        <div class="card-footer float-end">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- For Add New Input Row -->
    <div class="row pricesCopy p-3" style="display: none;">
        <label for="category" class="col-md-2 col-form-label"></label>
        <div class="row col-md-10">
            <div class="col-md-4 col-12 g-0" style="padding-right:5px!important">
                <select class="form-select" name="price_type_id[]" id="price_type_id">
                    <option value="" selected>Select Price Type</option>
                    @foreach ($priceTypes as $ptype)
                    <option value="{{ $ptype['id'] }}">{{ $ptype['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-4 g-0" style="padding-right:5px!important">
                <input type="number" min="0" class="form-control" name="amount[]" id="amount" placeholder="Price"
                        value="{{ old('amount[]') }}">
            </div>

            <div class="col-md-2 col-12 d-flex align-items-end g-0">
                <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove"
                        aria-hidden="true"></span> Remove</a>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Upload Image Preview
        $(document).ready(function (e) {
            //add more fields group
            $(".addMore").click(function(){
                    var fieldHTML='<div class="row prices p-3" style="margin-top:5px!important">'
                    +$(".pricesCopy").html()+'</div>';
                    $('body').find('.prices:last').after(fieldHTML);
                });
            //remove fields group
            $("body").on("click",".remove",function(){
                    $(this).parents(".prices").remove();
                });
        });
    </script>
@endpush