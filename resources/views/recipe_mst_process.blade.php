
@extends('recipe_layout')
@section('title')
工程マスタ更新

@endsection
@php
$INGREDIENT_TYPE = [
    1 => 'お菓子',
    2 => 'パン',
    3 => 'サラダ',
    4 => '魚介類',
    5 => '肉料理',
    6 => 'ご飯',
    7 => '麺類',
    8 => 'スープ',
];
@endphp


@section('content')
@foreach($INGREDIENT_TYPE as $index => $mst_process)
<form method="get" id="getindex{{$index}}" class="d-inline">
  <input type="hidden" name="type" value="{{$index}}" form="getindex{{$index}}" >
  @if($type == $index)
  <button formtype="submit" formaction="/mst_processes" class="button btn-success btn-sm">{{$mst_process}}</button>
  @else
  <button formtype="submit" formaction="/mst_processes" class="button btn-secondary btn-sm">{{$mst_process}}</button>
  @endif
</form>
@endforeach

<table class="table">
  <thead class="mb-4">
    <tr>
      <td widtd="60%">工程</td>
    </tr>
    <tr>
      {{-- 登録 --}}
      <form method="post" action="/mst_processes">
        @csrf
        <td><input type="hidden" name="type" value="{{$type}}"><input type="text" name="process" value=""  class="form-control" placeholder='新規登録'> </td>
        <td> <button type="submit" class="button btn-primary btn">新規登録</button> </td>
      </form>
    </td>
    </tr>
  </thead>
  @foreach($mst_processes as $index => $mst_process)
  <tr class="my-5">
    {{-- 更新 --}}
    <form method="post" id="form{{$index}}"  action="/mst_processes/{{$mst_process->id}}">
      @csrf
      @method('PUT')
    <input type="hidden" name="id" value="{{$mst_process->id}}" form="form{{$index}}">
    <input type="hidden" name="type" value="{{$mst_process->type}}" form="form{{$index}}">
    <td><input type="text" name="process" value="{{$mst_process->process}}" form="form{{$index}}" class ="form-control"></td>
    
    <td><button type="submit"  class="button btn-primary btn">更新</button></td>
    </form>

     {{-- 削除 --}}
     <form method="post" id="delete{{$index}}" action="/mst_processes/{{$mst_process->id}}" >@csrf
     @csrf
     @method('delete')
    <td><button type="submit" class="button btn-danger btn">削除</button></td>
    </form>
  </tr>
  @endforeach
</table>



@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>