<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileHelperTrait;
use App\Models\Landmark;
use App\Models\LandmarkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.landmark.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.landmark.create-edit',['landmark'=>null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = [
        //     'title' => 'required',
        //     'audio' => 'required|mimes:mp3',
        //     'lat' => 'required|numeric',
        //     'lng' => 'required|numeric',
        //     'address' => 'required',
        //     'content' => 'required',
        //     'is_featured' => 'required|in:0,1',
        // ];

        // $customMessages = [
        //     'is_featured.required'=> 'The featured image is required.',
        //     'lat.required' => 'The latitude field is required.',
        //     'lat.numeric' => 'The latitude field must be a number.',
        //     'lng.required' => 'The longitude field is required.',
        //     'lng.numeric' => 'The longitude field must be a number.',
        // ];

        // $this->validate(request(), $rules, $customMessages);
        // try {
            $path = public_path('/upload/landmark');
            $landmark = New Landmark;
            $landmark->fill($request->all());
            if ($request->hasFile('audio')) {
                $audio_name = FileHelperTrait::fileUpload($request->audio,$path);
                $landmark->audio = $audio_name;
            }
            $landmark->save();
            if ($request->hasFile('images')) {
                $images = $request->images;
                foreach ($images as $image) {
                    $img_name = FileHelperTrait::fileUpload($image,$path);
                    $gallery = new LandmarkImage;
                    $gallery->image = $img_name;
                    $gallery->is_featured = ($image->getClientOriginalName() == $request->is_featured) ? 1 : 0;
                    $gallery->landmark_id = $landmark->id;
                    $gallery->save();
                }
            }
            return redirect()->route('landmarks.index')->withSuccess('Landmark added successfully');
        // } catch (\Exception $e) {
        //     Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
        //     abort(500);
        // }
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
    public function edit(Landmark $landmark)
    {
        $landmark_imgs = LandmarkImage::where('landmark_id', $landmark->id)->get();
        return view('admin.landmark.create-edit',compact('landmark','landmark_imgs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $landmark = Landmark::where('id',$id)->first();
        // $this->validate(request(),[
        //     'images.*' => 'required|mimes:jpg,jpeg,png|max:2048'
        // ]);
        // $rules = [
        //     'title' => 'required',
        //     'audio' => 'mimes:mp3',
        //     'lat' => 'required',
        //     'lng' => 'required',
        //     'address' => 'required',
        //     'content' => 'required',
        //     'is_featured' => 'required|in:0,1',
        //     'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        // ];
        // $customMessages = [
        //     'is_featured.required'=> 'One featured image is required.',
        // ];
        // $this->validate(request(), $rules, $customMessages);
        try {
            $path = public_path('/upload/landmark');
            $previous_audio = $landmark->audio;
            $landmark->fill($request->all());
            if ($request->hasFile('audio')) {
                if(isset($previous_audio) && file_exists($path.'/'.$previous_audio)){
                    unlink($path.'/'.$previous_audio);
                }
                $audio_name = FileHelperTrait::fileUpload($request->audio,$path);
                $landmark->audio = $audio_name;
            }
            $landmark->save();
            if ($request->remove_img)
                $remove_img_ids = explode(',', $request->remove_img);
            else
                $remove_img_ids = [];
            $getGallery = LandmarkImage::where('landmark_id', $id)->get();
            foreach ($remove_img_ids as $remove_id) {
                $deleImage = LandmarkImage::where('id', $remove_id)->first();
                if(isset($deleImage->image) && file_exists($path.'/'.$deleImage->image)){
                    unlink($path.'/'.$deleImage->image);
                }
                $deleImage->delete();
            }

            if ($request->hasFile('images')) {
                $images = $request->images;
                foreach ($images as $image) {
                    $img_name = FileHelperTrait::fileUpload($image,$path);
                    $gallery = new LandmarkImage;
                    $gallery->image = $img_name;
                    $gallery->is_featured = ($image->getClientOriginalName() == $request->is_featured) ? 1 : 0;
                    $gallery->landmark_id = $landmark->id;
                    $gallery->save();
                }
            }
            $removeFeatured = $getGallery->where('image', '!=', $request->is_featured)->pluck('id')->toArray();
            LandmarkImage::whereIn('id', $removeFeatured)->update(['is_featured' => 0]);
            LandmarkImage::where(['landmark_id'=>$landmark->id, 'image'=>$request->is_featured])->update(['is_featured' => 1]);
            return redirect()->route('landmarks.index')->withSuccess('Landmark has been updated');

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            abort(500);
        }
    }
}
