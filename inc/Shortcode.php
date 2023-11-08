<?php 

namespace CBS\Src;

class Shortcode{

    function __construct(){

        add_shortcode( 'cbs_main', [$this, 'cbs_shortcode'] );
    }

    /**
     * Main Shortcode
     */
    function cbs_shortcode() {
        ?>
        <div class="cbs-container">

            <form action="" class="zipform">
                <label for="zip">PostCode/ZIP : </label>
                <br><br>
                <input type="text" id="zip" placeholder="Enter PostCode/ZIP" class="zipcode">
            </form>

            <div class="btn-area">
                <button type="button" id="btn">Checkout</button>
            </div>
        </div>
       <?php 
    }
}