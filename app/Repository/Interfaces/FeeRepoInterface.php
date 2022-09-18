<?php

namespace App\Repository\Interfaces;

interface FeeRepoInterface
{
  // index
  public function index();
  // Create
  public function create();
  // Store
  public function store($request);
  // Edit
  public function edit($id);
  // Update
  public function update($request);
  // Destroy
  public function destroy($id);
}
