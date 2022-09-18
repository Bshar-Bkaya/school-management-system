<?php

namespace App\Repository\Interfaces;

interface StudentRepoInterface
{
  // Get All Student
  public function getAllStudents();

  // Create Student
  public function createStudent();

  // Store Student
  public function storeStudent($request);

  // Edit Student
  public function editStudent($request);

  // Update Student
  public function updateStudent($request);

  // Delete Student
  public function deleteStudent($id);

  // Soft Delete Student
  public function softDeleteStudent($id);

  // Get All Genders
  public function getAllSections();

  // Get All Genders
  public function getAllClassrooms();

  // Get All Genders
  public function getAllGenders();

  // Get All Namtionals
  public function getAllNationals();

  // Get All Bloods
  public function getAllBloods();

  // Upload Attachment
  public function uploadAttach($request);

  // Download Attachment
  public function downloadAttach($foldername, $filename);

  // Show Attachment
  public function showAttach($foldername, $filename);

  // Delete Attachment
  public function deleteAttach($request);
}
