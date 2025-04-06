
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
    <button formtype="submit" formaction="/mst_ingredients" class="button btn-success btn-sm">{{$ingredient}}</button>
    @else
    <button formtype="submit" formaction="/mst_ingredients" class="button btn-secondary btn-sm">{{$ingredient}}</button>
    @endif
  </form>
@endforeach

<table class="table">
  <thead>
    <tr>
      <td widtd="40%">材料</td>
      <td widtd="15%">単位</td>
      <td widtd="15%">分量</td>
      <td widtd="15%">費用</td>
    </tr>
    <tr>
      <form method="post">
        <table>
            <tr>
                <td width="40%"><input type="text" name="name" class="form-control"></td>
                <td><input type="hidden" name="type" value="{{ $type }}" class="form-control"></td>
                <td><input type="text" name="unit" class="form-control"></td>
                <td><input type="text" name="amount" class="form-control"></td>
                <td><input type="text" name="cost" class="form-control"></td>
                <td></td>
            </tr>
        </table>
    </form>
    
       {{-- 更新 --}}
    <td><button type="submit" formaction="{{route('mst_ingredients_store')}}" class="button btn-primary btn-sm">登録</button></td>
    </form>
    </tr>
  </thead>
  @foreach($ingredients as $index => $ingredient)
  <tr class="my-0">
  <td width="40%"><input type="text" name="name" value="{{ $ingredient->name }}" class="form-control" form="form{{ $index }}"></td>
  <td><input type="hidden" name="id" value="{{ $ingredient->id }}" form="form{{ $index }}"></td>
  <td><input type="text" name="unit" value="{{ $ingredient->unit }}" class="form-control" form="form{{ $index }}"></td>
  <td><input type="text" name="amount" value="{{ $ingredient->amount }}" class="form-control" form="form{{ $index }}"></td>
  <td><input type="text" name="cost" value="{{ $ingredient->cost }}" class="form-control" form="form{{ $index }}"></td>

    {{-- 削除 --}}
    <form method="post" id="delete{{ $index }}">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <td><button formtype="submit" formaction="{{route('mst_ingredients_delete',['id' => $ingredient->id,'type'=>$type])}}" class="button btn-danger btn-sm">削除</button></td>
    </form>
    {{-- 更新 --}}
    <form method="post" id="form{{ $index }}">
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <td><button type="submit" formaction="/mst_ingredients/{{$ingredient->id}}" class="button btn-primary btn-sm">更新</button></td>
    </form>
  </tr>
  @endforeach
</table>


{{-- <button type="submit"  formaction="{{route('ingredients_store')}}" class="btn-sm btn-primary d-block">送信</button> --}}

  

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>