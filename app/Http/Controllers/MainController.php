<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function create()
    {
        $cipher="";
        $msg="";
        $cip="";
        $msg2="";
        return view('home')->with('cipher',$cipher)->with('msg',$msg)->with('cip',$cip)->with('msg2',$msg2); 
    }

    public function Caser_enc(Request $request)
    {
        $msg=$request->input('msg1');
        $key=$request->input('key1');
        $len=strlen($msg);
        $cipher="";
        for ($i=0;$i<$len;$i+=1)
		{
			$ascii=ord($msg[$i]); //to get the ascii values
			if(($ascii>=65 && $ascii<=90))
			{
				$cipher.=chr(($ascii-65+$key)%26+65); //ASCII(65)=>A
			}else if($ascii>=97 && $ascii<=122)
			{
				$cipher.=chr(($ascii-97+$key)%26+97);//ASCII(97)=>a
			}
            else if($ascii==32)	//ASCII(32)=>SPACE
            {
                $cipher.=$msg[$i];
            }
		}
        $msg="";
        $msg2="";
        $cip="";
        return view('home')->with('cipher',$cipher)->with('msg',$msg)->with('cip',$cip)->with('msg2',$msg2); 
    }

    public function Caser_dec(Request $request)
    {
        $cip=$request->input('cip1');
        $key=$request->input('ckey1');
        $len=strlen($cip);
        $msg="";
        for ($i=0;$i<$len;$i+=1)
		{
			$ascii=ord($cip[$i]); //to get the ascii values
			if(($ascii>=(65) && $ascii<=(90)))
			{
				$msg.=chr((26+$ascii-65-$key)%26+65); //ASCII(65)=>A
			}
            else if($ascii>=(97) && $ascii<=(122))
			{
				$msg.=chr((26+$ascii-97-$key)%26+97);//ASCII(97)=>a
			}
            else if($ascii==32)	//ASCII(32)=>SPACE
            {
                $msg.=$cip[$i];
            }
		}
        $cipher="";
        $cip="";
        $msg2="";
        return view('home')->with('cipher',$cipher)->with('msg',$msg)->with('cip',$cip)->with('msg2',$msg2); 
    }

    public function pf_enc(Request $request)
    {
        ini_set('max_execution_time', 300);
        $cipher="";
        $msg="";
        $cip="";
        $msg=$request->input('pmsg1');
        $key=$request->input('pkey1');
        $ukey=strtoupper($key);
        $ukey=str_replace(' ', '', $ukey);
        
        for($i=0;$i<strlen($ukey);$i++) //to avoid duplicate values in the key
        {
            if(strpos($ukey,$ukey[$i],$i+1)!==false)
            {
                return back()->with('fail','Duplicate Values');
                break;
            }
        }

        $arr=str_split($ukey);
        $abc_str="ABCDEFGHIKLMNOPQRSTUVWXYZ";
        $abc_str = str_replace( $arr, '', $abc_str);
        $key_str=$ukey.$abc_str;
        $k=0;
        for ($row = 0; $row <5; $row++) {
            for ($col = 0; $col <5; $col++) {
               $key_mat[$row][$col] = $key_str[$k];
               $k++;
            }
         }
         //now $key_mat will contain the key matrix
         
         $mstr=strtoupper($msg);
         $mstr=str_replace(' ', '', $mstr);
         $mstr=str_replace("J","I",$mstr);
         $mlen=strlen($mstr)-1;
         $x="X";
         for($i=0;$i<$mlen;$i+=2)
         {
            if($mstr[$i]==$mstr[$i+1]) //when pairs have same alphabers
            {
                $mlen++;
                $mstr=substr_replace($mstr, $x, $i+1, 0); //insering X
            }
         }

         $mlen=strlen($mstr);
         if($mlen%2!=0) //length of message is odd
         {
            $mstr=substr_replace($mstr, $x, $mlen, 0); //adding X to make last character pair
         }
        
        $mlen=strlen($mstr);
         
         $cip="";

         for($k=0;$k<$mlen-1;$k+=2)
         {
            for ($row = 0; $row <5; $row++) {
                for ($col = 0; $col <5; $col++) 
                {
            
                    if($mstr[$k]==$key_mat[$row][$col])
                    {
                        $r1=$row;
                        $c1=$col;
                    }

                    if($mstr[$k+1]==$key_mat[$row][$col])
                    {
                        $r2=$row;
                        $c2=$col;
                    }
                }
            }

            if($r1==$r2)
            {
                $cc1=($c1+1)%5;
                $cc2=($c2+1)%5;
                $cip.=($key_mat[$r1][$cc1].$key_mat[$r1][$cc2]);
            }
            else if($c1==$c2)
            {
                $cr1=($r1+1)%5;
                $cr2=($r2+1)%5;
                $cip.=($key_mat[$cr1][$c1].$key_mat[$cr2][$c1]);
            }
            else
            {
                $cip.=($key_mat[$r1][$c2].$key_mat[$r2][$c1]);
            }
        }
        $msg="";
        $msg2="";
        return view('home')->with('cipher',$cipher)->with('msg',$msg)->with('cip',$cip)->with('msg2',$msg2); 
    }

    public function pf_dec(Request $request)
    {
        ini_set('max_execution_time', 300);
        $cipher="";
        $msg="";
        $cip="";
        $msg=$request->input('pcip2');
        $key=$request->input('pkey2');
        $ukey=strtoupper($key);
        $ukey=str_replace(' ', '', $ukey);

        for($i=0;$i<strlen($ukey);$i++) //to avoid duplicate values in the key
        {
            if(strpos($ukey,$ukey[$i],$i+1)!==false)
            {
                return back()->with('fail1','Duplicate Values');
                break;
            }
        }
        
        for($i=0;$i<strlen($ukey);$i++)
        {
            if(strpos($ukey,$ukey[$i],$i+1)!==false)
            {
                return back()->with('fail','Duplicate Values');
                break;
            }
        }

        $arr=str_split($ukey);
        $abc_str="ABCDEFGHIKLMNOPQRSTUVWXYZ";
        $abc_str = str_replace( $arr, '', $abc_str);
        $key_str=$ukey.$abc_str;
        $k=0;
        for ($row = 0; $row <5; $row++) {
            for ($col = 0; $col <5; $col++) {
               $key_mat[$row][$col] = $key_str[$k];
               $k++;
            }
         }
         //now $key_mat will contain the key matrix
         
         $mstr=strtoupper($msg);
         $mstr=str_replace(' ', '', $mstr);
         $mstr=str_replace("J","I",$mstr);
         $mlen=strlen($mstr)-1;
         $x="X";
         for($i=0;$i<$mlen;$i+=2)
         {
            if($mstr[$i]==$mstr[$i+1]) //when pairs have same alphabers
            {
                $mlen++;
                $mstr=substr_replace($mstr, $x, $i+1, 0); //insering X
            }
         }

         $mlen=strlen($mstr);
         if($mlen%2!=0) //length of message is odd
         {
            $mstr=substr_replace($mstr, $x, $mlen, 0); //adding X to make last character pair
         }
        
        $mlen=strlen($mstr);
         
         $cip="";

         for($k=0;$k<$mlen-1;$k+=2)
         {
            for ($row = 0; $row <5; $row++) {
                for ($col = 0; $col <5; $col++) 
                {
            
                    if($mstr[$k]==$key_mat[$row][$col])
                    {
                        $r1=$row;
                        $c1=$col;
                    }

                    if($mstr[$k+1]==$key_mat[$row][$col])
                    {
                        $r2=$row;
                        $c2=$col;
                    }
                }
            }

            if($r1==$r2)
            {
                $cc1=(5+$c1-1)%5;
                $cc2=(5+$c2-1)%5;
                $cip.=($key_mat[$r1][$cc1].$key_mat[$r1][$cc2]);
            }
            else if($c1==$c2)
            {
                $cr1=(5+$r1-1)%5;
                $cr2=(5+$r2-1)%5;
                $cip.=($key_mat[$cr1][$c1].$key_mat[$cr2][$c1]);
            }
            else
            {
                $cip.=($key_mat[$r1][$c2].$key_mat[$r2][$c1]);
            }
        }
        $msg2=$cip;
        $cip="";
        $msg="";
        return view('home')->with('cipher',$cipher)->with('msg',$msg)->with('cip',$cip)->with('msg2',$msg2); 
    }
}
