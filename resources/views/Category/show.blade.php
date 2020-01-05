{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <p>{{ $category->name }}</p>--}}

{{--    <input type="text" id="name" name="name"/>--}}
{{--    <form method="update" action="{{route('save_edit_category', ['categoryId'=> $category->id])}}">--}}
{{--        @csrf--}}
{{--        {{ method_field('EDIT') }}--}}

{{--    <input type="submit" value="Save edit category"/>--}}
{{--    </form>--}}

{{--@endsection--}}
<form method="update" action="{{route('save_edit_category', ['categoryId'=> $category->id])}}">
    @csrf
    <label for="name">Name</label>

    <input type="text" id="name" name="name"/>

    <input type="submit" value="Save update category"/>
</form>
