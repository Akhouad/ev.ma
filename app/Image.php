<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\facades\Storage;
use Auth;

class Image extends Model
{
    public function storeImage($file){
        $path = Storage::putFile('public/images/manager/events', $file);
        $filename = str_replace('public/images/manager/events/', '', $path);
        
        $this->file = $filename;
        $this->user_id = Auth::user()->id;
        $this->save();
        echo "done";
        return $filename;
    }

    public function setEventId($event_id){
        $this->event_id = $event_id;
        $this->save();
    }
}
