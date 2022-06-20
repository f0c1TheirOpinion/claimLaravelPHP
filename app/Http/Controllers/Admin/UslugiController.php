<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Uslugi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\Mime\Header\all;

class UslugiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UslugiAdmin = Uslugi::all();
        return view ('admin.uslugi.index', compact('UslugiAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * *  @param  \App\Models\Uslugi  $uslugi
     */
    public function create(Uslugi $uslugi)
    {
        return view('admin.uslugi.create', compact('uslugi'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *  @param  \App\Models\Uslugi  $uslug
     */
    public function store(Uslugi $uslug, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:5',
            'desc' => 'required|max:255|min:10',
            'price' => 'required|integer',
            'imageUs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($request->file('imageUs')) {
            $file = $request->file('imageUs');
            $upload_folder = 'public/image';
            $filename = date('YmdHis') . $file->getClientOriginalName(); // image.jpg

            Storage::putFileAs($upload_folder, $file, $filename);

        }

        $uslug->name = $request->name;
        $uslug->desc = $request->desc;
        $uslug->price = $request->price;
        $uslug->imageUs = $filename;


        $uslug->save();

        return redirect()
            ->route('admin.uslug.index')
            ->with('success', 'Услуга создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *      * * @param  \App\Models\Uslugi  $uslugi

     */
    public function showEdit(Uslugi $uslugi)
    {

    }




    /**
     * Show the form for editing the specified resource.
     *     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id
     * @return \Illuminate\Http\Response
     *      * * @param  \App\Models\Uslugi  $uslug

     */
    public function edit(Uslugi $uslug)
    {

        return redirect()->route('admin.uslug.index')
            ->with('infUser', $uslug);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * * @param  \App\Models\Uslugi  $uslug

     */
    public function update(Uslugi $uslug, Request $request)
    {
        $request->validate([
            'name' => 'max:255|min:5',
            'desc' => 'max:255|min:10',
            'price' => 'integer',
            'imageUs' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);




        $filename = $uslug->imageUs;
        $imagePath = $filename;
        if ($request->file('imageUs')) {



            if(File::exists('storage/image/'. $imagePath)){

                File::delete('storage/image/'. $imagePath);
            }



            $file = $request->file('imageUs');

            $upload_folder = 'public/image';
            $filename = date('YmdHis').$file->getClientOriginalName(); // image.jpg

            Storage::putFileAs($upload_folder,  $file, $filename);

        }


        $uslug->name = $request->name;
        $uslug->desc = $request->desc;
        $uslug->price = $request->price;
        $uslug->imageUs = $filename;

        $uslug->update();

        return redirect()
            ->route('admin.uslug.index')
            ->with('success', 'Услуга изменена');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *    * @param  int  $id
     * @return \Illuminate\Http\Response
     *      * * @param  \App\Models\Uslugi  $uslug

     */
    public function destroy(Uslugi $uslug)
    {
        $uslug->delete();
        $imagePath = $uslug->imageUs;

        if(File::exists('storage/image/'. $imagePath)){

            File::delete('storage/image/'. $imagePath);
        }



        return redirect()
            ->route('admin.uslug.index')
            ->with('success', 'Услуга удалена');
    }
}
