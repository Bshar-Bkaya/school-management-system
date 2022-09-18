<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeesRequest;
use App\Repository\Interfaces\FeeRepoInterface;

class FeeController extends Controller
{
  protected $Fee;

  public function __construct(FeeRepoInterface $fee)
  {
    $this->Fee = $fee;
  }

  public function index()
  {
    return $this->Fee->index();
  }


  public function create()
  {
    return $this->Fee->create();
  }


  public function store(StoreFeesRequest $request)
  {
    return $this->Fee->store($request);
  }

  public function edit($id)
  {
    return $this->Fee->edit($id);
  }

  public function update(Request $request)
  {
    return $this->Fee->update($request);
  }

  public function destroy(Request $request)
  {
    return $this->Fee->destroy($request->id);
  }
}
