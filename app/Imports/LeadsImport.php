<?php

namespace App\Imports;

use App\Lead;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class LeadsImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $collection)
    {
//        $userId = Auth::user();

        // TODO: Implement collection() method.
        foreach ($collection as $row){
            $exist = Lead::where('email', $row['email'])->first();
            if($row['email'] !== '' && $exist === null && $row['email'] !== null){
                Lead::create([
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'user_id' => 1,
                    'phone' => $row['phone'],
                    'company_name' => $row['company_name'],
                    'designation' => $row['designation'],
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

