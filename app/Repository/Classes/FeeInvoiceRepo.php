<?php

namespace App\Repository\Classes;

use App\Models\Fee;
use App\Models\Student;
use App\Models\FeeInvoice;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Repository\Interfaces\FeeInvoiceRepoInterface;

class FeeInvoiceRepo implements FeeInvoiceRepoInterface
{
  public function index()
  {
    $Fee_invoices = FeeInvoice::all();
    return view('pages.Fees_Invoices.index', compact('Fee_invoices'));
  }

  public function show($id)
  {
    $student = Student::findOrFail($id);
    $fees = Fee::where('Classroom_id', $student->Classroom_id)->get();
    return view('pages.Fees_Invoices.add', compact('student', 'fees'));
  }

  public function store($request)
  {
    $List_Fees = $request->List_Fees;

    DB::beginTransaction();

    try {

      foreach ($List_Fees as $List_Fee) {
        // حفظ البيانات في جدول فواتير الرسوم الدراسية
        $FeeInvoice               = new FeeInvoice();
        $FeeInvoice->invoice_date = date('Y-m-d');
        $FeeInvoice->student_id   = $List_Fee['student_id'];
        $FeeInvoice->Grade_id     = $request->Grade_id;
        $FeeInvoice->Classroom_id = $request->Classroom_id;;
        $FeeInvoice->fee_id       = $List_Fee['fee_id'];
        $FeeInvoice->amount       = $List_Fee['amount'];
        $FeeInvoice->description  = $List_Fee['description'];
        $FeeInvoice->save();

        // حفظ البيانات في جدول حسابات الطلاب
        $StudentAccount                 =  new StudentAccount();
        $StudentAccount->date           = date('Y-m-d');
        $StudentAccount->type           = 'invoice';
        $StudentAccount->fee_invoice_id = $FeeInvoice->id;
        $StudentAccount->student_id     = $List_Fee['student_id'];
        $StudentAccount->Debit          = $List_Fee['amount'];
        $StudentAccount->credit         = 0.00;
        $StudentAccount->description    = $List_Fee['description'];
        $StudentAccount->save();
      }

      DB::commit();

      toastr()->success(trans('messages.success'));
      return redirect()->route('FeesInvoices.index');
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function edit($id)
  {
    $fee_invoices = FeeInvoice::findOrFail($id);
    $fees = Fee::where('Classroom_id', $fee_invoices->Classroom_id)->get();
    return view('pages.Fees_Invoices.edit', compact('fee_invoices', 'fees'));
  }

  public function update($request)
  {
    DB::beginTransaction();

    try {

      // تحديث البيانات في جدول فواتير الرسوم الدراسية
      $FeeInvoice               = FeeInvoice::findOrFail($request->id);
      $FeeInvoice->fee_id       = $request['fee_id'];
      $FeeInvoice->amount       = $request['amount'];
      $FeeInvoice->description  = $request['description'];
      $FeeInvoice->save();

      // تحديث البيانات في جدول حسابات الطلاب
      $StudentAccount                 = StudentAccount::where('fee_invoice_id', $request->id)->first();
      $StudentAccount->Debit          = $request['amount'];
      $StudentAccount->description    = $request['description'];
      $StudentAccount->save();

      DB::commit();

      toastr()->success(trans('messages.success'));
      return redirect()->route('FeesInvoices.index');
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function destroy($id)
  {
    try {
      FeeInvoice::destroy($id);
      toastr()->error(trans('messages.Delete'));
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}
