<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model {

    //
    protected $table = 'urls';

    public static function saveUrl($input) {
        //d($input,1);
        $id = $input['type_id'];
        $type = $input['type'];

        if (self::where('type', '=', $type)->where('type_id', '=', $id)->exists()) {
            $urls = self::where('type_id', $id)->where('type', '=', $type)->first();

            if ($urls->key != $input['key']) {
                self::where('id', $urls->id)->update([
                    'key' => $input['key'],
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            }
        } else {
            $url = new Url();
            $url->type = $input['type'];
            $url->type_id = $input['type_id'];
            $url->key = $input['key'];
            $url->save();
            return $url->id;
        }
    }

}
