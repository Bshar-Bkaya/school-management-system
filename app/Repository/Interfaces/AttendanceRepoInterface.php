<?php

namespace App\Repository\Interfaces;

interface AttendanceRepoInterface
{
  // index
  public function index();
  // Show
  public function show($id);
  // Store
  public function store($request);
  // Destroy
  public function destroy($request);
}
