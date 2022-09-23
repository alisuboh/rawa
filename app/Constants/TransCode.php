<?php

namespace App\Constants;

class TransCode
{
   const DIRECT_ORDER = "S-";
   const TABULAR_ORDER = "O-";
   const PURCHASE = "P-";
   const REVENUE = "I-";
   const EXPENSE = "E-";
   const EMPLOYEE = "EMP-";
   const CUSTOMER = "CST-";
   const SUPPLIER = "SUP-";

   const CODES_ARRAY = [
      'direct_order' => self::DIRECT_ORDER,
      'tabular_order' => self::TABULAR_ORDER,
      'purchase' => self::PURCHASE,
      'revenue' => self::REVENUE,
      'expense' => self::EXPENSE,
      'employee' => self::EMPLOYEE,
      'customer' => self::CUSTOMER,
      'supplier' => self::SUPPLIER
   ];


   const BENEFICIARY_SUPPLIER = 1;
   const BENEFICIARY_CUSTOMER = 2;
   const BENEFICIARY_EMPLOYEE = 3;
   const BENEFICIARY_OTHER = 4;

   const BENEFICIARY = [
      1 => "supplier",
      2 => "customer",
      3 => "employee",
      4 => "other"
   ];

   const BENEFICIARY_AR = [
      1 => "مورد",
      2 => "عميل",
      3 => "موظف",
      4 => "اخرى"
   ];


}
