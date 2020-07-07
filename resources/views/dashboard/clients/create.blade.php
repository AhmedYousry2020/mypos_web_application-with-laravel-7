@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('site.clients')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.users.index')}}">@lang('site.clients')</a></li>
                <li class="active">@lang('site.add')</li>

            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div>
                <div class="box-body">
                @include('partials._errors')
                     <form action="{{route('dashboard.clients.store')}}" method="post">
                         @csrf
                         @method('post')
                         <div class='form-group'>
                         <label>@lang('site.name')</label>
                         <input class='form-control' type='text' name='name' value ="{{ old('name') }}">
                         </div>
                        
                         @for ($i=1;$i<=2;$i++)
                         <div class='form-group'>
                         <label>@lang('site.phone')</label>
                         <input class='form-control' type='text' name='phone[]' value="{{old('phone[$i]')}}">
                         </div>
                         @endfor
                         <div class='form-group'>
                         <label>@lang('site.address')</label>
                         <textarea class='form-control'  name='address'>{{ old('address') }}</textarea>
                         </div>
                         <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
                        </div>
                        </form>
                </div>

            </div>
        </section>
    </div>

@endsection
