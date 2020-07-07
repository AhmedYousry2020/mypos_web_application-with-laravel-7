@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('site.products')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active"><i class="fa fa-user"></i>@lang('site.products')</li>

            </ol>
        </section>
        <section class="content">
           <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products') <strong>{{$products->count()}}</strong></h3>
                <form action="{{route('dashboard.products.index')}}" method="get">
                    <div class="row">
               <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->input('search')}}">
               </div>
               <div class='col-md-4'>
                         
                         <select name='category_id' class='form-control'>
                        <option value=''>@lang('site.all_categories')</option> 
                         @foreach($categories as $category)
                         <option value='{{$category->id}}' <?php if(request()->input('category_id') == $category->id ) echo 'selected'  ?>>{{$category->name}}</option>
                         @endforeach
                         </select>
                         </div>
              
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i>@lang('site.search')</button>
                            @if(auth()->user()->hasPermission('create_products'))
                            <a href="{{route('dashboard.products.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
                            @else

                            <a href="#" class="btn btn-primary" disabled=""><i class="fa fa-plus"></i>@lang('site.add')</a>
                            @endif
                
                    </div>
                </form>


            </div>
            <div class="box-body">
                  @if($products->count()>0)
                       <table class="table table-bordered table-hover">
                           <thead>
                           <tr>
                               <th>#</th>
                               <th>@lang('site.name')</th>
                               <th>@lang('site.description')</th>
                               <th>@lang('site.category')</th>
                               <th>@lang('site.image')</th>
                               <th>@lang('site.purchase_price')</th>
                               <th>@lang('site.sale_price')</th>
                               <th>@lang('site.stock')</th>
                               <th>@lang('site.profit_percent')%</th>
                               
                               <th>@lang('site.action')</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($products as $index=>$product)
                           <tr>
                               <td>{{$index+1}}</td>
                               <td>{{$product->name}}</td>
                               <td>{!! $product->description !!}</td>
                               <td>{{$product->category->name}}</td>
                              <td><img src="{{$product->image_path}}" alt="" style="width: 90px;" class="img-thumbnail"></td>
                               <td>{{$product->purchase_price}}</td>
                               <td>{{$product->sale_price}}</td>
                               <td>{{$product->stock}}</td>
                               <td>{{$product->profit_percent}}%</td>

                               <td>
                                   @if(auth()->user()->hasPermission('update_products'))
                                       <a href="{{route('dashboard.products.edit',$product->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                   @else
                                       <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                   @endif
                                   @if(auth()->user()->hasPermission('delete_products'))
                                   <form method="post" class="delete" action="{{route('dashboard.products.destroy',$product->id)}}" style="display: inline-block">
                                       @csrf
                                       @method('delete')
                                       <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                                   </form>
                                   @else
                                       <button  class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                                   @endif
                               </td>
                           </tr>

                           @endforeach
                           </tbody>

                       </table>
                       {{$products->appends(request()->query())->links()}}
                   @else
                       <h2>@lang('site.no_data_found')</h2>

                   @endif

               </div>
           </div>
        </section>
    </div>

@endsection
