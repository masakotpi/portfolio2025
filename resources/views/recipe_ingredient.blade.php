
@extends('recipe_layout')
@section('title')
レシピ材料登録
@endsection

@section('content')
<form method="post" id="form">
  @csrf

  <div class="float-right">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newIngredientModal">
      材料マスター登録
    </button>
  </div>

  <small>レシピ名</small>
  <input type="text" name="name" value="{{ old('name', 'スコーン') }}" class="form-control form-control-sm mb-3" form="form">

  <input type="hidden" name="type" value="{{ $type }}" class="form-control form-control-sm mb-3" form="form">

  {{ $type }}


@foreach($ingredients as $ingredient)
<button type="button" class="btn-pink ingredient" data="{{$ingredient}}">{{$ingredient->name}}</button>
@endforeach
<button type="button" class="btn-secondary clear">クリア</button>
<table class="table mt-5">
  <thead>
    <tr>
      <td widtd="50%">材料</td>
      <td>分量</td>
      <td>分量選択</td>
      <td></td>
    </tr>
  </thead>
  <tbody class="ingredient_body"></tbody>
</table>


<button type="submit"  formaction="/ingredients" class="btn btn-primary px-4 d-block submit"><b>送信</b></button>
{{-- <button type="submit"  formaction="{{route('ingredients_store')}}" class="btn btn-primary px-4 d-block submit"><b>送信</b></button> --}}
</form>

<!-- 材料登録モーダル -->
<div class="modal fade" id="newIngredientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">材料登録</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <form method="POST" action="/mst_ingredients">
              @csrf
            
              <input type="hidden" name="type" value="{{ $type }}" class="form-control form-control-sm mb-3">
            
              <table>
                <thead>
                  <tr>
                    <th scope="col" width="10%">
                      材料名
                      <small class="text-white badge bg-danger m-3">必須</small>
                    </th>
                    <td>
                      <input type="text" name="name" value="" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <th scope="col" width="10%">
                      単位
                      <small class="text-white badge bg-danger m-3">必須</small>
                    </th>
                    <td>
                      <input type="text" name="unit" value="" class="form-control">
                    </td>
                  </tr>
                </thead>
              </table>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">登録</button>
              </div>
            </form>
            

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/js/recipes.js"></script>