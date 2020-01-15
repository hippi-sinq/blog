@extends('layouts.app')

@section('content')
    <form method="post" action="{{route('edit_category', ['categoryId' => $categories->id])}}">

        @csrf
        <label for="title">Name</label>
        <input type="hidden" name="_token" value="put">
        <input type="text" id="name" name="name" value="{{ $categories->name }}" />
        <input type="submit" value="Save edit category" />
    </form>

@endsection
