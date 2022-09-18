<?php

namespace App\Repository\Interfaces;

interface PaymentRepoInterface
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
  // Destroy
  public function destroy($request);
}
