<?php  

namespace App\Services\Cart;

class CartRealProduct
{
    private $product;

    private $qty;

    public function getproduct()
    {
        return $this->product;
    }
    public function setproduct($product)
    {
        $this->product = $product;
        return $this;
    }
    public function getQty()
    {
        return $this->qty;
    }
    public function setQty($qty)
    {
        $this->qty = $qty;
        return $this;
    }
    public function getTotal()
    {
        return $this->product->getPrice() * $this->qty;
    }
}
