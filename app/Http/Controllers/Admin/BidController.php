<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     *

     */
    public function index(Request $request)
    {
        $bidAdmin = Bid::all();

        if(isset($request->orderBy)){
            if($request->orderBy == 'new'){
                $bidAdmin =  Bid::where('status', 'Новая' )->get();
            }
            if($request->orderBy == 'waitMake'){
                $bidAdmin =  Bid::where('status', 'Обработка' )->get();
            }
            if($request->orderBy == 'decided'){
                $bidAdmin =  Bid::where('status', 'Выполнено' )->get();

            }
            if($request->orderBy == 'rejected'){
                $bidAdmin =  Bid::where('status', 'Отклонено' )->get();
            }
        }

        if($request->ajax()){
            return view('ajax.order-by', [
                'bidAdmin' => $bidAdmin
            ])->render();
        }

        return view('admin.bid.index', compact('bidAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *      @param \App\Models\Bid $bidOR

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response

     */


    public function create($id)
    {
dd($id);

        $bidOR->status = 'Обработка';
        $bidOR->update();
        return redirect()->back()->with('success', 'Статус успешно изменен');
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     *       @param \App\Models\Bid $bidOR

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     *       @param \App\Models\Bid $bidOR

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bidOR = Bid::find($id);

        $bidOR->status = 'Отклонено';
        $bidOR->update();
        return redirect()->back()->with('success', 'Статус успешно изменен');

    }

    /**
     * Show the form for editing the specified resource.
     *     *       @param \App\Models\Bid $bidOR

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bidOR = Bid::find($id);

        $bidOR->status = 'Обработка';
        $bidOR->update();
        return redirect()->back()->with('success', 'Статус успешно изменен');
    }

    /**
     * Show the form for editing the specified resource.
     *     *       @param \App\Models\Bid $bidOR

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editD($id)
    {
        $bidOR = Bid::find($id);

        $bidOR->status = 'Выполнено';
        $bidOR->update();
        return redirect()->back()->with('success', 'Статус успешно изменен');
    }




    /**
     * Update the specified resource in storage.
     *        @param \App\Models\Bid $bidOR

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $bidOR = Bid::find($id);

        $bidOR->status = 'Выполнено';
        $bidOR->update();
        return redirect()->back()->with('success', 'Статус успешно изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cl = Bid::find($id);
        $cl->delete();
        return redirect()->back()->with('success', 'Заявка удалена');
    }
}
