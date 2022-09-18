<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\FeeInvoiceRepoInterface;

class FeeInvoiceController extends Controller
{

  protected $Fee_Invoice;

  public function __construct(FeeInvoiceRepoInterface $Fee_Invoice)
  {
    $this->Fee_Invoice = $Fee_Invoice;
  }

  public function index()
  {
    return $this->Fee_Invoice->index();
  }


  public function create()
  {
    return 'create';
  }


  public function store(Request $request)
  {
    return $this->Fee_Invoice->store($request);
  }

  public function show($id)
  {
    return $this->Fee_Invoice->show($id);
  }

  public function edit($id)
  {
    return $this->Fee_Invoice->edit($id);
  }

  public function update(Request $request)
  {
    return $this->Fee_Invoice->update($request);
  }

  public function destroy(Request $request)
  {
    return $this->Fee_Invoice->destroy($request->id);
  }
}
