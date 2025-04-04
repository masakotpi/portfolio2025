<?php

namespace App\Http\Controllers;

use App\Domain\Usecases\ProductExportCsvUsecase;
use App\Domain\Usecases\ProductIndexUsecase;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductUpdateRequest;
use App\Domain\Usecases\ProductUpdateUsecase;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * 商品一覧
     */
    public function index(ProductIndexUsecase $usecase):view
    {
        $data =  $usecase->__invoke();
        return view('product_list',
        [
            'products' => $data['products'],
            'maker_list' => $data['maker_list'],
        ]);
    }


    /**
     * 商品更新
     *
     * @param  ProductUpdateRequest  $request
     */
    public function update(int $id, ProductUpdateRequest $request, ProductUpdateUsecase $usecase):RedirectResponse
    {
        DB::beginTransaction();
        try {
            $usecase->__invoke($id,$request->filter());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        return redirect()->back()->with('flash_message', '商品を更新しました');
    }

    /**
     * 商品CSVエクスポート
     * 
     */
    public function export(Request $request,ProductExportCsvUsecase $usecase)
    {
        try {
            $exportData = $usecase->__invoke($request);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
        return $exportData ;
    }

    /**
     * 商品CSVインポート
     *
     * @param  \Illuminate\Http\Request  $request
     */
     public function import(Request $request,ProductImportCsvUsecase $usecase):RedirectResponse
     {
        
        try {
            $errors =  $usecase->__invoke($request);
            
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
        if(count($errors) >0){
            return back()->withErrors($errors);
        }
        return back()->with('flash_message', 'csvをインポートしました');
        
    }



    /**
     * 商品一括削除
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function delete(Request $request):RedirectResponse
    {
        try {
            if(!$request->product_ids){
                throw new Exception('商品を選択してください');
            }
            Product::destroy($request->product_ids);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
        return back()->with('flash_message', '商品を削除しました');
    }

    
}
