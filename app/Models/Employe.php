<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['department', 'employeType', 'country'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employeType()
    {
        return $this->belongsTo(EmployeType::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // filter employe data
    public static function getFilteredEmployee($country, $department, $empType, $join_date, $dob, $salary, $from, $to, $holiday_year)
    {
        $query = Employe::query();
        // $query = Employe::query();
        $query->when($country, function ($q) use ($country) {
            return $q->where('country_id', $country)->get();
        });
        $query->when($department, function ($q) use ($department) {
            return $q->where('department_id', $department)->get();
        });

        $query->when($empType, function ($q) use ($empType) {
            return $q->where('employe_type_id', $empType)->get();
        });
        $query->when($join_date, function ($q) use ($join_date) {
            return $q->whereYear('join_date', $join_date)->get();
        });
        $query->when($dob, function ($q) use ($dob) {
            return $q->whereYear('dob', $dob)->get();
        });
        $query->when($holiday_year, function ($q) use ($holiday_year) {
            return $q->wheremonth('holiday_year', $holiday_year)->get();
        });
        $query->when($salary, function ($q) use ($salary) {
            return $q->where('salaray', $salary)->get();
        });
        $query->when($from && $to, function ($q) use ($from, $to) {
            return $q->whereBetween('salaray', [$from, $to])->get();
        });

        $employees = $query->get();

        return $employees;
    }
}
