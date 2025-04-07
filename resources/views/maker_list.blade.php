@extends('layout')

@section('title')
メーカ一覧
@endsection


@section('content')


<table class="table">
    <thead>

      <tr>
        <th scope="col"></th>
        <th scope="col">新規</th>
        <th scope="col" width="30%">メーカー名</th>
        <th scope="col" width="15%">メーカー所在国</th>
        <th scope="col" width="15%">担当者</th>
        <th scope="col" width="15%">TEL</th>
        <th scope="col">住所</th>
        <tr>
      </tr>
    </thead>
    <tbody>
      <form method="POST" action="/makers/new" id="new">
        @csrf
        <tr>
          <td></td>
          <td>新規</td>
          <td><input type="text" name="name" class="form-control"></td>
          <td><input type="text" name="country" class="form-control"></td>
          <td><input type="text" name="person_in_charge" class="form-control"></td>
          <td><input type="text" name="tel" class="form-control"></td>
          <td><input type="text" name="address" class="form-control"></td>
          <td>
            <button type="submit" class="btn btn-primary btn-sm">新規</button>
          </td>
        </tr>
      </form>
      
  </tbody>
</table>


<table class="table">
    <thead>

      <tr>
        <th scope="col"><input type="checkbox" id="bulk-check-action"></th>

        <th scope="col">ID</th>
        <th scope="col" width="30%">メーカー名</th>
        <th scope="col" width="15%">メーカー所在国</th>
        <th scope="col" width="15%">担当者</th>
        <th scope="col" width="15%">TEL</th>
        <th scope="col">住所</th>
        <tr>
      </tr>
    </thead>
    <tbody>
      <!-- 削除用フォーム -->
<form method="POST" action="{{ route('maker_delete') }}" id="delete">
  @csrf
  @method('DELETE')

  @foreach($makers as $maker)
    <tr>
      <td>
        <input type="checkbox" name="maker_ids[]" value="{{ $maker->id }}" class="each_ids" form="delete">
      </td>
      <td>{{ $maker->id }}</td>
</form>

    <!-- 更新用フォーム（各メーカーごとに1つずつ） -->
    <form method="POST" action="/makers/{{$maker->id}}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" value="{{ $maker->id }}">

      <td><input type="text" name="name" value="{{ $maker->name }}" class="form-control"></td>
      <td><input type="text" name="country" value="{{ $maker->country }}" class="form-control"></td>
      <td><input type="text" name="person_in_charge" value="{{ $maker->person_in_charge }}" class="form-control"></td>
      <td><input type="text" name="tel" value="{{ $maker->tel }}" class="form-control"></td>
      <td><input type="text" name="address" value="{{ $maker->address }}" class="form-control"></td>

      <td>
        <button type="submit" class="btn-sm btn-primary">更新</button>
      </td>
    </tr>
    </form>
    @endforeach
  </tbody>
</table>

<button type="submit" formmethod="post"  form="delete" class="btn btn-primary btn-sm delete" 
action="/makers/delete">一括削除</button>
  
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/js/products.js"></script>