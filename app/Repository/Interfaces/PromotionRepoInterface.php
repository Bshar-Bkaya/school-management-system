<?php

namespace App\Repository\Interfaces;

interface PromotionRepoInterface
{
  // index
  public function index();
  // Store
  public function store($request);
  // Create
  public function create();
  // Destroy
  public function destroy($request);
}
