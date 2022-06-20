<?php

namespace App\Http\Controllers;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;

use App\Models\Slider;
use App\Models\Uslugi;

use Illuminate\Http\Request;
use function Symfony\Component\Console\Style\table;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
    public function __construct()
    {
        $this->middleware('auth');
    }

     *
     *
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Slider  =  DB::table('sliders')->get();
        $Uslugs  =  Uslugi::all();

        return view('index', [
            'Slider' => $Slider,
            'Uslugs' => $Uslugs
        ]);
    }

    public function showForm($id)
    {

        $uslugBid = Uslugi::find($id);

        return redirect()->back()
            ->with([
                'infUser' => $id,
                'uslugBid' => $uslugBid
            ]);

    }

    public function saveFormBid(Bid $bid, Request $request)
    {


        $request->validate([
            'name' => 'required|max:255|min:5',
            'number' => 'required|max:255|min:5',
            'email' => 'required|max:25',
            'uslug' => 'required|min:2',
            'comm' => '',

        ]);
         $user_id = auth()->check() ? auth()->user()->id : null;
if($request->comm == null) {
    Bid::create($request->all() + ['user_id' => $user_id, 'status' => 'Новая', 'comm' => null]);

}else{
    Bid::create($request->all() + ['user_id' => $user_id, 'status' => 'Новая']);

}


        return redirect()
            ->back()
            ->with('success', 'Заявка отправлена');
    }







}
