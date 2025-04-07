
@extends('recipe_layout')
@section('title')
材料マスター更新
@endsection
@php
 const INGREDIENT_TYPE = [
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
  @foreach(INGREDIENT_TYPE as $index => $ingredient)
  <form method="get" id="getindex{{ $index }}" class="d-inline">
    <input type="hidden" name="type" value="{{ $index }}" form="getindex{{ $index }}">
    @if($type == $index)
    <button formtype="submit" formaction="/mst_ingredients" class="button btn-success btn">{{$ingredient}}</button>
    @else
    <button formtype="submit" formaction="/mst_ingredients" class="button btn-secondary btn">{{$ingredient}}</button>
    @endif
  </form>
@endforeach

<table class="table" style="margin-top:30px;" border="1" align="center">
  <thead>
    <tr>
      <td width="40%" border="1">材料</td>
      <td border="1">単位</td>
      <td border="1">分量</td>
      <td border="1">費用</td>
    </tr>
  </thead>
    <tr>
      <form method="post" action="/mst_ingredients">
        @csrf
     
            <tr>
              <input type="hidden" name="type" value="{{ $type }}" class="form-control">
                <td width="40%"><input type="text" name="name" class="form-control" placeholder="小麦粉"></td>
                <td><input type="text" name="unit" class="form-control" placeholder="g"></td>
                <td><input type="text" name="amount" class="form-control" placeholder="1kg"></td>
                <td><input type="text" name="cost" class="form-control" placeholder="300円"></td>
                <td><button type="submit" class="button btn-primary btn">登録</button></td>
                <td></td>
            </tr>
        {{-- 登録 --}}
    </form>
    
    </tr>
</table>
<table class="table" style="margin-top:30px;" border="1" align="center">
  @foreach($ingredients as $index => $ingredient)
  <tr class="my-0">
  <input type="hidden" name="id" value="{{ $ingredient->id }}" form="form{{ $index }}">
  <td width="40%"><input type="text" name="name" value="{{ $ingredient->name }}" class="form-control" form="form{{ $index }}"></td>
  <td><input type="text" name="unit" value="{{ $ingredient->unit }}" class="form-control" form="form{{ $index }}"></td>
  <td><input type="text" name="amount" value="{{ $ingredient->amount }}" class="form-control" form="form{{ $index }}"></td>
  <td><input type="text" name="cost" value="{{ $ingredient->cost }}" class="form-control" form="form{{ $index }}"></td>

    {{-- 削除 --}}
    <form method="post" id="delete{{ $index }}" action="/mst_ingredients/{{$ingredient->id}}/{{$type}}">
      @csrf
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id" value="{{$ingredient->id}}">
      <input type="hidden" name="type" value="{{$type}}">
      <td><button type="submit" class="button btn-danger btn">削除</button></td>
  </form>
    {{-- 更新 --}}
    <form method="PUT" id="form{{ $index }}">
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <td><button type="submit" formaction="/mst_ingredients/{{$ingredient->id}}" class="button btn-primary btn">更新</button></td>
    </form>
  </tr>
  @endforeach
</table>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>

<style>
  table {
    border-collapse: collapse; /* 枠が重ならないようにする */
  }
  td {
    padding: 10px;
    border: 1px solid #ccc;
  }
</style>