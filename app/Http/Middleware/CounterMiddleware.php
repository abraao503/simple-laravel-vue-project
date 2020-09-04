<?php

namespace App\Http\Middleware;
use App\ModelTraffic;

use Closure;

class CounterMiddleware
{
  private $objTraffic;

  public function __construct()
  {
    $this->objTraffic = new ModelTraffic();
  }

  public function handle($request, Closure $next)
  {
    $visitor = $request->ip();
    $visitorExists = $this->objTraffic->where('visitor', $visitor)->first();
    
    if($visitorExists){
      $visitorExists->visits++;
      $visitorExists->update();
    } else {
      $this->objTraffic->create([
        'visitor'=>$visitor,
        'visits'=>1
      ]);
    }

    return $next($request);
  }
}
