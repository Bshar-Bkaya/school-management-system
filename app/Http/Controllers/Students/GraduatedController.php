<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\GraduatedRepoInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
  protected $Graduated;

  function __construct(GraduatedRepoInterface $Graduated)
  {
    $this->Graduated = $Graduated;
  }


  public function index()
  {
    return $this->Graduated->index();
  }

  public function create()
  {
    return $this->Graduated->create();
  }

  public function store(Request $request)
  {
    return $this->Graduated->softDelete($request);
  }

  public function update(Request $request)
  {
    return $this->Graduated->returnData($request);
  }

  public function destroy(Request $request)
  {
    return $this->Graduated->destroy($request);
  }
}
