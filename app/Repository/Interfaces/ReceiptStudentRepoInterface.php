<?php

namespace App\Repository\Interfaces;

interface ReceiptStudentRepoInterface
{
  // index
  public function index();
  // show
  public function show($id);
  // Store
  public function store($request);
  // edit
  public function edit($id);
  // update
  public function update($request);
  // Destroy
  public function destroy($id);
}
