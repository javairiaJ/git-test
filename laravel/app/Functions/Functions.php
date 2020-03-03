<?php

namespace App\Functions;

use Mail;
use App\EmailSetting;
use App\EmailSocialLink;

class Functions {

    public static function prettyJson($inputArray, $statusCode) {
        return response()->json($inputArray, $statusCode, array('Content-Type' => 'application/json'), JSON_PRETTY_PRINT);
    }

    public static function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    public static function saveImage($file, $destinationPath, $destinationPathThumb = '') {
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(111, 999) . time() . '.' . $extension;
        $image = $destinationPath . '/' . $fileName;
        $upload_success = $file->move($destinationPath, $fileName);
        return $fileName;
    }

    public static function stringTrim($string = '', $needle = 0, $start = 0, $end = 0) {
        return (strlen($string) > $needle) ? substr($string, $start, $end) . '...' : $string;
    }

    public static function makeOrderEmailTemplate($orders, $addresses) {
        $template = "";
        return view('email.order', compact('orders', 'addresses'));
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function setEmailTemplate($contentModel, $replaces) {
        $data['body'] = $contentModel[0]->body;
        $data['subject'] = $contentModel[0]->subject;
        $data['title'] = $contentModel[0]->title;
        foreach ($replaces as $key => $replace) {
            $data['body'] = str_replace("%%" . $key . "%%", $replace, $data['body']);
        }
        return $data;
    }

    public static function setEmailFooter() {
        $data = array();
        $data['emailSettings'] = EmailSetting::where('status', 1)->where('deleted', 0)->first();
        $data['emailSocialLinks'] = EmailSocialLink::where('status', 1)->where('deleted', 0)->get();
        return view('emails.email_footer', $data);
    }

    public static function sendEmail($email, $subject, $body, $header = '', $from = "job@taskmatch.com", $cc = "", $bcc = "") {

//        if (env('PP_ENV') == 'local') {
//            return 1;
//        } else {
        $data['to'] = $email;
        $data['body'] = $body;
        $data['subject'] = $subject;
        return Mail::send('emails.template', $data, function($message) use ($data) {

                    $message->to($data['to'])->subject($data['subject']);
                });
        // }
    }

    public static function makeCurlRequest($url) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
                )
        );
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }

    public static function setTemplate($body, $replaces) {

        $replaces["asset('')"] = asset("");
        $replaces["url('')"] = url("");
        foreach ($replaces as $key => $replace) {
            // $key=str_replace(" ", "", $key);
            $body = str_replace("{{" . $key . "}}", $replace, $body);
        }
        return $body;
    }

    public static function getChildCategories($allCategories) {
        $categories = array();

        foreach ($allCategories as $category) {
            if ($category->parent_id == 0) {
                $categories[$category->id]['name'] = $category->name;
                $categories[$category->id]['class'] = $category->class;
            } else {
                $categories[$category->parent_id]['categories'][$category->id] = array('name' => $category->name, 'class' => $category->class);
            }
        }
        return $categories;
    }

    public static function getCategories($allCategories) {
        $categories = array();
        return $categories = self::getBranch($allCategories, 1);
    }

    public static function getBranches($arr, $id) {
        $childrenArr = array();
        foreach ($arr as $item) {

            if ($item->parent_id == $id) {
                $childrenArr[] = $item;
            }
        }
        return $childrenArr;
    }

    public static function getBranch($arr, $id) {
        $branch = array();
        foreach ($arr as $item) {

            if ($item->id == $id) {

                $branch[$item->id] = $item;
                $branches = self::getBranches($arr, $id);

                $children = array();
                foreach ($branches as $child) {

                    $b = self::getBranch($arr, $child->id);

                    foreach ($b as $token => $child) {
                        $children[$token] = $child;
                    }
                }
                $branch[$item->id]['categories'] = $children;
                break;
            }
        }
        if (count($branch) == 0)
            echo 'WARNING ' . $id;
        return $branch;
    }

    public static function getAge($birthDate) {

        $age = (date('Y') - date('Y', strtotime($birthDate)));
        return $age;
    }

    public static function dob($type, $start, $end) {
        if ($type == 'day') {
            return $days = range($start, $end);
        }
        if ($type == 'month') {
            return $months = array('01' => 'January', '02' => 'Febuary', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
        }
        if ($type == 'year') {
            return $years = range($start, $end);
        }
    }

}
