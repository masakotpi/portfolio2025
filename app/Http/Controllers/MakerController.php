<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MakerRequest;
use Illuminate\Support\Collection;
use App\Models\Maker;
use Exception;
use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;

class MakerController extends Controller
{
    /**
     * メーカー一覧
     *
     */
    public function index():view
    {
        $makers =  Maker::get();
       return view('maker_list',compact('makers'));
    }
    /**
     * メーカー新規登録
     *
     * @param  MakerRequest  $request
     */
    public function store(MakerRequest $request):RedirectResponse
    {
       try {
            $maker =  New Maker;
            $maker->create($request->data());
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
        return back()->with('flash_message', '新規登録しました');
       
    }


    /**
     * メーカー更新
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(int $id, Request $request):RedirectResponse
    {
        try {
            $maker = Maker::find($request->id);
            $maker->fill($request->all())->save();
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
        return back()->with('flash_message', '商品を更新しました');
    }

    /**
     * メーカー一括削除
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function delete(Request $request):RedirectResponse
    {
        try {
            if(!$request->maker_ids){
                throw new Exception('メーカーを選択してください');
            }
            Maker::destroy($request->maker_ids);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
        return back()->with('flash_message', 'メーカーを削除しました');
    }

    
}
