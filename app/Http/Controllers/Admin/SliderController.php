<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\Mime\Header\all;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SliderAdmin = Slider::all();
        return view ('admin.slider.index', compact('SliderAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * *  @param  \App\Models\Slider  $slider
     */
    public function create(Slider  $slider)
    {
        return view('admin.slider.create', compact('slider'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * *  @param  \App\Models\Slider  $slider
     */
    public function store(Slider  $slider, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:5',
            'desc' => 'required|max:255|min:10',
            'nameBtn' => 'required|max:25',
            'linkBtn' => 'required',
            'imageSlider' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($request->file('imageSlider')) {
            $file = $request->file('imageSlider');
            $upload_folder = 'public/image';
            $filename = date('YmdHis') . $file->getClientOriginalName(); // image.jpg

            Storage::putFileAs($upload_folder, $file, $filename);

        }

        $slider->name = $request->name;
        $slider->desc = $request->desc;
        $slider->nameBtn = $request->nameBtn;
        $slider->linkBtn = $request->linkBtn;
        $slider->imageSlider = $filename;


        $slider->save();

        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Услуга создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * *  @param  \App\Models\Slider  $slider

     */
    public function showEdit(Slider  $slider)
    {

    }




    /**
     * Show the form for editing the specified resource.
     *     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id
     * @return \Illuminate\Http\Response
     * *  @param  \App\Models\Slider  $slider

     */
    public function edit(Slider  $slider)
    {

        return redirect()->route('admin.slider.index')
            ->with('infUser', $slider);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * *  @param  \App\Models\Slider  $slider

     */
    public function update(Slider  $slider, Request $request)
    {
        $request->validate([
            'name' => 'max:255|min:5',
            'desc' => 'max:255|min:10',
            'nameBtn' => 'max:25',
            'linkBtn' => 'min:2',
            'imageSlider' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);




        $filename = $slider->imageSlider;
        $imagePath = $filename;
        if ($request->file('imageSlider')) {



            if(File::exists('storage/image/'. $imagePath)){

                File::delete('storage/image/'. $imagePath);
            }



            $file = $request->file('imageSlider');

            $upload_folder = 'public/image';
            $filename = date('YmdHis').$file->getClientOriginalName(); // image.jpg

            Storage::putFileAs($upload_folder,  $file, $filename);

        }


        $slider->name = $request->name;
        $slider->desc = $request->desc;
        $slider->nameBtn = $request->nameBtn;
        $slider->linkBtn = $request->linkBtn;
        $slider->imageSlider = $filename;

        $slider->update();

        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Услуга изменена');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *    * @param  int  $id
     * @return \Illuminate\Http\Response
     * *  @param  \App\Models\Slider  $slider

     */
    public function destroy(Slider  $slider)
    {
        $slider->delete();
        $imagePath = $slider->imageSlider;

        if(File::exists('storage/image/'. $imagePath)){

            File::delete('storage/image/'. $imagePath);
        }



        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Услуга удалена');
    }
}
