<?php

use App\Models\StripePayment;

if (!function_exists('get_class_name')) {
    function get_class_name($class_name)
    {
        return $class_name;
    }
}

// stripe load data
if(!function_exists('get_stripe_key')){
    function get_stripe_key($key){
        $data= StripePayment::first();
        return $data ? $data->$key :'';
    }
}


function getResourchPath($path,&$result=[]){
    $files= scandir($path);
    foreach($files as $file){
        if($file != '.' && $file != '..'){
            $filePath =$path . DIRECTORY_SEPARATOR .$file;
            if(is_dir($filePath)){
                getResourchPath($filePath,$result);
            }else{
                $result[]=$filePath;
            }
        }
    }
    return $result;
}

function getRegexBetween($text){
    preg_match_all("%\{{ __\(['|\"](.*?)['\"]\) }}%i",$text,$matches);
    preg_match_all("%trans\(['|\"](.*?)['\"]\)%i",$text,$matches2);
    preg_match_all("%\@lang\(['|\"](.*?)['\"]\)%i",$text,$matches3);
    $allData=array_merge($matches[1],$matches2[1],$matches3[1]);
   $data=[];
    foreach($allData as $item){
         if(!empty($item)){
            $data[$item]=$item;
         }
    }
    return $data;
}

 function getFileData( $filePath=''){

   $paths=getResourchPath (resource_path('views'));

    $alldata=[];
    foreach($paths as $path){
        $alldata[]=getRegexBetween(file_get_contents($path));
    }

    $modifiedData=[];
    foreach($alldata as $data){
        foreach($data as $item){
            $modifiedData[$item]=$item;
        }
    }
    
    $modifiedData=var_export($modifiedData,true);
    file_put_contents(lang_path('en/messages.php'),"<?php \n return ".$modifiedData." ;");

    return "messages.php updated successfully!";

}
