<?php

namespace App\Helpers;

use App\Models\Barang;

class Cart
{
  public function __construct()
  {
    if ($this->get() === null) {
      $this->set($this->empty());
    }
  }
  public function set($cart)
  {
    request()->session()->put('cart', $cart);
  }

  public function get()
  {
    return request()->session()->get('cart');
  }

  public function empty()
  {
    return [
      'barangs' => []
    ];
  }

  public function add(Barang $barang)
  {
    $cart = $this->get();
    array_push($cart['barangs'], $barang);
    $this->set($cart);
  }

  public function remove($barang_id)
  {
    $cart = $this->get();
    array_splice(
      $cart['barangs'],
      array_search($barang_id, array_column($cart['barangs'], 'id')),
      1
    );
    $this->set($cart);
  }



  public function clear()
  {
    $this->set($this->empty());
  }
}
