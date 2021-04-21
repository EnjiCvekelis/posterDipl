<?php

if (!function_exists('languages')) {
  function languages()
  {
    return \App\Dal\Entities\Language::all();
  }
}

if (!function_exists('routeWithQuery')) {
  
  function routeWithQuery($name, $params = [], $exceptParamsFromQuery = [])
  {
    $newUrl = route($name, $params);
    $newQuery = parse_url($newUrl, PHP_URL_QUERY);
    
    $curentQuery = Request::getQueryString();
    
    if (empty($curentQuery)) {
      $resultUrl = $newUrl;
    } else {
      if (empty($newQuery)) {
        $resultUrl = $newUrl."?$curentQuery";
      } else {
        $resultUrl = $newUrl."&$curentQuery";
      }
    }
    
    return removeParamFromQuery($resultUrl, $exceptParamsFromQuery);
  }
}

if (!function_exists('urlWithQuery')) {
  
  function urlWithQuery()
  {
    $queryString = Request::getQueryString();
    
    return Request::url().(empty($queryString) ? '' : '?'.Request::getQueryString());
  }
}

if (!function_exists('removeParamFromQuery')) {
  
  function removeParamFromQuery($url, $names)
  {
    list($urlPart, $queryPart) = array_pad(explode('?', $url), 2, '');
    parse_str($queryPart, $queryVars);
    
    foreach ($names as $name) {
      unset($queryVars[$name]);
    }
    
    $newQuery = http_build_query($queryVars);
    
    return $urlPart.'?'.$newQuery;
  }
}

if (!function_exists('assetImage')) {
  function assetImage($path, $width = null, $height = null, $secure = null)
  {
    if (empty($path)) {
      return asset('images/no-img.png');
    }
    
    if (!$width or !$height) {
      return asset('images/'.$path, $secure);
    }
    
    $imageService = resolve(\App\Core\Services\Infrastructure\IImageService::class);
    
    return $imageService->resize($path, $width, $height);
  }
}

if (!function_exists('dateOf')) {
  function dateOf($datetime, $nowIfEmpty = true)
  {
    if (empty($datetime)) {
      if ($nowIfEmpty) {
        return;
      }
      
      return date('d-m-Y', strtotime(now()));
    }
    
    return date('d-m-Y', strtotime($datetime));
  }
}

if (!function_exists('dateUtcToLocal')) {
  function dateUtcToLocal($datetime)
  {
    if (empty($datetime)) {
      return;
    }
  
    $localTimezone = \Config::get('app.local_timezone');
    return \Carbon\Carbon::createFromTimestamp(strtotime($datetime),
      new DateTimeZone($localTimezone));
  }
}

