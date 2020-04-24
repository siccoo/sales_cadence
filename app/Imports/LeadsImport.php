<?php

namespace App\Imports;

use App\Lead;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LeadsImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
     * @param Collection $collection
     * @return Lead
     */

    public function collection(Collection $collection)
    {
        foreach ($collection as $lead){
            $exist = Lead::where('email', $lead['email'])->first();
            if($lead['email'] !== '' && $exist === null && $lead['email'] !==null){
                //        $userId = auth()->user()->id;
                return new Lead([
                    'first_name' => $lead['first_name'],
                    'last_name' => $lead['last_name'],
                    'email' => $lead['email'],
                    'user_id' => 1,
                    'phone' => $lead['phone'],
                    'company_name' => $lead['company_name'],
                    'designation' => $lead['designation'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'email' => Rule::unique('leads', 'email'), // Table name, field in your db
        ];
    }

    public function customValidationMessages()
    {
        return [
            'email.unique' => 'A lead already exit with this email',
        ];
    }
}
