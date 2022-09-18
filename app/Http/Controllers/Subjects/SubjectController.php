<?php

namespace App\Http\Controllers\Subjects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\SubjectRepoInterface;

class SubjectController extends Controller
{

  protected $Subject;

  public function __construct(SubjectRepoInterface $Subject)
  {
    $this->Subject = $Subject;
  }

  public function index()
  {
    return $this->Subject->index();
  }

  public function create()
  {
    return $this->Subject->create();
  }

  public function store(Request $request)
  {
    return $this->Subject->store($request);
  }

  public function edit($id)
  {
    return $this->Subject->edit($id);
  }

  public function update(Request $request)
  {
    return $this->Subject->update($request);
  }

  public function destroy(Request $request)
  {
    return $this->Subject->destroy($request->id);
  }
}