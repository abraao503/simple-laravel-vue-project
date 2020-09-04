<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelTraffic;

class TrafficController extends Controller
{
  private $objTraffic;

  public function __construct()
  {
    $this->objTraffic = new ModelTraffic();
  }

  public function index()
  {
    try {
      $visitors = $this->objTraffic->all();

      $response['total visits'] = $visitors->sum('visits');
      $response['total visitors'] = $visitors->count();
      $response['visitors'] = $visitors;
      return response($response, 200);
    } catch(\Throwable $e) {
      return response([], 500);
    }
  }

  public function show($id)
  {
    try {
      $visitor = $this->objTraffic->find($id);
      return response($visitor, 200);
    } catch(\Throwable $e) {
      return response([], 500);
    }
  }
}
