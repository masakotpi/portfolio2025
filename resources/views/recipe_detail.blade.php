
@extends('recipe_layout')
@section('title')
レシピ詳細
@php
   $color = [
    1 => ['お菓子','pink' ],
    2 => ['パン','orange' ],
    3 => ['サラダ','green' ],
    4 => ['魚介類','skyblue' ],
    5 => ['肉料理','brown' ],
    6 => ['ご飯','lightyellow' ],
    7 => ['麺類','lightyellow' ],
    8 => ['スープ','lightgreen' ],
];
@endphp

@endsection

@section('content')


<div class="container-fluid">
  <h2 class="text-black">
    {{$recipe->id}}. {{$recipe->name}}
  </h2>
  @if ($recipe->main_image)
    <div style="width: 500px;">
      <img src="/{{$recipe->main_image}}" alt="" width="100%">
    </div>
  @endif
  {{-- 材料テーブル --}}
  <div class="table-responsive">
    <table class="table bg-white">
      <thead>
        <tr>
          <th scope="col">材料</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($recipe->ingredient as $index => $ingredient)
        <tr class="">
          <td width="10%">{{$index+1}}</td>
          <td width="40%">{{$ingredient->mstIngredient->name}}</td>
          <td >
            <input type="text" name="amount[]" value="{{$ingredient->amount}}" class="form-control d-inline w-25">
            <span>{{$ingredient->mstIngredient->unit}}</span>
          </td>
          <td>
            {{-- 材料削除 --}}
            <form method="post" action="/ingredients/delete/{{$ingredient->id}}" id="delete{{$index}}">
              @csrf
              @method('DELETE')
            <td><button type="submit" class="button btn-danger btn-sm">削除</button></td>
            </form>
          </td>
        </tr>
        @endforeach
        <tr class="">
          {{-- 材料登録 --}}
          <form method="post" action="/ingredients"> @csrf
          <td width="10%">@if(isset($index)){{$index+2}} @else 1 @endif</td>
          <td>
            <select name="mst_ingredient_id[]" class="form-control d-inline w-100">
              <option value="">材料を選択してください</option>
              <?php foreach ($mst_ingredient_selector as $value => $label): ?>
                <option value="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($label) ?></option>
              <?php endforeach; ?>
            </select>
            
          </td>
          <td>
            <input type="text" name="amount" value="" class="form-control d-inline w-25">
            <input type="hidden" name="recipe_id" value="{{$recipe->id}}" >
            <input type="hidden" name="type" value="{{$recipe->type}}" >
            <input type="hidden" name="name" value="{{$recipe->name}}" >
          </td>
          <td>
           
            <td><button type="submit" class="button btn-primary btn-sm">新規登録</button></td>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
    {{-- 工程テーブル --}}
    <table class="table bg-white my-5">
      <thead>
        <tr>
          <th scope="col">工程</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($recipe->process as $index => $process)
        <tr class="">
           {{-- 工程新規更新 --}}
          <form method="post" action="/process/{{$process->id}}" id="update{{$process->id}}">
            @csrf
            @method('PUT')
          <td width="10%">{{$index+1}}</td>
          <td><input type="text" name="process" value="{{$process->process}}" class="form-control"></td>
          <td>
            <td><button type="submit" class="button btn-primary btn-sm">更新</button></td>
            </form>
          </td>
          <td>
             {{-- 工程新規削除 --}}
            <form method="post" action="/process/{{$process->id}}" id="delete{{$process->id}}">
              @csrf
              @method('DELETE')
            <td><button type="submit" class="button btn-danger btn-sm">削除</button></td>
            </form>
          </td>
        </tr>
        @endforeach

        
        {{-- 工程新規登録 --}}
        <tr class="">
          <form method="post" action="/recipes/process">  
            @csrf
          <td width="10%">@if(isset($index)){{$index+2}} @else 1 @endif</td>
          <td>
            <input type="text" name="process[]" value="" class="form-control d-inline w-100'">
          </td>
          <input type="hidden" name="recipe_id" value="{{$recipe->id}}">
          <input type="hidden" name="is_return" value="{{true}}">
          <input type="hidden" name="number" value="{{count($recipe->process)+1}}">
          <td>
            <td><button type="submit" class="button btn-primary btn-sm">新規登録</button></td>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
</div>
  

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/js/recipes.js"></script>

