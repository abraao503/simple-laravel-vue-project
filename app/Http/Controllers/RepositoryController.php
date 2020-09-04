<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelRepository;

class RepositoryController extends Controller
{
  private $objRepository;

  public function __construct()
  {
    $this->objRepository = new ModelRepository();
  }

  public function index()
  {
    try {
      $repositories = $this->objRepository->all()->toJson(JSON_PRETTY_PRINT);
      return response($repositories, 200);
    } catch(\Throwable $e) {
      return response([], 500);
    }
  }

  public function store(Request $request)
  {
    $response;
    $rules = [
      'name' => 'required|max:255',
      'description' => 'max:255',
      'url' => 'required|max:255',
    ];

    try {
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $response['errors'] = $validator->messages();
      }else{
        $response = $this->objRepository->create([
          'name'=>$request->name,
          'description'=>$request->description,
          'url'=>$request->url
        ]);
      }

      return response($response, $response['errors'] ? 400 : 200);
    } catch(\Throwable $e) {
      return response([], 500);
    }
  }

  public function destroy($id)
  { 
    try{
      $deletedRepository = $this->objRepository->destroy($id);
      if($deletedRepository){
        return response([], 204);
      } else {
        $reponse['error'] = 'repository not found';
        return response($reponse, 404);
      }
    } catch(\Throwable $e) {
      return response([], 500);
    }
  }
}
