<?php

namespace App\Helpers;

use DateTime;
use Illuminate\Support\Facades\Redis;
use Mockery\Exception;

class Helpers {

    const PASSWORD_POLICY = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*(_|[^w])).{12,20}$/';

    public function generateRandomCode() {
        $iTime = time();
        $iNumber = $iTime % rand(1, 9999);
        $sSecondIndex = rand(0, 9);
        $sCode[2] = $sSecondIndex;
        $sCode = str_pad($iNumber, 4, rand(0, 9), STR_PAD_LEFT);
        $sCode[1] = ($sCode[1] * 7) % 9;
        return $sCode;
    }

    public static function curlRequest($sURI, $aParam, $aHeaders = array(), $sPostType = 'POST', $bDebug = false) {
        if (!empty($sURI)) {

            if (strtolower($sPostType) != "POST") {
                $aParam = http_build_query($aParam);
                $sURI = $sURI . "?" . $aParam;
            }

            $aCurlParams = array(
                CURLOPT_URL => $sURI, //"https://api.atom.purevpn.com/inventory/v1/getCountries/2",
                CURLOPT_RETURNTRANSFER => true, // might be false in future
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_ENCODING => "",
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $sPostType,
                CURLOPT_VERBOSE => true,
                CURLOPT_HTTPHEADER => $aHeaders,
            );

            if (strtolower($sPostType) == "post") {

                $aCurlParams [CURLOPT_POST] = 1;
                $aCurlParams [CURLOPT_POSTFIELDS] = $aParam;
            }

            $curl = curl_init();
            curl_setopt_array($curl, $aCurlParams);

            // Send the request & save response to $resp
            $sResponse = curl_exec($curl);
            //d($sResponse, 1);
            $aResponse = json_decode($sResponse, true);
            //d($aResponse, 1);
            //for debugging
            if ($bDebug == true) {
                d($aResponse);
                printf("cUrl error (#%d): %s<br>\n", curl_errno($curl), htmlspecialchars(curl_error($curl)));
            }

            // Close request to clear up some resources
            curl_close($curl);
            return $aResponse;
        }
    }

    public function setDataInRedis($key, $val) {
        try {
            Redis::set($key, serialize($val));
            return true;
        } catch (\Exception $e) {
            //self::sendMailtoDevs(" IVACY :: IMP REDIS SERVICE STOP",$e);
            return true;
        }
    }

    public function getDataFromRedis($key) {
        try {
            $CachedData = Redis::get($key);
            if (!empty($CachedData) && $CachedData != NULL) {

                return unserialize($CachedData);
            }
        } catch (\Exception $e) {
            //self::sendMailtoDevs(" IVACY :: IMP REDIS SERVICE STOP ".__FUNCTION__,$e);
            return $key;
        }
    }

    public function ResetCache() {
        try {
            Redis::flushall();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function compareDate($sDateTime1, $sDateTime2) {
        $sDateTime1 = new DateTime($sDateTime1);
        $sDateTime2 = new DateTime($sDateTime2);


        if ($sDateTime1 < $sDateTime2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $sPostDateTime
     * @param $sSystemDateTime
     * @param $sTypeOfTime
     * @return float|int (default time in seconds)
     */
    public static function calculateTime($sPostDateTime, $sSystemDateTime, $sTypeOfTime = 's') {
        $sTypeOfTime = strtolower($sTypeOfTime);
        $iPostedDateTime = strtotime($sPostDateTime);
        $iSystemDateTime = strtotime($sSystemDateTime);
        $sCalculateTime = $iSystemDateTime - $iPostedDateTime;

        if ($sTypeOfTime == "s") {
            if ($sCalculateTime > 0) {
                $sTypeOfTime = "s";
            }
            if ($sCalculateTime > 60) {
                $sTypeOfTime = "m";
            }
            if ($sCalculateTime > (60 * 60)) {
                $sTypeOfTime = "h";
            }
            if ($sCalculateTime > (60 * 60 * 24)) {
                $sTypeOfTime = "d";
            }
        }
        if ($sTypeOfTime == "m") {
            $sCalculateTime = round($sCalculateTime / 60);
        }
        if ($sTypeOfTime == "h") {
            $sCalculateTime = round($sCalculateTime / 60 / 60);
        }
        if ($sTypeOfTime == "d") {
            $sCalculateTime = round($sCalculateTime / 60 / 60 / 24);
        }
        return $sCalculateTime;
    }

    public static function getHashByString($sValue) {
        return !empty($sValue) ? md5($sValue) : '';
    }

    public function searchArray($value, $key, $array) {

        foreach ($array as $aSubArray) {
            if (isset($aSubArray[$key]) && $aSubArray[$key] == $value) {
                return $aSubArray;
            }
            /* if (isset($aSubArray[$key]) && is_array($aSubArray[$key])) {
              return $this->searchArray($value, $key, $array) ;
              } */
        }

        /* $results = array();
          if (is_array($array)) {
          if (isset($array[$key]) && $array[$key] == $value) {
          $results[] = $array;
          }
          foreach ($array as $subarray) {
          $results = array_merge($results, $this->searcharray($subarray, $key, $value));
          }
          }

          return $results; */
    }

    public function multiDimensionalToOneDimensioal($aData) {

        if (!is_array($aData)) {
            return FALSE;
        }
        $i = 0;
        $result = array();
        foreach ($aData as $key => $value) {
            if (is_array($value)) {
                $arrayList = $this->multiDimensionalToOneDimensioal($value);
                foreach ($arrayList as $listItem) {
                    $result[] = $listItem;
                }
            } else {
                $result[$i][$key] = $value;
            }
        }
        return $result;

        /*
          if( !is_array($haystack) ) {
          return false;
          }

          foreach( $haystack as $key => $val ) {
          if( is_array($val) && $subPath = $this->searchArrayKeyRecursive($needle, $val, $strict, $path) ) {
          $path = array_merge($path, array($key), $subPath);
          return $path;
          } elseif( (!$strict && $val == $needle) || ($strict && $val === $needle) ) {
          $path[] = $key;
          return $path;
          }
          }
          return false; */
    }

    public function check_array_diff2($arr1, $arr2, $aCountParam = false) {
        $result = [];

        $aResult = [];

        $iCount1 = count($arr1);
        $iCount2 = count($arr2);
        if ($aCountParam == true) {
            $aResult['array1'] = count($iCount1) . ' total counts ';
            $aResult['array1_count'] = $iCount1;
            $aResult['array2'] = count($iCount2) . ' total counts ';
            $aResult['array2_count'] = $iCount2;
        }

        $check = (is_array($arr1) && $iCount1 > 0) ? true : false;
        $result = ($check) ? ((is_array($arr2) && $iCount2 > 0) ? $arr2 : array()) : array();
        if ($check) {
            foreach ($arr1 as $key => $value) {
                if (isset($result[$key])) {
                    $result[$key] = $this->check_array_diff($value, $result[$key]);
                } else {
                    $result[$key] = $value;
                }
            }
        }
        $aResult = $result;
        return $aResult;
    }

    /**
     * Get password string n return boolean after matching
     *
     * @return boolean
     */
    public static function validatePasswordPolicy(string $value): bool {
        if (preg_match(self::PASSWORD_POLICY, (string) $value)) {
            return (1);
        } else {
            //message
            //Your password must be min 12 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
            return (0);
        }
    }

}
