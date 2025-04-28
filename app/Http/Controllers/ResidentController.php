<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResidentController extends Controller
{
    public function updateQuick(Request $request, Resident $resident)
    {
        $rules = [
            'full_name' => 'required|string|min:1|max:255|', // نام نباید خالی یا فقط فاصله باشد
        ];
        // پیامهای سفارشی خطا
        $messages = [
            'full_name.required' => 'نام الزامی است.',
        ];

        // اعتبارسنجی دادهها
        $validator = Validator::make($request->all(), $rules, $messages);


        // اگر اعتبارسنجی شکست بخورد
        if ($validator->fails()) {
            return response()->json([
                "type" => 'error',
                'message' => 'به مشکل برخورد کردید!'
            ]);
        }
        $resident->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'end_date' => $request->end_date,
        ]);
        return response()->json([
            "type" => 'success',
            'message' => 'کاربر  با موفقیت اپدیت شد'
        ]);
    }
    public function updateAll(Request $request, Resident $resident)
    {
        return $resident;
    }
}
