# ageras_basket

1. `_git clone_ repo`

2.  run `_composer install_`

3. run `_vendor/bin/phpunit_`  form inside project folder

Basket logic is located inside `app/Ageras folder`

Tests are located in `tests/Feature/App/Ageras`

Basket implements basic operations:
 
    ●  Add items to the shopping basket
 
    ●  Remove items from the shopping basket
 
    ●  Empty the shopping basket

As well following rules apply:
   
    ●  “Buy­ one ­get ­one ­free” discounts on items
    ●  10% off on totals greater than £20 (after bogof) 
    ●  2% off on total (after all other discounts) for customers with loyalty cards.
    (loyalty customer is emulated by isLoyaltyCustomer flag)

