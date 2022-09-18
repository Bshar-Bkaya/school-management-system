<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\ProcessingFeeRepoInterface;

class ProcessingFeeController extends Controller
{

  protected $Processing;

  function __construct(ProcessingFeeRepoInterface $Processing)
  {
    $this->Processing = $Processing;
  }

  public function index()
  {
    return  $this->Processing->index();
  }

  public function store(Request $request)
  {
    return $this->Processing->store($request);
  }


  public function show($id)
  {
    return $this->Processing->show($id);
  }

  public function edit($id)
  {
    return $this->Processing->edit($id);
  }

  public function update(Request $request)
  {
    return $this->Processing->update($request);
  }

  public function destroy(Request $request)
  {
    return $this->Processing->destroy($request);
  }
}
