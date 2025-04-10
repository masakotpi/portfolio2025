
@extends('layout')
@section('title')
商品一覧
@endsection

@section('content')

<div id="app">
{{--エクスポート--}}
<form method="POST" id="export" action="/products/csv_export">
  @csrf
<button type="submit" class="btn btn-primary btn-sm">CSVエクスポート</button>
</form>

{{--インポート--}}
<form method="POST" action="/products/csv_import">
<button type="button" class="btn-sm btn-primary d-inline" data-bs-toggle="modal" data-bs-target="#productModal">
  CSVインポート
  </button>
</form>


<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">CSVインポート</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div id="result"></div>
      </div>
      <div class="modal-footer">
        {{--インポート--}}
        <form method="POST" id="delete" action="/products/csv_import" enctype="multipart/form-data">
          @csrf
          <input type="file" name="csvdata" id="csvdata" multiple>
          <button type="submit" class="btn btn-primary btn-sm">送信</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">close</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

</form>
<table class="table">
    <thead>
      <tr>
        <th scope="col"><input type="checkbox" id="bulk-check-action"></th>

        <th scope="col">ID</th>
        <th scope="col">商品名</th>
        <th scope="col" width="10%">コード</th>
        <th scope="col">メーカー</th>
        <th scope="col" width="10%">カラー</th>
        <th scope="col" width="8%">入り数</th>
        <th scope="col" width="8%">仕入値(USD)</th>
        <th scope="col" width="8%">上代(円)</th>
        <th scope="col" width="8%">更新</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
          <tr>
            <td>
             {{--削除--}}
             <form method="post" id="delete" action="/products/delete">
              @csrf
            </form>

              <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" form="export" class="each_ids">
          </td>
          <td>
              {{ $product->id }}
              <input type="hidden" name="id" value="{{ $product->id }}" form="update{{ $product->id }}" class="form-control">
          </td>
          <td>
              <input type="text" name="name" value="{{ $product->name }}" form="update{{ $product->id }}" class="form-control">
          </td>
          <td>
              <input type="text" name="code" value="{{ $product->code }}" form="update{{ $product->id }}" class="form-control">
          </td>
          <td>
              <select name="maker_id" form="update{{ $product->id }}" class="form-control">
                  <option value="" disabled {{ $product->maker_id ? '' : 'selected' }}>メーカーを選択する</option>
                  @foreach($maker_list as $key => $value)
                      <option value="{{ $key }}" {{ $product->maker_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                  @endforeach
              </select>
          </td>
          <td>
              <input type="text" name="color" value="{{ $product->color }}" form="update{{ $product->id }}" class="form-control">
          </td>
          <td>
              <input type="text" name="per_case" value="{{ $product->per_case }}" form="update{{ $product->id }}" class="form-control">
          </td>
          <td>
              <input type="text" name="purchase_price" value="{{ $product->purchase_price }}" form="update{{ $product->id }}" class="form-control">
          </td>
          <td>
              <input type="text" name="selling_price" value="{{ $product->selling_price }}" form="update{{ $product->id }}" class="form-control">
          </td>
          
            <td><input v-model="vue_test" form="'update'.{{$product->id}}" class="form-control">
              {{--更新--}}
              <form method="post" id="update{{ $product->id }}">
                @csrf
                @method('PUT')
                <button type="submit" formaction="{{route('product_update',['id' => $product->id])}}"class="btn btn-outline-primary">
                <i class="far fa-edit"></i></button></a>
              </form>
              </td>
          </tr>
        @endforeach
  </tbody>
</table>

{{--削除--}}
{{-- <button type="submit" form="delete" class="btn btn-secondary btn-sm delete">一括削除</button> --}}
</div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/js/products.js"></script>

<script>
  new Vue({
    el:"#app",
    data:{
      number:0,
      items:[1,2,3],
      color:'',
      vue_test:132131,
      // custom_color:'aaa'

    },
    methods:{
      countUp:function(){
        this.number = this.number+1
      }
    },
    computed:{
      custom_color:function(){
          return this.color.toUpperCase();
      },
    }
  })
</script>