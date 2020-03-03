<?php

namespace App\Modules\Common;

use DateTime;
use Disrupt\Common\Helper as DHelper;
use Disrupt\Common\Helper;
use Illuminate\Support\Facades\Redis;
use App\Modules\Common\StoredProcedure;
use App\Modules\Common\Constants;
use Disrupt\Libraries\DAO\DB as DB;
use Mockery\Exception;

class Helpers {

    public function generateRandomCode() {
        $iTime = time();
        $iNumber = $iTime % rand(1, 9999);
        $sSecondIndex = rand(0, 9);
        $sCode[2] = $sSecondIndex;
        $sCode = str_pad($iNumber, 4, rand(0, 9), STR_PAD_LEFT);
        $sCode[1] = ($sCode[1] * 7) % 9;
        return $sCode;
    }

    public function sendVerificationCode($sEmail, $iCode) {
        $sContent = "You have selected <b>$sEmail</b> as your new Ivacy ID.
                        To verify this email , you will be needing this code to enter in your application.
                        verification code:<br>";
        $sContent .= '<h1>' . $iCode . '</h1>';
        $sContent .= "<br>If you did not make this request, you can ignore this email. No ivacy client will be created without verification process.";
        $sContent .= "<br><br><b>Team Ivacy</b>";
        $iEmailSent = DHelper::sendMail('billing@ivacy.com', $sEmail, 'Verify your account', $sContent, 'Ivacy');
        return $iEmailSent;
    }

    function fnEncrypt($sValue, $sSecretKey) {

        return rtrim(
                base64_encode(
                        mcrypt_encrypt(
                                MCRYPT_RIJNDAEL_256, $sSecretKey, $sValue, MCRYPT_MODE_ECB, mcrypt_create_iv(
                                        mcrypt_get_iv_size(
                                                MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB
                                        ), MCRYPT_RAND)
                        )
                ), "\0"
        );
    }

    function fnDecrypt($sValue, $sSecretKey = Constants::IVC_SECRET_16_DIGIT) {
        return rtrim(
                mcrypt_decrypt(
                        MCRYPT_RIJNDAEL_256, $sSecretKey, base64_decode($sValue), MCRYPT_MODE_ECB, mcrypt_create_iv(
                                mcrypt_get_iv_size(
                                        MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB
                                ), MCRYPT_RAND
                        )
                ), "\0"
        );
    }

    public function encrypt($sMessage, $sKey = Constants::IVC_SECRET_16_DIGIT, $sEncode = true) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = Constants::IVC_SECRET;
        // iv - encrypt method AES-256-CBC expects 16 bytes
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($sMessage, $encrypt_method, $sKey, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public function decrypt($sMessage, $sKey = Constants::IVC_SECRET_16_DIGIT, $sEncode = true) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = Constants::IVC_SECRET;
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($sMessage), $encrypt_method, $sKey, 0, $iv);
        return $output;
    }

    public static function encryptPasswordForAPI($sMessage, $sKey = Constants::IVC_ENCRYPTION_DECRYPTION_SECRET_FOR_API) {
        return base64_encode(openssl_encrypt($sMessage, 'AES-128-CBC', $sKey, OPENSSL_RAW_DATA, $sKey));
    }

    public static function decryptPasswordForAPI($sMessage, $sKey = Constants::IVC_ENCRYPTION_DECRYPTION_SECRET_FOR_API) {
        return openssl_decrypt(base64_decode($sMessage), 'AES-128-CBC', $sKey, OPENSSL_RAW_DATA, $sKey);
    }

    /**
     * @param $sDateTime
     * @param $sPE
     * @return bool
     */
    public static function verifyPasswordEncryptionHash($sDateTime, $sPE) {
        if (md5($sDateTime . Constants::IVC_ENCRYPTION_DECRYPTION_SECRET_FOR_API . Constants::IVC_ENCRYPT_CODE_FOR_API) == $sPE) {
            return true;
        }
        return false;
    }

    public function parseKey($sKey) {
        $sTimeStamp = substr($sKey, -14);

        $sReqPrefix = substr($sKey, 0, strlen($sKey) - strlen($sTimeStamp));

//        if(!empty($sTimeStamp) && !empty($sReqPrefix)){
        if (!empty($sTimeStamp)) {

            if (\DateTime::createFromFormat('YmdHis', $sTimeStamp) !== FALSE) {

                $sDate = date('Y-m-d H:i:s', strtotime($sTimeStamp));
                $Resp = array(Constants::KEY_TIME => $sDate);
                return $Resp;
            } else {
                return false;
            }
        }
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

            $aResponse = json_decode($sResponse, true);

            //for debugging
            if ($bDebug == true) {
                Helper::dump($aResponse);
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

    /**
     * @param $iClientId
     * @param $sUserIP
     * @param $sLogAction
     * @param $sRequestType
     * @param $sRequestUrl
     * @param $sReturn
     * @param $sRequestParams
     * @return mixed
     */
    public function log($iClientId, $sUserIP, $sLogAction, $sRequestType, $sRequestUrl, $sReturn, $sRequestParams) {
        $db = new DB('DB-API-IVC');
        $sAddedOn = date('Y-m-d H:i:s');
        $aInput = array(
            'iClientId' => $iClientId,
            'sUserIP' => $sUserIP,
            'sAction' => $sLogAction,
            'sRequestType' => $sRequestType,
            'sRequestUrl' => $sRequestUrl,
            'sRequestParams' => json_encode($sRequestParams),
            'sRequestResponse' => $sReturn,
            'sRequestTime' => $sAddedOn
        );

        $aResult = $db->row(StoredProcedure::SAVE_API_LOGS, $aInput);
        return $aResult['affectedRow'];
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

    public static function transformPackagePeriodToDays($iPackagePeriod) {
        $iPeriod = 0;
        switch ($iPackagePeriod) {
            case 1:
                $iPeriod = 30;
                break;
            case 3:
                $iPeriod = 90;
                break;
            case 6:
                $iPeriod = 180;
                break;
            case 12:
                $iPeriod = 365;
                break;
        }
        return $iPeriod;
    }

    public static function sendMailtoDevs($subject, $msg) {
        $sHeaders = "From: " . Constants::IVACY_EMAIL . "" . "\r\n";

        mail("mawais.gt@gmail.com,maazrehman.gt@gmail.com,ameer@gaditek.com", $subject, json_encode($msg), $sHeaders);
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

    /**
     * @description get difference from 2 multidimensional array
     * @param $array1
     * @param $array2
     * @param array $arrayOptional
     * @return int
     * todo :: need to add some improvements
     */
    public function check_array_diff($array1, $array2, $arrayOptional = array()) {
//        $arrayOptional[] = $array2;
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (!isset($array2[$key])) {
//                    $difference[$key] = $value;
                    $difference[$key] = $array1[$key];
                } elseif (!is_array($array2[$key])) {
//                    $difference[$key] = $value;
                    $difference[$key] = $array1[$key];
                } else {
                    $new_diff = $this->check_array_diff($value, $array2[$key], $arrayOptional);
                    if ($new_diff != FALSE) {
                        $difference[$key] = $new_diff;
//                        $difference[$key] = $array1[$key];
                    }/* else{
                      $aRes = $this->searchArray($value, $key , $array2[$key] );
                      if( empty($aRes )){
                      //                            $difference[$key] = $value;
                      $difference[$key] = $array1[$key];
                      }
                      } */
                }
            } elseif (!isset($array2[$key]) || $array2[$key] != $value) {
                if ($value == "Venezuela") {
                    die("ssss");
                }
                $aRes = $this->searchArray($value, $key, $arrayOptional);
                if (empty($aRes)) {
//                    $difference[$key] = $value;
                    $difference[$key] = $array1[$key];
                }
            }
            if ($value == "Venezuela") {
                die("ssss");
            }
            var_dump($value);
            if (($value) == "United Arab Emirates") {
                die('United Arab ');
            }
        }
        return !isset($difference) ? 0 : $difference;
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

//    https://www.codeproject.com/Questions/780780/PHP-Finding-differences-in-two-multidimensional-ar


    public static function getDeviceTypeByDeviceName($sDeviceName) {

        if (isset(Constants::SUPPORTED_DEVICE[strtolower($sDeviceName)]) && Constants::SUPPORTED_DEVICE[strtolower($sDeviceName)]) {
            $iDeviceId = Constants::SUPPORTED_DEVICE[strtolower($sDeviceName)];
            $aResult ['id'] = $iDeviceId;
            return $aResult;
        }
        /*
          $db = new DB('DB-API-IVC');
          $aInput = array(
          'sDeviceName'=> ($sDeviceName) ? $sDeviceName : Constants::DEVICE_TYPE_ANDROID
          );

          $aResult = $db->row(StoredProcedure::GET_DEVICE_DETAIL_BY_NAME, $aInput);
          if(!empty($aResult)){
          return $aResult;
          } */
        return false;
    }

    public static function getAppTypeByAppName($sAppName) {

        if (isset(Constants::APPS_TYPE[strtolower($sAppName)]) && Constants::APPS_TYPE[strtolower($sAppName)]) {
            $iAppTypeId = Constants::APPS_TYPE[strtolower($sAppName)];
            $aResult ['id'] = $iAppTypeId;
            return $aResult;
        }
        /*
          $db = new DB('DB-API-IVC');
          $aInput = array(
          'sAppName'=> ($sAppName) ? $sAppName : Constants::APP_TYPE_PREMIUM
          );

          $aResult = $db->row(StoredProcedure::GET_APP_TYPE_DETAIL_BY_NAME, $aInput);
          if(!empty($aResult)){
          return $aResult;
          }
          return false; */
    }

    public static function getLocaleDetailByName($sLocaleName) {

        $db = new DB('DB-API-IVC');
        $aInput = array(
            'sLocaleName' => $sLocaleName
        );

        $aResult = $db->row(StoredProcedure::GET_LOCALE_DETAIL_BY_NAME, $aInput);
        if (!empty($aResult)) {
            return $aResult;
        }
        return false;
    }

    public static function getTimeStamp($sSupportedDevice = 1, $sLocale = 1) {

        $dTimeStamp = date('YmdHis');

        $sKey = $dTimeStamp;

//        return array(Constants::KEY_TIME  => $sKey.'_'.$sSupportedDevice.'_'.$sLocale );
        return array(Constants::KEY_TIME => $sKey);
    }

    public static function getInvoicePayToInfo() {
        $aResult = self::getSystemInfo('InvoicePayTo');
        if ($aResult['result'] == "success") {
            return $aResult['value'];
        }
        return '';
    }

    public static function getSystemInfo($sSettingName) {

        $aSettings = Helper::getSettings();
        $sUrl = $aSettings['whmcs_api']['url'];
        $sUsername = $aSettings['whmcs_api']['username'];
        $sPassword = md5($aSettings['whmcs_api']['password']);

        $aPostParams['action'] = "GetConfigurationValue";
        $aPostParams['setting'] = $sSettingName;
        $aPostParams['username'] = $sUsername;
        $aPostParams['password'] = $sPassword;
        $aPostParams['responsetype'] = 'json';
        return self::curlRequest($sUrl, $aPostParams);
    }

    /**
     * Get password string n return boolean after matching
     *
     * @return boolean
     */
    public static function validatePasswordPolicy(string $value): bool {
        if (preg_match(Constants::PASSWORD_POLICY, (string) $value)) {
            return (1);
        } else {
            //message
            //Your password must be min 12 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
            return (0);
        }
    }

}
