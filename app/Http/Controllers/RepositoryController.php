<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    $repositories = $this->objRepository->all()->toJson(JSON_PRETTY_PRINT);

    return response($repositories, 200);
  }

  public function store(Request $request)
  {
    $this->objRepository->create([
      'name'=>$request->name,
      'description'=>$request->description,
      'url'=>$request->url
    ]);
  }

  public function destroy($id)
  {
    $del = $this->objRepository->destroy($id);
  }
}
