<?php return array (
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'webpatser/laravel-countries' => 
  array (
    'providers' => 
    array (
      0 => 'Webpatser\\Countries\\CountriesServiceProvider',
    ),
    'aliases' => 
    array (
      'Countries' => 'Webpatser\\Countries\\CountriesFacade',
    ),
  ),
);