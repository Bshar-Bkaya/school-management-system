<?php

namespace App\Repository\Interfaces;

interface GraduatedRepoInterface
{
  // index
  public function index();
  // Create
  public function create();
  // Soft Delete
  public function softDelete($request);
  // Return Data
  public function returnData($request);
  // Destroy
  public function destroy($request);
}
