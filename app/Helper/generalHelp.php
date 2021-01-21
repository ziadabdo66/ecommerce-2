<?php
define('PAGINATION_COUNT',30);

function getFolder(){
    return app()->getLocale()=='ar'?'css-rtl':'css';
}
function uploadimage($folder,$photo){
    $photo->store('/',$folder);
  $filename=  $photo->hashname();
  return $filename;
}


