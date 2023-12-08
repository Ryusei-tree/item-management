<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Rules\JanCodeRule;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'jan_code' => ['required', new JanCodeRule()],
                'name' => 'required|max:100',
                'type' => 'required|max:100',
                'price' => 'required',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'jan_code' => $request->jan_code,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
                'price' => $request->price
            ]);

            return redirect('/items/add');
        }

        return view('item.add');
    }


    // 商品編集画面 表示
    public function edit(Request $request) {
        $item = Item::where('id', '=', $request->id)->first();
        return view('item.edit')->with([
            'item' => $item,
        ]);
    }

    // 商品編集
    public function itemEdit(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'jan_code' => ['required', new JanCodeRule()],
                'name' => 'required|max:100',
                'type' => 'required|max:100',
                'price' => 'required',
            ]);

            // 商品編集
            $item = Item::where('id', '=', $request->id)->first();
            $item->jan_code = $request->jan_code;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->detail = $request->detail;
            $item->price = $request->price;
            $item->save();

        }
        $items = Item::all();

        return redirect('/items/');

        // return view('item.index', [
        //     'items' => $items,
        // ]);
    }


    // 商品削除
    public function delete(Request $request)
    {
        Item::destroy($request->id);
        return redirect('/items/');
    }


    // 検索機能
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Item::query();

        if(!empty($keyword)) {
            $keyword_split = mb_convert_kana($keyword, 's');
            $keyword_split2 = preg_split('/[\s]+/', $keyword_split);
            foreach($keyword_split2 as $keyword) {
                $query->where('jan_code', $keyword)
                    ->orWhere('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('type', 'LIKE', "%{$keyword}%");
            }
        }

        $items = $query->get();

        return view('item.index', compact('items', 'keyword'));
    }
}