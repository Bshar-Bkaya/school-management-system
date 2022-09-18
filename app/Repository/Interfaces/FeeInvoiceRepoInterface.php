<?php

namespace App\Repository\Interfaces;

interface FeeInvoiceRepoInterface
{
  // index
  public function index();
  // Show
  public function show($id);
  // Store
  public function store($request);
  // Edit
  public function edit($id);
  // Update
  public function update($request);
  // Delete
  public function destroy($id);
}
