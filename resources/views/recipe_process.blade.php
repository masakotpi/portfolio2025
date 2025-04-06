
@extends('recipe_layout')
@section('title')
レシピ工程登録：{{$recipe->name}}
@endsection

@section('content')

<form method="POST" id="form" action="{{ route('process_store') }}">
  @csrf

  <div class="float-right">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newIngredientModal">工程登録</button>
  </div>

  <input type="hidden" name="recipe_id" value="{{ $id }}" class="form-control form-control-sm mb-3">

  <div class="process_ing"></div>
  <button type="button" class="btn-success process"></button>

  {{-- 材料 --}}
  <div class="my-2">
    @foreach($recipe['ingredient'] as $ingredient)
      <button type="button" class="btn-pink process_ing" data="ingredient">{{ $ingredient->name }}</button>
    @endforeach
  </div>

  {{-- 工程 --}}
  <div class="my-2">
    @foreach($recipe['process'] as $process)
      <button type="button" class="btn-primary process" data="process">{{ $process }}</button>
    @endforeach
  </div>

  <div class="my-2">
    <button type="button" class="btn-secondary process_ing">、</button>
    <button type="button" class="btn-secondary process">\n</button>


@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>