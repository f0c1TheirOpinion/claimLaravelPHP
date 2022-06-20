<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use function Symfony\Component\Mime\Header\all;

class AdminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $countUsers = User::all()->count();
        $countBids = Bid::all()->count();
        $countBidsD = Bid::where('status', 'выполнено')->count();


        return view('admin.index', [
            'countUsers' => $countUsers,
            'countBids' => $countBids,
            'countBidsD' => $countBidsD,
        ]);

    }
}
