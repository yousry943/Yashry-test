<?php
namespace App\Http\Controllers;
class DiscountGenerator {
  private $InterfaceDiscountGenerator;

  // Get only objects that belong to the interface.
  public function __construct(InterfaceDiscountGenerator $InterfaceDiscountGenerator)
  {
    $this->InterfaceDiscountGenerator = $InterfaceDiscountGenerator;
  }

  // Use the object's methods to generate the coupon.
  public function getDiscount()
  {
    $discount = $this->InterfaceDiscountGenerator->discount();

    return $discount;
  }
}
