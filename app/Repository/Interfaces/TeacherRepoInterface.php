<?php

namespace App\Repository\Interfaces;

interface TeacherRepoInterface
{
  // Get All Teachers
  public function getAllTeachers();

  // Get All Teachers
  public function getAllSpecializations();

  // Get All Teachers
  public function getAllGenders();

  // Get All Teachers
  public function storeTeacher($request);

  // Get All Teachers
  public function editTeacher($id);

  // Get All Teachers
  public function updateTeacher($request);

  // Get All Teachers
  public function deleteTeacher($id);
}
