<?php

namespace App\Livewire;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistComponent extends Component
{


    public function moveToCart($id){

        
        $cart=Cart::instance('wishlist')->content()->get($id);
        Cart::instance('wishlist')->remove($id);
        Cart::instance('cart')->add($cart->id, $cart->name, 1, $cart->price)->associate('App\Models\Product');
        


        $this->dispatch('refreshComponent')->to('wishlist-icon-component');
        $this->dispatch('refreshComponent')->to('carticon-component');
        flash('Mục danh sách mong muốn đã được chuyển sang giỏ hàng.');
    }

    public function removeWishlistProduct($id){
        Cart::instance('wishlist')->remove($id);
        $this->dispatch('refreshComponent')->to('wishlist-icon-component');
        flash('Mục danh sách mong muốn đã bị xóa.');

    }

    public function render()
    {
        return view('livewire.wishlist-component');
    }
}
