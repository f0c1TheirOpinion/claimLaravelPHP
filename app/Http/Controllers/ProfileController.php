<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display a listing of the resource.
     *      * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->check() ? auth()->user()->id : null;

        $bids = Bid::where('user_id', auth()->user()->id)->get();

        if(isset($request->orderBy)){
            if($request->orderBy == 'new'){
                $bids =  Bid::where('status', 'Новая' )->where('user_id', auth()->user()->id)->get();
            }
            if($request->orderBy == 'waitMake'){
                $bids =  Bid::where('status', 'Обработка' )->where('user_id', auth()->user()->id)->get();
            }
            if($request->orderBy == 'decided'){
                $bids =  Bid::where('status', 'Выполнено' )->where('user_id', auth()->user()->id)->get();
            }
            if($request->orderBy == 'rejected'){
                $bids =  Bid::where('status', 'Отклонено' )->where('user_id', auth()->user()->id)->get();
            }
        }

        if($request->ajax()){
            return view('ajax.order-by-profile', [
                'bids' => $bids
            ])->render();
        }

        return view('Profile.listBid', [
            'bids' => $bids
        ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        return view('Profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['string', 'min:3', 'max:60', 'required'],
            'email' => ['email','string', 'min:3', 'max:30', 'required'],
            'login' => ['string', 'regex:/[A-Za-z0-9]/u'],


        ]);

        auth()->user()->update(
            $request->all()
        );

        return back()->with('success', 'Данные изменены');

    }






    /**
     * Remove the specified resource from storage.
     ** @param App\Models\Bid $profileUser
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $profileUser)
    {
        $profileUser->delete();
        return back()->with('success', 'Заявка удалена');

    }
}
