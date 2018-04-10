<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTags extends Model
{
    public function addTags($tags, $event_id){
        $tags = explode(",", $tags);
        foreach($tags as $tag){
            if($this->checkTagExists($tag) != null) {$tag_id = $this->checkTagExists($tag);}
            else{
                $t = new Tag();
                $t->name = $tag;
                $t->save();
                $tag_id = $t->id;
            }
            $event_tag = new EventTags();
            $event_tag->event_id = $event_id;
            $event_tag->tag_id = $tag_id;
            $event_tag->save();
        }
    }

    private function checkTagExists($tag){
        $tag = Tag::where("name", $tag)->first();
        return ($tag == null) ? null : $tag->id;
    }

    public function tag(){
        return $this->belongsTo('App\Tag');
    }

    public function event(){
        return $this->belongsTo('App\Event');
    }
}
