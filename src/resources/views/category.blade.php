@extends('layouts.add')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
    @if(session('message'))
    <div class="category__alert--success">
        {{session('message')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="category__alert--danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="category__content">
    <form action="/categories" method="post" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" name="name" value="{{ old('name') }}"  class="create-form__item-input">
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">category</th>
            </tr>
            @foreach( $categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    <form action="/categories/update" method="post"  class="update-form">
                        @method('patch')
                        @csrf
                        <div class="update-form__item">
                            <input type="text" class="update-form__item-input" name="name" value=" {{ $category->name }}">
                            <input type="hidden" value="{{ $category->id }}" name="id">
                        </div>
                        <div class="update-form__button">
                            <button type="submit" class="update-form__button-submit">更新</button>
                        </div>
                    </form>
                </td>  
                <td class="category-table__item">
                    <form action="categories/delete" method="post"  class="delete-form">
                        @method('delete')
                        @csrf
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                            <input type="hidden" value=" {{ $category->id }}" name="id"/>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection