<?php

namespace  SettingModul\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;


use Intervention\Image\Image;
use SettingModul\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{

        function dosyasil($dosyayol)
        {

            if (\Illuminate\Support\Facades\Storage::disk('local')->exists($dosyayol)) {
                \Illuminate\Support\Facades\Storage::disk('local')->delete($dosyayol);
            }
        }

        function klasorac($dosyayol)
        {

            if(!\Illuminate\Support\Facades\Storage::disk('public')->exists($dosyayol)) {
                \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory($dosyayol, 0777, true, true);
            }
        }

        function uploadimage($image,$pathyol,$paththumb,$with=NULL,$height=NULL)
        {

            $fullName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $onlyName = implode('', explode('.' . $extension, $fullName));
            $filename = Str::slug($onlyName) . '-' . time();

            if ($image->extension() == 'svg' || $image->extension() == 'webp' || $image->extension() == 'pdf') {
                $orjinalurl = $pathyol . $filename . '.' . $image->extension();
                $thumbnailurl = $paththumb . $filename . '.' . $image->extension();

                \Illuminate\Support\Facades\Storage::disk('public')->putFileAs('',$image->path(), $orjinalurl);
                $thumbnailurl = $orjinalurl;

                $imagear['orj'] = $orjinalurl;

                $imagear['thum'] = $thumbnailurl;
            } else {
                $orjinalurl = $pathyol . $filename . '.webp';
                $thumbnailurl = $paththumb . 'thumb_' . $filename . '.webp';
                \Illuminate\Support\Facades\Storage::disk('public')->put($orjinalurl, Image::make($image->path())->encode('webp', 90));


                 \Illuminate\Support\Facades\Storage::disk('public')->put($thumbnailurl, Image::make($image->path())
                ->resize($with, $height, function ($constraint) {$constraint->aspectRatio();})
                ->encode('webp', 90));

                $imagear['orj'] = $orjinalurl;

                $imagear['thum'] = $thumbnailurl;
            }

            return  $imagear;
        }




    public function index()
    {
        $settings = Setting::all()->sortBy('settings_must');
        return view('settingmodul::index', compact('settings'));
    }

    public function edit($id)
    {
        $settings=Setting::where('id',$id)->firstOrFail();
        return view('settingmodul::edit',compact('settings','id'));
    }

    public function update(Request $request,$id)
    {

        $uploadFolder = Setting::where('key','site_upload')->pluck('value')->first();

        $settingsgetir=Setting::where('id',$id)->first();

        if ($request->hasFile('settings_value'))
        {
                $request->validate([
                    'settings_value' => 'required|image|mimes:jpg,jpeg,png|max:2048'
                ]);

                $pathoriginalyolu = $uploadFolder.'/';
                $this->klasorac($pathoriginalyolu);

                $images = $request->file('settings_value');


                if( $settingsgetir->settings_type == 'file') {

                    if(!empty($settingsgetir->value)) {
                        $this->dosyasil($settingsgetir->value);
                    }


                    $resimgelen =  $this->orjinalupload($images,$pathoriginalyolu);

                    $file_name =  $resimgelen;

                } else if( $settingsgetir->settings_type == 'array') {


                    if(!empty($settingsgetir->value)) {
                        foreach ($settingsgetir->value as $oldimage) {
                            $this->dosyasil($oldimage);
                        }
                    }


                    foreach ($request->setting_value as $image) {

                        $file_name = [];

                        $resimgelen =  $this->orjinalupload($image,$pathoriginalyolu);

                        $file_name[] =  $resimgelen;


                    }

                }



                $request->settings_value=$file_name;
        }


        if($settingsgetir->settings_type=="checkbox") {
            $settings=Setting::where('id',$id)->update(
                [
                    "value" => $settingsgetir->settings_value == '1' ? '0' : '1'
                ]
            );
        }
        else {
            $settings=Setting::where('id',$id)->update(
                [
                    "value" => $request->settings_value
                ]
            );
        }

       if ($settings)
       {
           Artisan::call('cache:clear');
           return back()->withSuccess("Düzenleme İşlemi Başarılı");
       }
        return back()->withError("Düzenleme İşlemi Başarısız");

    }
}
