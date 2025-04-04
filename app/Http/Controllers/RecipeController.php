<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MstIngredientStoreRequest;
use App\Http\Requests\MstProcessesStoreRequest;
use App\Http\Requests\IngredientStoreRequest;
use App\Domain\Usecases\EasyRecipes\IngredientsIndexUsecase;
use App\Domain\Usecases\EasyRecipes\MstIngredientsStoreUsecase;
use App\Domain\Usecases\EasyRecipes\MstIngredientsUpdateUsecase;
use App\Domain\Usecases\EasyRecipes\MstIngredientsDeleteUsecase;
use App\Domain\Usecases\EasyRecipes\MstProcessesIndexUsecase;
use App\Domain\Usecases\EasyRecipes\MstProcessesStoreUsecase;
use App\Domain\Usecases\EasyRecipes\MstProcessesUpdateUsecase;
use App\Domain\Usecases\EasyRecipes\MstProcessesDeleteUsecase;
use App\Domain\Usecases\EasyRecipes\IngredientsStoreUsecase;
use App\Domain\Usecases\EasyRecipes\IngredientsDetailUsecase;
use App\Domain\Usecases\EasyRecipes\ProcessStoreUsecase;
use App\Domain\Usecases\EasyRecipes\ProcessUpdateUsecase;
use App\Domain\Usecases\EasyRecipes\RecipeIndexUsecase;
use App\Domain\Usecases\EasyRecipes\RecipeShowUsecase;
use App\Domain\Usecases\EasyRecipes\UploadImageUsecase;
use App\Http\Requests\UploadImageRequest;
use App\Models\Ingredient;
use App\Models\Process;
use Illuminate\Foundation\Console\JobMakeCommand;
use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
 
    /**
     * 材料マスター一覧
     */
    public function mstIngredientsIndex(Request $request,IngredientsIndexUsecase $usecase):view
    {
        $data =  $usecase->__invoke($request->all());
        return view('recipe_mst_ingredient', ['ingredients' => $data['ingredient'],'processes' => $data['process'],'type' => $request->type]);
    }
    /**
     * 材料マスター登録
     */
    public function mstIngredientsStore(MstIngredientStoreRequest  $request,MstIngredientsStoreUsecase $usecase):RedirectResponse
    {
        $usecase->__invoke($request);
        return redirect()->back()->with('flash_message','材料を登録しました。');
    }
    /**
     * 材料マスター更新
     */
    public function mstIngredientsUpdate(int $id, MstIngredientStoreRequest  $request,MstIngredientsUpdateUsecase $usecase):RedirectResponse
    {
        $usecase->__invoke($id, $request->filter());
        return redirect()->back()->with('flash_message','材料を更新しました。');
    }
    /**
     * 材料マスター削除
     */
    public function mstIngredientsDelete(int $id ,string $type,MstIngredientsDeleteUsecase $usecase):RedirectResponse
    {

        DB::beginTransaction();
        try {
            $usecase->__invoke($id,$type);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        return redirect()->back()->with('flash_message','材料を削除しました。');
    }
    /**
     * 工程マスター一覧
     */
    public function mstProcessIndex(Request $request,MstProcessesIndexUsecase $usecase):view
    {
        $mst_processes =  $usecase->__invoke($request);
        return view('recipe_mst_process',['mst_processes' => $mst_processes,'type' => $request->type]);
    }
    /**
     * 工程マスター登録
     */
    public function mstProcessStore(MstProcessesStoreRequest $request, MstProcessesStoreUsecase $usecase):RedirectResponse
    {
        $usecase->__invoke($request->filter());
        return redirect()->back()->with('flash_message','工程を登録しました。');
    }
    /**
     * 工程マスター更新
     */
    public function mstProcessUpdate(int $id, MstProcessesStoreRequest $request, MstProcessesUpdateUsecase $usecase):RedirectResponse
    {
        $usecase->__invoke($id, $request->filter());
        return redirect()->back()->with('flash_message','工程を登録しました。');
    }
    /**
     * 工程マスター削除
     */
    public function mstProcessDelete(int $id ,MstProcessesDeleteUsecase $usecase):RedirectResponse
    {
        DB::beginTransaction();
        try {
            $usecase->__invoke($id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        return redirect()->back()->with('flash_message','材料を削除しました。');
    }

    #################################################################################

    /**
     * レシピ一覧
     */
    public function index(Request $request, RecipeIndexUsecase $usecase):view
    {
        $recipes =  $usecase->__invoke($request);
        return view('recipe_list', compact('recipes','request'));
    }
    /**
     * レシピ詳細
     */
    public function recipeShow(int $id, RecipeShowUsecase $usecase):view
    {
        $recipe =  $usecase->__invoke($id);
        return view('recipe_detail',['recipe' =>$recipe['recipe'],'mst_ingredient_selector'=>$recipe['mst_ingredient_selector']]);
    }
    /**
     * 材料一覧（材料詳細）
     */
    public function ingredientsIndex(Request $request,IngredientsIndexUsecase $usecase):view
    {
        $data =  $usecase->__invoke($request->all());
        return view('recipe_ingredient', [
            'ingredients' => $data['ingredient'],
            'processes' => $data['process'],
            'type' => $request->type,
        ]);
    }

    /**
     * 材料登録
     *
     * @param  Request  $request
     */
    public function ingredientsStore(IngredientStoreRequest $request, IngredientsStoreUsecase $usecase)
    {
        DB::beginTransaction();
        try {
            $data = $usecase->__invoke($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        if($request['recipe_id']){
            return back()->with('flash_message','材料を追加しました');
        }else{
            return redirect('ingredients/'.$data->id);
        }
    }
 
    /**
     * 材料削除
     */
    public function ingredientsDelete(int $id)
    {
        $recipe =  Ingredient::destroy($id);
        return redirect()->back()->with('flash_message','材料を削除しました');
    }
    /**
     * 工程詳細
     */
    public function ingredientsDetail(int $id ,Request $request,IngredientsDetailUsecase $usecase):view
    {
        $recipe =  $usecase->__invoke($id);
        return view('recipe_process', compact('recipe' ,'id'));
    }
    

    /**
     * 工程登録
     *
     * @param  Request  $request
     */
    public function processStore(Request $request, ProcessStoreUsecase $usecase)
    {
        DB::beginTransaction();
        try {
            $usecase->__invoke($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        if(isset($request['is_return'])){
            return back()->with('flash_message','工程を追加しました');
        }else{
            return redirect('recipes');
        }
      
    }
    /**
     * 工程更新
     *
     * @param  Request  $request
     */
    public function processUpdate(int $id, Request $request, ProcessUpdateUsecase $usecase)
    {
        DB::beginTransaction();
        try {
            $usecase->__invoke($id, $request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        return redirect()->back()->with('flash_message','更新しました。');

    }

    /**
     * 材料削除
     */
    public function processDelete(int $id)
    {
        $recipe =  Process::destroy($id);
        return redirect()->back()->with('flash_message','工程を削除しました');
    }
    /**
     * 画像アップロード登録
     *
     * @param  Request  $request
     */
    public function upload(UploadImageRequest $request, UploadImageUsecase $usecase)
    {
        DB::beginTransaction();
        try {
            $data = $usecase->__invoke($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        return response()->json($data);

    }
}
