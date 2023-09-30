<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Image;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    use HttpResponses;

    public function store(Request $request)
    {

        if (request("model") === 'hospitals') {

            $request->validate([
                "id" => "required|numeric|exists:hospitals,id",
                "image" => "required|file|mimes:jpeg,png,jpg|max:1000"
            ]);

            $name = uniqid() . "_hospital_image." . $request->file("image")->extension();
            $path = $request->file("image")->storeAs("public", $name);
            $url = Storage::url($path);

            $hospital = Hospital::find($request->id);

            $hospital->images()->create([
                "url" => $url
            ]);
            return $this->success("Image is uploaded successfully");

        } elseif (request('model') === 'users') {

            $request->validate([
                "id" => "required|numeric|exists:users,id",
                "image" => "required|file|mimes:jpeg,png,jpg|max:1000"
            ]);

            $name = uniqid() . "_user_profile." . $request->file("image")->extension();
            $path = $request->file("image")->storeAs("public", $name);
            $url = Storage::url($path);

            $user = User::find($request->id);

            $user->images()->create([
                "url" => $url
            ]);
            return $this->success("Image is uploaded successfully");

        } elseif (request('model') === 'doctors') {

            $request->validate([
                "id" => "required|numeric|exists:doctors,id",
                "image" => "required|file|mimes:jpeg,png,jpg|max:1000"
            ]);

            $name = uniqid() . "_doctor_profile." . $request->file("image")->extension();
            $path = $request->file("image")->storeAs("public", $name);
            $url = Storage::url($path);

            $doctor = Doctor::find($request->id);

            $doctor->images()->create([
                "url" => $url
            ]);
            return $this->success("Image is uploaded successfully");
        }
        return $this->error("Something was wrong");
    }

    public function delete($id)
    {
        $image = Image::find($id);
        if (is_null($image)){
            return $this->error("Something was wrong");
        }

        Storage::delete("public/".$image->url);

        $image->delete();

        return response()->json([
            "message" =>"Image Is Deleted Successfully",
            "success" => true,
        ]);
    }
}




