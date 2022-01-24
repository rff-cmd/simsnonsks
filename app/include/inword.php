<?php  
    function get_num_name($num){  
        switch($num){  
            case 1:return 'satu';  
            case 2:return 'dua';  
            case 3:return 'tiga';  
            case 4:return 'empat';  
            case 5:return 'lima';  
            case 6:return 'enam';  
            case 7:return 'tujuh';  
            case 8:return 'delapan';  
            case 9:return 'sembilan';  
        }  
    }  
  
    function num_to_words($number, $real_name, $decimal_digit, $decimal_name){  
        $res = '';  
        $real = 0;  
        $decimal = 0;  
  
        if($number == 0)  
            return 'Nol'.(($real_name == '')?'':' '.$real_name);  
        if($number >= 0){  
            $real = floor($number);  
            $decimal = round($number - $real, $decimal_digit);  
        }else{  
            $real = ceil($number) * (-1);  
            $number = abs($number);  
            $decimal = $number - $real;  
        }  
        $decimal = (int)str_replace('.','',$decimal);  
  
        $unit_name[1] = 'ribu';  
        $unit_name[2] = 'juta';  
        $unit_name[3] = 'milliar';  
        $unit_name[4] = 'trilliun';  
  
        $packet = array();  
  
        $number = strrev($real);  
        $packet = str_split($number,3);  
  
        for($i=0;$i<count($packet);$i++){  
            $tmp = strrev($packet[$i]);  
            $unit = $unit_name[$i];  
            if((int)$tmp == 0)  
                continue;  
            $tmp_res = '';  
            if(strlen($tmp) >= 2){  
                $tmp_proc = substr($tmp,-2);  
                switch($tmp_proc){  
                    case '10':  
                        $tmp_res = 'sepuluh';  
                        break;  
                    case '11':  
                        $tmp_res = 'sebelas';  
                        break;  
                    case '12':  
                        $tmp_res = 'dua belas';  
                        break;  
                    case '13':  
                        $tmp_res = 'tiga belas';  
                        break;  
                    case '15':  
                        $tmp_res = 'lima belas';  
                        break;  
                    case '20':  
                        $tmp_res = 'dua puluh';  
                        break;  
                    case '30':  
                        $tmp_res = 'tiga puluh';  
                        break;  
                    case '40':  
                        $tmp_res = 'empat puluh';  
                        break;  
                    case '50':  
                        $tmp_res = 'lima puluh';  
                        break;  
                    case '70':  
                        $tmp_res = 'tujuh puluh';  
                        break;  
                    case '80':  
                        $tmp_res = 'delapan puluh';  
                        break;  
                    default:  
                        $tmp_begin = substr($tmp_proc,0,1);  
                        $tmp_end = substr($tmp_proc,1,1);  
  
                        if($tmp_begin == '1')  
                            $tmp_res = get_num_name($tmp_end).' belas';  
                        elseif($tmp_begin == '0')  
                            $tmp_res = get_num_name($tmp_end);  
                        elseif($tmp_end == '0')  
                            $tmp_res = get_num_name($tmp_begin).' puluh';  
                        else{  
                            if($tmp_begin == '2')  
                                $tmp_res = 'dua puluh';  
                            elseif($tmp_begin == '3')  
                                $tmp_res = 'tiga puluh';  
                            elseif($tmp_begin == '4')  
                                $tmp_res = 'empat puluh';  
                            elseif($tmp_begin == '5')  
                                $tmp_res = 'lima puluh';  
                            elseif($tmp_begin == '6')  
                                $tmp_res = 'enam puluh';  
                            elseif($tmp_begin == '7')  
                                $tmp_res = 'tujuh puluh';  
                            elseif($tmp_begin == '8')  
                                $tmp_res = 'delapan puluh';  
                            elseif($tmp_begin == '9')  
                                $tmp_res = 'sembilan puluh';  
  
                            $tmp_res = $tmp_res.' '.get_num_name($tmp_end);  
                        }  
                        break;  
                }  
  
                if(strlen($tmp) == 3){  
                    $tmp_begin = substr($tmp,0,1);  
                    $space = '';  
                    if(substr($tmp_res,0,1) != ' ' && $tmp_res != '')  
                        $space = ' ';  
                    if($tmp_begin != 0){  
                        if($tmp_begin == 1)  
                            $tmp_res = 'seratus'.$space.$tmp_res;  
                        else  
                            $tmp_res = get_num_name($tmp_begin).' ratus'.$space.$tmp_res;  
                    }  
                }  
            }else  
                $tmp_res = get_num_name($tmp);  
  
            $space = '';  
            if(substr($res,0,1) != ' ' && $res != '')  
                $space = ' ';  
  
            if($tmp_res == 'satu' && $unit == 'ribu')  
                $res = 'se'.$unit.$space.$res;  
            else  
                $res = $tmp_res.' '.$unit.$space.$res;  
        }  
  
        $space = '';  
        if(substr($res,-1) != ' ' && $res != '')  
            $space = ' ';  
        $res .= $space.$real_name;  
  
        if($decimal > 0)  
            $res .= ' '.num_to_words($decimal, '', 0, '').' '.$decimal_name;  
        return ucfirst($res);  
    }  
  
    /*echo num_to_words('11314', '', 0, '').'<br/>';  
    //Result: Sebelas ribu tiga ratus empat belas  
    echo num_to_words('12500', '', 0, '').'<br/>';  
    //Result: Dua belas ribu lima ratus  
    echo num_to_words('1234567890', '', 0, '').'<br/>';  
    //Result: Satu milliar dua ratus tiga puluh empat juta lima ratus enam puluh tujuh ribu delapan ratus sembilan puluh  
    echo num_to_words('13750', 'rupiah', 0, '').'<br/>';  
    //Result: Tiga belas ribu tujuh ratus lima puluh rupiah  
    echo num_to_words('1234567890.25', 'dolar', 2, 'sen').'<br/>';  
    //Result: Satu milliar dua ratus tiga puluh empat juta lima ratus enam puluh tujuh ribu delapan ratus sembilan puluh dolar Dua puluh lima sen  */
?>  