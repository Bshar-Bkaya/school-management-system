<?php

namespace App\Repository\Classes;

use App\Models\Fee;
use App\Models\Grade\Grade;
use App\Repository\Interfaces\FeeRepoInterface;

class FeeRepo implements FeeRepoInterface
{
  public function index()
  {
    $fees = Fee::all();
    return view('pages.Fees.index', compact('fees'));
  }

  public function create()
  {
    $Grades = Grade::all();
    return view('pages.Fees.add', compact('Grades'));
  }

  public function store($request)
  {
    try {
      $fee = new Fee();
      $fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
      $fee->amount        = $request->amount;
      $fee->Grade_id      = $request->Grade_id;
      $fee->Classroom_id  = $request->Classroom_id;
      $fee->year          = $request->year;
      $fee->description   = $request->description;
      $fee->Fee_type      = $request->Fee_type;
      $fee->save();
      toastr()->success(trans('messages.success'));
      return redirect()->route('Fees.create');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function edit($id)
  {
    $fee = Fee::findorfail($id);
    $Grades = Grade::all();
    return view('pages.Fees.edit', compact('fee', 'Grades'));
  }

  public function update($request)
  {
    try {
      $fees = Fee::findorfail($request->id);
      $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
      $fees->amount  = $request->amount;
      $fees->Grade_id  = $request->Grade_id;
      $fees->Classroom_id  = $request->Classroom_id;
      $fees->description  = $request->description;
      $fees->year  = $request->year;
      $fees->Fee_type  = $request->Fee_type;
      $fees->save();
      toastr()->success(trans('messages.Update'));
      return redirect()->route('Fees.index');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function destroy($id)
  {
    try {
      Fee::destroy($id);
      toastr()->error(trans('messages.Delete'));
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}
