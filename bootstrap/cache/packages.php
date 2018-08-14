<?php return array (
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
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
  'torann/currency' => 
  array (
    'providers' => 
    array (
      0 => 'Torann\\Currency\\CurrencyServiceProvider',
    ),
    'aliases' => 
    array (
      'Currency' => 'Torann\\Currency\\Facades\\Currency',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'florianv/laravel-swap' => 
  array (
    'providers' => 
    array (
      0 => 'Swap\\Laravel\\SwapServiceProvider',
    ),
    'aliases' => 
    array (
      'Swap' => 'Swap\\Laravel\\Facades\\Swap',
    ),
  ),
);