@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('site.products')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.users.index')}}">@lang('site.products')</a></li>
                <li class="active">@lang('site.edit')</li>

            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div>
                <div class="box-body">
                @include('partials._errors')
                     <form action="{{route('dashboard.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                         @csrf
                         @method('PUT')
                         <div class='form-group'>
                         <label>@lang('site.categories')</label>
                         <select name='category_id' class='form-control'>
                        <option value=''>@lang('site.all_categories')</option> 
                         @foreach($categories as $category)
                         <option value='{{$category->id}}' <?php if($product->category_id == $category->id) echo "selected" ?>>{{$category->name}}</option>
                         @endforeach
                         </select>
                         </div>

                         @foreach(config('translatable.locales') as $locale)
                         <div class="form-group">
                         <!-- site.ar.name-->
                             <label> @lang('site.'.$locale.'.name')</label>
                         <!--ar[name] -->
                             <input class="form-control" type="text" name="{{$locale}}[name]" value="{{$product->translate($locale)->name}}" >
                         </div>

                         <div class="form-group">
                         <!-- site.ar.description-->
                             <label> @lang('site.'.$locale.'.description')</label>
                         <!--ar[name] -->
                             <textarea class="form-control ckeditor"  name="{{$locale}}[description]" >{{$product->translate($locale)->description}}</textarea>
                         </div>
                         @endforeach
                      
                         <div class="form-group">
                             <label> @lang('site.image')</label>
                             <input class="form-control image" type="file" name="image">
                         </div>

                         <div class="form-group">

                            <img src="{{$product->image_path}}" style="width:100px" class="img-thumbnail image-preview" alt="">
                         </div>
                         <div class="form-group">
                             <label> @lang('site.purchase_price')</label>
                             <input class="form-control" type="number" name="purchase_price" value="{{$product->purchase_price}}">
                         </div>
                         <div class="form-group">
                             <label> @lang('site.sale_price')</label>
                             <input class="form-control" type="number" step="0.01" name="sale_price" value="{{$product->sale_price}}">
                         </div>
                         <div class="form-group">
                             <label> @lang('site.stock')</label>
                             <input class="form-control" type="number" name="stock" value="{{$product->stock}}">
                         </div>

                      

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>@lang('site.edit')</button>
                        </div>
                    </form>

                </div>

            </div>
        </section>
    </div>

@endsection
