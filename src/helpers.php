<?php

if(!function_exists('justriceAsset')){
    function justriceAsset($hash){
        return config('justrice.api_url') . "/asset/{$hash}";
    }
}
