<?php

/* 
To solve the bad practice of accessing properties before initialization 
- Use default values 
- Or constructor class
- Setter or Getter

Constructor 
- Magic method and special function 

- PHP will assign automatic by default public 
*/
class Transaction
{
  // ? it can be floating data type also can be null
  private ?float $amount = null;
  public string $description = "";

  public function __construct(float $amount, string $description)
  {
    $this->amount = $amount;
    $this->description = $description;
  }

  public function addTax(float $rate)
  {
    $this->amount = $this->amount + ($this->amount * $rate / 100);
    return $this->amount;
  }
  public function applyDiscount(float $rate)
  {
    $this->amount = $this->amount - ($this->amount * $rate / 100);
    return $this->amount;
  }

  /**
   * Get the value of amount
   */
  public function getAmount()
  {
    return $this->amount;
  }
  public function __destruct()
  {
    echo "Destructing.....";
  }
}
