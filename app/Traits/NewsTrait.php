<?php
use Illuminate\Http\Request;
namespace App\Traits;
trait NewsTrait {
    
    public function rc4($key, $data, $hex = true)
    {
        if ($hex) {
            $key = pack('H*', $key);
        }

        $keys[] = '';
        $boxs[] = '';
        $cipher = '';
        $key_length = strlen($key);
        $data_length = strlen($data);
        for ($i = 0; $i < 256; $i++) {
            $keys[$i] = ord($key[$i % $key_length]);
            $boxs[$i] = $i;
        }

        $j = 0;
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $boxs[$i] + $keys[$i]) % 256;
            $tmp = $boxs[$i];
            $boxs[$i] = $boxs[$j];
            $boxs[$j] = $tmp;
        }

        $a = 0;
        $j = 0;
        for ($i = 0; $i < $data_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $boxs[$a]) % 256;
            $tmp = $boxs[$a];
            $boxs[$a] = $boxs[$j];
            $boxs[$j] = $tmp;
            $k = $boxs[(($boxs[$a] + $boxs[$j]) % 256)];
            $cipher .= chr(ord($data[$i]) ^ $k);
        }

        return $cipher;
    }

    public function decrypt($key, $data, $hex = false)
    {
        return $this->encrypt($key, $data, $hex);
    } 
    
    public function decrypted_phone($header)
    {
        $key = "93424ff683d1e616a06711cfa710fc12";
        $y = base64_decode($header);
        $decrypted = $this->rc4($key, $y);
        return $decrypted;
    }
     public function get_he()
    {
      $headers = apache_request_headers();
      // print_r($headers);
      if($headers['X-EncryptID'] <> ''){
         $phone = $this->decrypted_phone($headers['X-EncryptID']);
         echo json_encode(['X-MSISDN'=>$phone]);
     }else{
         echo json_encode(['X-MSISDN'=>'']);
     }
     return redirect()->to('https://mobileakhbaar.com/akhbaar_new/public/he_login'.'?phone='.$phone);      
    }

 public function dec_he($encId)
 {
  $phone = $this->decrypted_phone($encId);
  echo json_encode(['phone'=>$phone]);
}

public function enc_he()
{
  echo 'test';
  $headers = apache_request_headers();
        //print_r($headers);
  print_r($headers['X-EncryptID']);
  echo '<pre>';

  if($headers['X-EncryptID'] <> '')
  {
     echo '<br>';
     echo 'asdsadasdsaddasdasd asdas dasdasdasd';
     $phone = $this->decrypted_phone($headers['X-EncryptID']);
     echo $phone.' asdsaasdasdsadasdsadsadsadasd';
 }else{
     echo 'empasdasdasdasdsadsadasdasdasd';
 }
 print_r($headers);
 print_r($phone);
}
}
// public function login(Request $request)
    {
        if ($request->has('no') && $request->has('id')) {

            $user = User::where('phone',$request->no)->first();
            if($request->id == $user->id)
            {
                Auth::loginUsingId($user->id);
            }
            return redirect()->route('log');
           // return redirect()->intended('landing');
        }
        if(Auth::check()){
            return redirect()->back();
        }
        $phone = '';
		if($request->exists('phone')){
			$phone = $this->dec_phone($request->phone);
		}else{
			return redirect()->to('http://13.214.94.35/he?redirectRoute=login');
		}
		return response()->view('pages.login', compact('phone')); 
    }
	
	function he(Request $request)
	{
		$headers = apache_request_headers();
		$ptn = "/^92/";  // Regex
		$rpltxt = "0";  // Replacement string
		if(isset($headers['X-EncryptID']) && $headers['X-EncryptID'] <> ''){
			$phoneNo = $this->decrypted_phone($headers['X-EncryptID']);
			$phone = $this->enc_phone(preg_replace($ptn, $rpltxt, $phoneNo)); 
		}else if(isset($headers['X-Encryptid']) && $headers['X-Encryptid'] <> ''){
			$phoneNo = $this->decrypted_phone($headers['X-Encryptid']);
			$phone = $this->enc_phone(preg_replace($ptn, $rpltxt, $phoneNo)); 
		}else{
			$phone = '';
		}
		return redirect()->to('https://whatsin.live/'.$request->redirectRoute.'?phone='.$phone);
	}




    public function rc4($key, $data, $hex = true)
    {
        if ($hex) {
            $key = pack('H*', $key);
        }

        $keys[] = '';
        $boxs[] = '';
        $cipher = '';
        $key_length = strlen($key);
        $data_length = strlen($data);
        for ($i = 0; $i < 256; $i++) {
            $keys[$i] = ord($key[$i % $key_length]);
            $boxs[$i] = $i;
        }

        $j = 0;
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $boxs[$i] + $keys[$i]) % 256;
            $tmp = $boxs[$i];
            $boxs[$i] = $boxs[$j];
            $boxs[$j] = $tmp;
        }

        $a = 0;
        $j = 0;
        for ($i = 0; $i < $data_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $boxs[$a]) % 256;
            $tmp = $boxs[$a];
            $boxs[$a] = $boxs[$j];
            $boxs[$j] = $tmp;
            $k = $boxs[(($boxs[$a] + $boxs[$j]) % 256)];
            $cipher .= chr(ord($data[$i]) ^ $k);
        }

        return $cipher;
    }

    public function decrypt($key, $data, $hex = false)
    {
        return $this->encrypt($key, $data, $hex);
    } 
	
	public function decrypted_phone($header)
    {
        $key = "93424ff683d1e616a06711cfa710fc12";
        $y = base64_decode($header);
        $decrypted = $this->rc4($key, $y);
        return $decrypted;
    }
function enc_phone($phone)
	{
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		$encryption_iv = '1234567895551441';
		$encryption_key = "Ideation@786";
		$encryption = openssl_encrypt($phone, $ciphering,
					$encryption_key, $options, $encryption_iv);
		return $encryption;
	}
	
	function dec_phone($encryption)
	{
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		$decryption_iv = '1234567895551441';
		$decryption_key = "Ideation@786";
		$decryption = openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
		return $decryption;
	}