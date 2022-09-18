<?php

namespace App\Constants;

class TransCode
{
   const DIRECT_ORDER = "S-001";
   const TABULAR_ORDER = "O-001";
   const PURCHASE = "P-001";
   const REVENUE = "I-001";
   const EXPENSE = "E-001";

   const EMPLOYEE = "EMP-001";
   const CUSTOMER = "CST-001";
   const SUPPLIER = "SUP-001";

   const BENEFICIARY = [
      1 => "supplier",
      2 => "customer",
      3 => "employee",
      4 => "other"
   ];


}
