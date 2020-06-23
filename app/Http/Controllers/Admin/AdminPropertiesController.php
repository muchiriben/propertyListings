<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Property;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Storage;

class AdminPropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('created_at', 'desc')->paginate(10);
               
        return view('admin.properties.index')->with('properties', $properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'address' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //handle if uploaded
        if($request->hasFile('image')){
            //get filename with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //get just filename
            $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('image')->storeAs('public/property_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //create post
        $property = new Property;
        $property->agent_id = auth()->user()->id;
        $property->title = $request->input('title');
        $property->type = $request->input('type');
        $property->description = $request->input('description');
        $property->address = $request->input('address');
        $property->status = "On Sale";
        $property->image = $fileNameToStore;
        $property->save();

        return redirect()->route('admin.properties.index')->with('success', 'Listing Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return view('admin.properties.show')->with('property', $property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('admin.properties.edit')->with('property', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'address' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //handle if uploaded
        if($request->hasFile('image')){
            //get filename with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //get just filename
            $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('image')->storeAs('public/property_images', $fileNameToStore);
        }

        //create post
        $property->title = $request->input('title');
        $property->type = $request->input('type');
        $property->description = $request->input('description');
        $property->address = $request->input('address');
        
    
        if($request->hasFile('image')){
            $property->image = $fileNameToStore;

        if($request->input('old_image') != 'noimage.jpg'){    
            Storage::delete('public/property_images/'.$request->input('old_image'));
        }

        } 

        $property->save();

        return redirect('admin/properties')->with('success', 'Property Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if(Gate::denies('adminGate')){
            return redirect('admin/properties')->with('error', 'Unauthorized Page');
        }

        if($property->image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/property_images/'.$property->image);

        }

        $property->delete();
        return redirect('admin/properties')->with('success', 'Property Deleted');
    }
}
