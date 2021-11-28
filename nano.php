<?php
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
class NANO
{
    public $device_id = '';
    public function Register($phone)
    {
          $number = substr($phone,2);
        //   $data = '{"phoneNumber":"'.$phone.'","deviceId":"'.$device.'"}';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.nanovest.io/v1/account/phone-number/availability?countryCode=62&phoneNumber=' . $number . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "accept: application/json, text/plain, */*";
        $headers[] = 'x-device-id: ' . $this->device_id;
        $headers[] = 'x-timezone: Asia/Bangkok';
        $headers[] = 'accept-language: ID';
        $headers[] = 'Host: api.nanovest.io';
        $headers[] = 'Accept-Encoding: gzip';
        $headers[] = 'User-Agent: okhttp/3.12.12';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;

    }

    public function otp($phone)
    {
        $number = substr($phone,2);
        $data = '{"countryCode":"62","phoneNumber":"' . $number . '"}';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.nanovest.io/v1/auth/otp');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();

        $headers[] = "accept: application/json, text/plain, */*";
        $headers[] = 'x-device-id: ' . $this->device_id;
        $headers[] = 'sentry-trace: ' . $this->generateRandomString(32) . '-' . $this->device_id . '-1';
        $headers[] = 'x-timezone: Asia/Bangkok';
        $headers[] = 'accept-language: ID';
        $headers[] = 'Host: api.nanovest.io';
        $headers[] = 'Accept-Encoding: gzip';
        $headers[] = 'Connection: Keep-Alive';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'User-Agent: okhttp/3.12.12';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }
    public function setOtp($phone, $otp)
    {
        $number = substr($phone,2);
        $data = '{"countryCode":"62","phoneNumber":"' . $number . '","code":"' . $otp . '"}';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.nanovest.io/v1/auth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "accept: application/json, text/plain, */*";
        $headers[] = 'x-device-id: ' . $this->device_id;
        $headers[] = 'x-timezone: Asia/Bangkok';
        $headers[] = 'accept-language: ID';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Host: api.nanovest.io';
        $headers[] = 'Accept-Encoding: gzip';
        $headers[] = 'User-Agent: okhttp/3.12.12';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }
    public function submitRefferal($header_code, $kode_reff)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.nanovest.io/v1/referral/referral-code/submit/'.$kode_reff);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "accept: application/json, text/plain, */*";
        $headers[] = "service-name: bff-wallet";
        $headers[] = 'x-device-id: '.$this->device_id;
        $headers[] = 'x-timezone: Asia/Bangkok';
        $headers[] = 'accept-language: ID';
       // $headers[] = 'Content-Length: 0';
        $headers[] = 'authorization: bearer ' . $header_code;
        $headers[] = 'Host: api.nanovest.io';
        $headers[] = 'Accept-Encoding: gzip';
        $headers[] = 'User-Agent: okhttp/3.12.12';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }
    public function nanotag($phone, $header_code)
    {
        $number = substr($phone,2);
        $data = '{"countryCode":"62","nanoTag":"'.$this->generateRandomString(6).'","phoneNumber":"' . $number . '"}';
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.nanovest.io/v1/account/nanotag');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'authorization: bearer ' . $header_code;
        $headers[] = "accept: application/json, text/plain, */*";
        $headers[] = 'x-device-id: '.$this->device_id;
        $headers[] = 'x-timezone: Asia/Bangkok';
        $headers[] = 'accept-language: ID';
        $headers[] = 'Host: api.nanovest.io';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept-Encoding: gzip';
        $headers[] = 'User-Agent: okhttp/3.12.12';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    public function generateRandomString($length = true)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function getStr($string, $start, $end)
    {
        $str = explode($start, $string);
        $str = explode($end, $str[1]);
        return $str[0];
    }
    public function connect($end_point, $post)
    {
        $_post = array();
        if (is_array($post)) {
            foreach ($post as $name => $value) {
                $_post[] = $name . '=' . urlencode($value);
            }
        }
        $ch = curl_init($end_point);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if (is_array($post)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($result)) {
            $result = false;
        }
        curl_close($ch);
        return $result;
    }
}
$try = new NANO;

echo "\033[1;32m\n----------------------\nAuto Creator NANOVEST\n----------------------\n\033[0m";
print "by otpinaja.com" . PHP_EOL . PHP_EOL;
echo "Mau nomor Sendiri Atau Nomor dari otomatis? \nPilih mau tang mana : \n1. Otomatis \n2. Sendiri \n\n";

echo "\033[1;32m[?]\033[0m Pilih menu (1/2) : ";
$choose = trim(fgets(STDIN));

echo "\033[1;32m[?]\033[0m Jumlah : ";
$jumlah = trim(fgets(STDIN));

echo "\033[1;32m[?]\033[0m Kode Refferal : ";
$kode_reff = trim(fgets(STDIN));

if($choose == 1){
    echo "\033[1;32m[?]\033[0m Masukan ApiKey : ";
    $apikey = trim(fgets(STDIN));
    echo "\nPilih id layanan nanovest\n205. Nanovest - Rp 2.800\n206. Nanovest S2 - Rp 2.800\n\n";
    echo "\033[1;32m[?]\033[0m Masukan id layanan (205/206) : ";
    $service_id = trim(fgets(STDIN));
}

if(!$jumlah && !$kode_reff){
    die('[*] Mohon isi yang bener');
}
$sukses = 0;
$gagal = 0;
$no = 1;
while (true) {
    if($sukses >= $jumlah){break;}
    echo "\n";
    echo "\033[1;33m[$no]\033[0m-------------------------------\033[1;31m[$gagal]\033[0m\033[1;32m[$sukses]\033[0m\n";
    $date = date('Y-m-d');
    if ($choose == '1') {
        echo "Mendapatkan Nomor...";
        $api_url = 'https://otpinaja.com/api/order';
        $post_data = array(
            'api_key' => $apikey,
            'service_id' => $service_id,
        );
        $api = $try->connect($api_url, $post_data);

        if (json_decode($api)->status == true) {
            $result = json_decode($api)->data->number;
        } else {
            echo 'Gagal, perikas api/saldo anda';
            //break;
        }
    } else {
        echo "Masukan nomor (628XXXXXXX) : ";
        $result = trim(fgets(STDIN));
    }

    if (is_numeric($result)) {
        $number = $result;
        $try->device_id = $try->generateRandomString(16); // set device id
        echo $number . PHP_EOL;
        echo "Req OTP....";
        $ceknomor = $try->Register($number);
        if (json_decode($ceknomor)->code == '1') {
            echo "ok" . PHP_EOL;
            echo "Meminta otp...";
            $reqotps = $try->otp($number);
            $json = json_decode($reqotps);
            if (json_decode($reqotps)->code == '1') {
                echo "ok" . PHP_EOL;
                if ($choose == '1') {
                    echo "Mencari otp.";
                    while (true) {
                        echo '.';
                        $cekid = json_decode($api)->data->id;
                        $api_urlnya = 'https://otpinaja.com/api/status';
                        $post_datanya = array(
                        'api_key' => $apikey,
                        'order_id' => $cekid,
                    );
                        $ceksms = json_decode($try->connect($api_urlnya, $post_datanya));
                        $durasi = $ceksms->data->durasi;
                        $status = $ceksms->data->status;
                
                        if ($status == 'success') {
                            $data_sms = preg_match("/adalah ([0-9]+)/", $ceksms->data->otp, $is_sms);
                            $otp = $is_sms[1];
                            $api_urlnya = 'https://otpinaja.com/api/set_status';
                            $post_datanya = array(
                            'api_key' => $apikey,
                            'order_id' => $cekid,
                            'status' => 'done'
                        );
                            $try->connect($api_urlnya, $post_datanya);
                            echo $otp . PHP_EOL;
                            break;
                        }

                        if ($durasi <= 19) {
                            echo "cancel" . PHP_EOL;
                            $api_urlnya = 'https://otpinaja.com/api/set_status';
                            $post_datanya = array(
                            'api_key' => $apikey,
                            'order_id' => $cekid,
                            'status' => 'cancel'
                        );
                            $try->connect($api_urlnya, $post_datanya);
                            $gagal += 1;
                            break;
                        }
                        sleep(1);
                    }
                } else {
                    echo "Input OTP : ";
                    $otp = trim(fgets(STDIN));
                }
                echo "Cek otp...";
                if ($otp) {
                    echo "ok\n";
                    echo "Proses otp...";
                    $VerifyOTP = $try->setOtp($number, $otp);
                    $json_verif = json_decode($VerifyOTP, true);
                    if (json_decode($VerifyOTP)->code == '1') {
                        echo 'ok' . PHP_EOL;
                        echo "Proses referal...";
                        $header_code = $json_verif['data']['token'];
                        $refferal_submit = $try->submitRefferal($header_code, $kode_reff);
                        if (json_decode($refferal_submit)->code == '1') {
                            echo 'done' . PHP_EOL;
                            echo "Set tag name...";
                            $nanotags = $try->nanotag($number, $header_code);
                            if (json_decode($nanotags)->code == '1') {
                                echo 'done' . PHP_EOL;
                                $sukses += 1;
                                //break;
                            } else {
                                echo 'gagal' . PHP_EOL;
                                //break;
                            }
                        } else {
                            echo 'reff gagal' . PHP_EOL;
                            //break;
                        }
                    } else {
                        echo 'otp salah' . PHP_EOL;
                        //break;
                    }
                } else {
                    echo 'otp tidak ditemukan' . PHP_EOL;
                    //break;
                }
            } else {
                echo "gagal" . PHP_EOL;
                //break;
            }
        } else {
            echo "nomor bermasalah" . PHP_EOL;
            //break;
        }
    }
    $no += 1;
}
