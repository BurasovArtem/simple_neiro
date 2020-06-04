<?php
    header( "Content-Type: text/html; charset=utf8" );
    error_reporting(E_ALL);
    @ini_set('display_errors', true);

    require_once  'vendor/autoload.php';
    use Phpml\Classification\KNearestNeighbors;

    // default_test

    // $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
    // $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

    // $classifier = new KNearestNeighbors();
    // $classifier->train($samples, $labels);

    // echo $classifier->predict([3, 2]);

    $arr = [
            'привет' =>
                ['привет','привед','приэвед','бривет', 'прив', 'дороу', 'приветик'],
            'как дела' =>
                ['как дела','какдела','как дила','каг дила'],
            ];
    $samples = [];
    $labels = [];
    foreach($arr as $key=>$values) {
        foreach($values as $value) {
            $labels[]=$key;
            $chars = preg_split('//u', $value, NULL, PREG_SPLIT_NO_EMPTY);
            $code = [];
            foreach($chars as $char)
                $code[]=IntLChar::ord($char);
            
            if(count($code) < 10) {
                $i=count($code);
                while($i<=10) {
                    $code[]=0;
                    $i++;
                }
            }
            $samples[]=$code;
        }
    }

    $classifier = new KNearestNeighbors();
    $classifier->train($samples, $labels);

    $str="привит!!!!!";
    $chars = preg_split('//u', $str, NULL, PREG_SPLIT_NO_EMPTY);
    $a = [];
    foreach($chars as $char)
        $a[]=IntLChar::ord($char);

    echo $classifier->predict($a);

?>