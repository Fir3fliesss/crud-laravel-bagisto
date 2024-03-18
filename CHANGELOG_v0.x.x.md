# CHANGELOG for v0.x.x

This changelog consists the bug & security fixes and new features being included in the releases listed below.

## **v0.2.0 (23th of December, 2019)** - *Release*

* #1959 [fixed] - if admin has set the same condition twice, then catalog rule is not getting apply

* #1958 [fixed] - getting exception on front end, if action type is Buy x get y free in non couponable cart rule.

* #1957 [fixed] - if action type is Fixed Amount to Whole Cart, then apply to shipping option should get hide.

* #1955 [fixed] - Message need to be changed on mouse hover on cross symbol next to applied coupon.

* #1954 [fixed] - If any different tax category has been assigned to variants in configurable product, then while using tax category condition in cart rule, rule is not working properly.

* #1950 [fixed] - multiple catalog rule should not get get applied, if 1st one has been created as End Other Rules = yes

## **v0.1.9 (20th of December, 2019)** - *Release*

* #1942 [fixed] - The selected category is not checked when editing the cart rule.

* #1939 [fixed] - Invalid coupon gets applied if clicking on apply coupon multiple times, although there is no discount amount but its displaying a message that coupon code applied successfully.

* #1938 [fixed] - Multiple cart rules are applied using only a single coupon.

* #1935 [fixed] - Categories are not displaying if in condition Categories(children only) or Categories(Parent Only) is selected.

* #1931 [fixed] - Catalog rule not applying if in condition type"Any Condition is true" is selected, and some of the condition doesn't match the product.

* #1929 [fixed] - Actual product amount and discounted amount both should display on the product page for configurable product

* #1928 [fixed] - Catalog rule should not apply if any conditions don't match if condition type"All Condition are true."

* #1904 [fixed] - Existing tax should display as a list on creating a catalogue rule if "Tax Category" is selected.

* #1903 [fixed] - UI issue in condition field

* #1895 [fixed] - Translation issue Action Type field while creating catalog rule.

* #1883 [fixed] - Free shipping not applied on a cart, if from action "Free Shipping" is selected and discount amount is given as zero.

* #1882 [fixed] - If Action "Apply on shipping " is selected as yes, then the discounted amount applies to both product and shipping charges.

* #1875 [fixed] - Discount gets applied on a cart if a condition is "Visible Individually" is set to yes and product added in the cart is not visible individually.

* #1868 [fixed] - Getting exception on checkout if action Buy X Get Y free is selected in cart rule. 

* #1861 [fixed] - Get an exception on checkout if applying an invalid coupon code and proceed for checkout.

* #1857 [fixed] - Getting exception when creating cart rule with condition URL KEY(children only).

* #1856 [fixed] - Getting exception on creating cart rule with condition Name(children only).

* #1847 [fixed] - If the cart rule condition does not match the cart, then on applying coupon, it should display a message "Coupon cannot be applied".

* #1839 [fixed] - Getting exception on filtering cart rule through id.

* #1838 [fixed] - Cart rule not working for condition sku(children only) and sku(parent only).

* #1836 [fixed] - Back button on Edit cart rule page doesn't work.

* #1835 [fixed] - Getting exception if condition value remains blank.

* #1834 [fixed] - On editing any cart rule, its priority updates to 1.

* #1833 [fixed] - Discount not applied if "Payment Method", "Shipping Method", "Shipping State" or "Shipping Country" is selected in condition.

* #1832 [fixed] - Able to use coupon irrespective of the number given in the "Uses per coupon" field.

* #1831 [fixed] - Negative sign is not required in the discount amount.

* #1830 [fixed] - If Coupon type is selected as "No Coupon", then coupon code should not generate for that particular cart rule.

* #1828 [fixed] - Updated changes are not saved on the editing cart rule.

* #1825 [fixed] - Not able to generate coupon code while creating cart rule.

* #1823 [fixed] - Getting exception after clicking on developement.

## **v0.1.8 (4th of October, 2019)** - *Release*

* [feature] - Refund is added for orders.

* #1504 [fixed] - Getting exception when applying a filter in Invoices grid through Invoice Date.

* #1492 [fixed] - Not showing orderid with prefix and suffix in Refund section.

* #1490 [fixed] - Getting Incorrect paid amount and due amount if order contains more than one product.

* #1489 [fixed] - Quantity of Product doesn't get updated after creating a refund.

* #1486 [fixed] - Getting incorrect Total Due Amount if the discount is applied.

* #1484 [fixed] - Unable to edit data of Refund Shipping field.

* #1483 [fixed] - The refund option should not be available if a refund is already created.

* #1461 [fixed] - Invoice number length should be a number of zeros that appears before invoice id.

* #1460 [fixed] - Getting error on deleting Newsletter.

* #1447 [fixed] - Order ID is not matching after printing invoice.

* #1442 [fixed] - Customer should get an email after registration.

* #1338 [fixed] - Fixed the complete header, the header should not scroll on scrolling the page.

* #1172 [fixed] - Default shipping and payment should be selected, currently no shipping method and payment method is selected by default.

## **v0.1.7 (17th of September, 2019)** - *Release*

* [feature] - Fiterable attributes according to category.

* [feature] - New module CMS added for adding static pages.

* [feature] - Dyanamic event firing in datagrid while adding columns, actions and mass actions as well.

* [enhancement] - Customer gets an email after registration.

* [enhancement] - Customer receives cancellation mail if his/her order is cancelled by admin.

* [enhancement] - SEO is now available for home page.

* [enhancement] - If account is created for customer by admin then customer should received an email that his/her account is created with create password link.

* [enhancement] - product_flat will is now scalable according to choice of attributes to be used in it.

* #1434 [fixed] - Incorrect discount amount in case of multicurrency.

* #1417 [fixed] - Discount amount is showing in "Quantity" column.

* #1415 [fixed] - Wrong discount applies if Action "Adjust whole cart to percent" is selected.

* #1411 [fixed] - Getting exception on updating cart rule.

* #1391 [fixed] - By default attribute condition gets saved as 1 in db, because of which cart rule not getting applied.

* #1382 [fixed] - In case of "Adjust whole cart to percent" discount amount is getting calculated according to price of one product.

* #1381 [fixed] - Filter is not working properly for action type column in cart rule.

* #1380 [fixed] - Getting error after refreshing the page.

* #1379 [fixed] - Cart rule not working in case of non-coupon if any condition is given.

* #1375 [fixed] - Wrong discount applied on cart in case of fixed discount.

* #1372 [fixed] - Getting exception if while updating cart rule , if any option is selected from "How to Choose Products?".

* #1351 [fixed] - Getting exception when assigning the root category to another category.

* #1348 [fixed] - Showing incorrect grandtotal in invoice section of admin, if order is placed in currency other than base currency.

* #1334 [fixed] - On editing catalog rule data gets removed from Discount Amount field.

* #1320 [fixed] - Catalog rule is not working according to selected attributes, if category is not selected.

* #1319 [fixed] - Getting exception when click on Apply rules if conditions are left empty while creating catalog rule.

* #1295 [fixed] - Getting exception on changing the locale from cms page.

* #1288 [fixed] - Getting exception while creating cart rules if any of the dropdown field left blank.

* #1286 [fixed] - Incorrect discount is showing in cart.

* #1284 [fixed] - Updated price for variant is not reflected on store.

* #1277 [fixed] - Getting exception on creating cart rules.

* #1263 [fixed] - For forgot password Submit button should get disabled if user has already clicked on submit button.

* #1260 [fixed] - Getting broken image link in email.

* #1259 [fixed] - Getting exception if using same sku for variants..

* #1258 [fixed] - If payment is done through paypal then invoice should generate automatically and Status of Order should be processing.

* #1256 [fixed] - Discounted amount is not displaying in invoice and invoice pdf at both customer end and admin end.

* #1253 [fixed] - Selected Channel for products get deselected after saving the product.

* #1239 [fixed] - Filterable attributes should not display in layered navigation if there are no product in that particular category.

* #1235 [fixed] - Attributes are not visible in category page to select as filterable attribute if attributes name are not provided in particular locales.

* #1234 [fixed] - After selecting direction to filter locale acc to direction no other field appears to select format.

* #1233 [fixed] - Got exception on front-end when first time changes the locale ,the changed locale have rtl direction.

* #1229 [fixed] - Issue with currency in customer order section, currency code doesn't get converted at orders page of customer.

* #1228 [fixed] - Getting issue when entering direct url for customer account profile.

* #1226 [fixed] - Product variation that has been ordered should display in customer order section in case of configurable product.

* #1217 [fixed] - Layered navigation for price is not working, when click on bar it shifts to rightmost end.Getting this issue in case of configurable product only.

* #1216 [fixed] - Price filter of layered navigation not working properly in case of Multi Currency.

* #1209 [fixed] - There is an image issue while ordering any variant of configurable product.

* #1190 [fixed] - After printing invoice at customer end, price is not getting change according to currency in invoice.

* #1177 [fixed] - Getting exception when trying to recover password.

* #1130 [fixed] - If "does not contain" is used in case of Shipping method, then discount amount get implemented before selecting any shipping method.

* #1129 [fixed] - Discount not getting applied if "does not contain" condition is used from Actions for Payment Methods.

* #1015 [fixed] - Adjust Paginator Number of Elements.

* #973 [fixed] - Edit Slider, get wrong with: An invalid form control with name='image[image_0]' is not focusable.

* #968 [fixed] - Sorting is not working (price).

* #778 [fixed] - Error when add item to cart.

## **v0.1.6 (28th of June, 2019)** - *Release*

* [feature] - Cart rules for providing discount with coupons and without coupons.

* [feature] - Take notes on customers.

* [feature] - Added swatch type attribute for products.

* [feature] - Added file type attribute for products.

* [feature] - Added image type attribute for products.

* [feature] - Admins can now export products.

* [feature] - Activate/Deactivate customers from admin panel.

* [feature] - Added backorders as global level configuration for Admin.

* [feature] - REST APIs added as a separate package.

* [enhancement] - Each channel can choose their respective root category.

* [enhancement] - Added customer group 'Guest' for guest type user comparison (reference usage in cart rule create and edit).

* [enhancement] - Global configuration to allow reviews from guests.

* [enhancement] - Weight unit options added as global configuration.

* [enhancement] - Dynamic footer bottom text input added as global level configuration.

* [enhancement] - Admin can now change their logo added as global level configuration.

* [enhancement] - Added global configuration for news letter subscription.

* [enhancement] - Added configuration to enable email verification on customer registration.

* [enhancement] - Dependent field added in system configuration.

* [optimization] - Removed products dependency from products_datagrid table and that table had been phased out of the system successfully.

* [optimization] - Massive performance improvements in page load from last stable release of v0.1.5.

* #1131 [fixed] - If "does not contain" is used in case of Shipping city, then discount amount get implemented before selecting any address.

* #1127 [fixed] - Getting wrong grandtotal if in cart rule shipping is selected as free.

* #1114 [fixed] - Unable to search cart rule by name.

* #1113 [fixed] - Cart rule is not working for guest user.

* #1112 [fixed] - Provide an option to delete the note added for a customer.

* #1103 [fixed] - If entered coupon is incorrect then after clicking on Apply coupon button once the button should get disabled until the coupon code changes.

* #1102 [fixed] - If in condition percentage of product is selected , then also fixed amount discount is applied.

* #1097 [fixed] - Coupon get applied if only one product is added in cart and from action it is saved as buy atleast 2.

* #1096 [fixed] - If any discount is already applied on cart and customer uses his coupon to get discount then in this case coupon discount should be applied.

* #1095 [fixed] - If maximum quantity allowed to discount is selected as 2 then on both product discount should be applied.

* #1080 [fixed] - Customer should be logged out if admin blocked the user, and a message should display "Your account has been blocked by admin".

* #1075 [fixed] - Validation error message is not showing for Customer Group.

* #1069 [fixed] - Getting exception on editing the second customer.

* #1068 [fixed] - Product Inventory is "Zero" but in product page showing In Stock.

* #1065 [fixed] - On editing any cart rule if user need to add any new condition then he need to select value from Add Conditions again.

* #1061 [fixed] - Cart rule not working For Shipping code.

* #1060 [fixed] - If cart rule is not created for guest then also it is applicable for guest user.

* #1059 [fixed] - Cart Rule not working for Shipping state. Created a non coupon cart rule for Condition Shipping state but it doesn't get applied.

* #1053 [fixed] - Discount amount is not displaying in orders.

* #1052 [fixed] - Coupon is not applicable in case of payment methods.

* #1051 [fixed] - If cart rule is create for customer having group guest, then also general group customer is also able to use the same coupon.

* #1050 [fixed] - Coupon code discount amount is not displaying on checkout page.

* #1011 [fixed] - Channel, Add Condition and Global label field not showing validation error message if user save without entering any data in these fields.

* #1007 [fixed] - Applying zero discount amount in case of percentage.

* #1006 [fixed] - Not able to remove coupon if once applied.

* #1005 [fixed] - Cart rule not working correctly with coupon code.Fixed discount of amount 10 is created but after applying amount need to pay by customer is 10.

* #1003 [fixed] - Getting exception if on editing any cart rule we select " Use Coupon" as Yes.

* #1001 [fixed] - Getting error while placing an order.

* #997 [fixed] - Change the validation for description.

* #995 [fixed] - [default] en field of labels section disappear after entering data in "Global Label" field.

* #994 [fixed] - Getting exception while creating cart rules.

* #993 [fixed] - Rule Name should be alphanumeric.

* #957 [fixed] - Typo in event fire.

* #949 [fixed] - Refresh order summary on every checkout step.

* #939 [fixed] - Not able to save price in decimal for configurable products.

* #932 [fixed] - Getting the incorrect price of a product in case of a configurable product if custom attribute of select type is used.

* #923 [fixed] - Required validation is not working for Lines in a Street Address, and add one as default line for the address field.

* #917 [fixed] - Attribute name should display with attribute value.

* #916 [fixed] - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'phone'.

* #897 [fixed] - Product gets saved without image if a used image is large. It should throw an error message.

* #896 [fixed] - getVariantMinPrice does not look at special_price.

* #894 [fixed] - Storage link command is missing when installing framework through 
installer.

* #890 [fixed] - An error message should show if 
uploaded mage size is 
....................................................
















large, while saving the category.

* #879 [fixed] - Getting validation error message for locale while editing attribute..................An attribute value is required for all locales.

* #867 [fixed] - Getting exception if a user creates shipment for a product deleted from the catalog.

* #842 [fixed] - Not able to export. This functionality is not working everywhere, where export is used.

* #841 [fixed] - Layout issue on 404 Page.

* #835 [fixed] - Parent Products show instock when all children have quantity 0.

* #825 [fixed] - Unable to update ( is_filterable ) in attributes.

* #818 [fixed] - Email should be sent to the respective inventory from which shipment has been created.

* #817 [fixed] - Admin should receive an email when an order is placed.

* #815 [fixed] - Issue in Attribute while creating configurable product.

* #814 [fixed] - Implement sort order feature for payment methods, so that payment method should display on front-end according to sort-order.

* #783 [fixed] - Image display issue of product on front-end when installation is done through GUI Installer.

* #771 [fixed] - Getting exception when login with custom role.

* #767 [fixed] - After applying filter of Status, the result display in boolean for Active/True and Inactive/False.

* #765 [fixed] - Getting issue in mass deletion for the configurable products if we have saved the products but variation and name of products has not saved.Getting this issue when App_Debug mode is false.

* #764 [fixed] - Make "Sliders" and "Image" field as required.While creating slider if image is not uploaded then slider is not created and its not showing that this field is required validation message.

* #763 [fixed] - Add a validation in tax rate that it should not be negative.

* #762 [fixed] - In Order Section of Customer Account no column is available in filter dropdown.

* #761 [fixed] - Issue in creating products if special characters are used in sku field.On add Product page if we use special character then it will be saved but when we click on Save Product button it gives validation error message that "The sku must be valid slug." admin.

* #760 [fixed] - Not able to add product to Wishlist from product page.

* #759 [fixed] - Text for Add to Cart button is not properly visible on product page for locale pt_BR.

* #757 [fixed] - Product getting save if price and weight is negative in variants of configurable product.

* #755 [fixed] - When trying to change display mode for product to list view when locale is "arabic" , it changes to default locale.

* #753 [fixed] - While creating attribute of type swatch, admin name and name according to locale is showing as required but get saved if field is left as blank, and while creating product this attribute field is blank.

* #752 [fixed] - On creating custom theme for shop it was also affecting admin panel's frontend.

* #750 [fixed] - Cross site request forgery.

* #749 [fixed] - Broken access control.

* #742 [fixed] - Getting exception when we change locale from Search result page.

* #741 [fixed] - Trying to get property 'permission_type' of non-object.

* #730 [fixed] - Add a word limitation for Category name so that after that limit category name should display in different line.

* #729 [fixed] - Price Slider overlap with category menu.

* #728 [fixed] - If multiple products are added in cart and we update the quantity of product which is not available then in this case its not showing a message that request quantity is not available, it shows success message that products in cart is updated.

* #727 [fixed] - Quantity of Product doesn't get updated at product page after generating shipment.

* #720 [fixed] - Case issue HomeController.php.

* #718 [fixed] - If user with custom role doesn't have access of Products and if he click on product link given in dashboard then getting exception.It should display unauthorised access message.

* #717 [fixed] - Url is not working "Add to Cart" in drop shipping manager.

* #713 [fixed] - Getting exception on deleting default channel.

* #712 [fixed] - Correct the filter option in Invoice grid.

* #710 [fixed] - Getting exception when applying filter on product according to Status.

* #709 [fixed] - Getting exception when applying filter according to Order Date of Order grid of Admin.

* #707 [fixed] - If in display mode for categories "Only Product" is selected then description should not display on front-end and if Only "Description" is selected than product should not display for category.

* #705 [fixed] - For 3 level menu option if access is given for only first menu and third menu , then getting unauthorized access.

* #699 [fixed] - Active category class missing

* #671 [fixed] - Having these errors Undefined variable: key/value.

* #666 [enhancement] - Create possibility of choose the qty os address line.

* #657 [fixed] - Not able to export order.Not getting any response after clicking on Export.Getting this issue for all export functionality

* #656 [fixed] - Getting checkout page blank when product is added in cart first and then proceed for checkout.Getting this issue in case of logged-in customer.Getting same issue in case of Buy-now also.

* #655 [fixed] - Not able to create category with images, category doesn't get save if image is used.

* #654 [fixed] - Getting exception while adding product images by gui installer.

* #647 [fixed] - Special price not working.

* #646 [fixed] - Warning: array_combine() expects parameter 1 to be array, null given ( install.php on line 32 ).

* #642 [fixed] - Getting exception on search in Products, Categories, Shipments & Product Reviews datagrids.

* #639 [fixed] - Broken link of image, on edit page of attribute in case of Swatch Type "Image" when editing first time.

* #638 [fixed] - Colors are not available in swatch on selecting Swatch Type as "Color Swatch".

* #636 [fixed] - Getting exception in shipment grid.

## **v0.1.5 (15th of March, 2019)** - *Release*

* [feature] - Category display mode.

* [feature] - Color swatches for product.

* [feature] - Cross sell and Up sell suggestions.

* [feature] - Faster search, faster product load on storefront, Product API for fetching with numerous attributes filter.

* [feature] - Added translations for Arabic and Brazilian languages(thanks to @cgartner-redstage).

* #676 [fixed] - Can't filter by ID.

* #671 [fixed] - Having these errors Undefined variable: key/value.

* #669 [fixed] - Product list view not working in demo.

* #664 [fixed] - CSS issues

* #652 [fixed] - Removed black bar in admin panel.

* #646 [fixed] - Warning: array_combine() expects parameter 1 to be array, null given ( install.php on line 32 )

* #642 [fixed] - Getting exception on search in Products, Categories, Shipments & Product Reviews datagrids.

* #639 [fixed] - Broken link of image, on edit page of attribute in case of Swatch Type "Image" when editing first time.

* #636 [fixed] - Getting exception in shipment grid.

* #633 [fixed] - Fixed database custom port issue in installer issue (thanks to @abdulhamid-alattar)

* #621 [Added] - Add a column in product grid to identify the attribute family used for creating that product.

* #620 [fixed] - "Enter Key" is not working while searching the product.

* #619 [fixed] - Getting exception when clicking on product for which data is set according to locale.

* #618 [fixed] - Layout issue on Changing Locale.

* #617 [fixed] - Getting exception in case of Guest Review on frontend.

* #616 [fixed] - Getting error message that tax rate field is required when importing tax rate even when value is provided in that field.

* #615 [Added] - Add a hint of allowed extension type on Import Tax rate pop-up.

* #612 [fixed] - Layout issue on create Shipment Page.

* #611 [fixed] - Attribute field name is not displaying on product page for all attribute type except multiselect.

* #608 [fixed] - Root Category issue while root setting from channel.

* #597 [Done] - "Boolean" Attribute type issue , when we select yes then 1 is showing on front end.

* #596 [Fixed] - "Multiselect" Attribute type issue, when we select multiple option then numeric value is showing on the front end.

* #594 [Added] - Latest order should display on top and add pagination on order page.(For Customer Account).

* #592 [Added] - "Shipping to" column of shipment remain blank if shipment for order is generated first and then invoice is created.

* #589 [Fixed] - Getting exception when product added in wishlist is deleted from admin and user try to add that product to cart from wishlist.

* #588 [Fixed] - For filter priority placeholder text should be numeric In Inventory Source grid.

* #587 [Fixed] - Layout issue in order grid of customer.

* #586 [Fixed] - Getting Exception in importing tax rates.

* #585 [Fixed] - Getting exception when using filter according to Id in Order grid.

* #581 [Fixed] - Translation issues when switching between any two languages, specifically categories in nav does not revert back.

* #575 [Fixed] - TestDataGrid does not exist

* #560 [Fixed] - Buy Now Issue on Demo.

* #556 [Fixed] - Getting Incorrect Grandtotal and delivery charge at checkout page if currency use is other than default.

* #555 [Fixed] - Negative numbers and zero is not required in filter for Id.

* #553 [Fixed] - Showing error on wrong field while using country type field in case of required.

* #551 [Fixed] - Able to delete root category.

* #546 [Fixed] - Getting exception while uploading category image after installing project using installer.

* #545 [Fixed] - Installer doesn't launch admin panel of framework.

* #534 [Fixed] - Product is displaying as out of stock if default Inventory is zero, while other Inventory sources have products.

* #533 [Fixed] - Displaying incorrect number of product on front-end.

## **v0.1.4 (4th of Febuary, 2019)** - *Release*

* [fixed] - Customer account menu issue fixed.

* [fixed] - Channel's homepage content updated.

## **v0.1.4-BETA4 (4th of Febuary, 2019)** - *Release*

* [feature] - Product flat, a product subsystem for faster product search, filter & sort on the storefront.

* [feature] - Configurations loaded up in admin panel for almost all necessary things such as payments, shipments, etc.

* [feature] - Faster and efficiently refactored datagrids for showing listing data.

* #532 [fixed] - Pagination should not display if there is no product on other page.If 9 products are selected to show on a single page then until the limit reach pagination should not occur.

* #531 [fixed] - Do not use short form of any words for notification.

* #530 [fixed] - Unable to delete any of the created attributes.Getting validation message that attribute is used in configurable product while attribute is not used for creating any product.

* #524 [fixed] - Getting Exception when login with user having custom role(ACL issue).

* #523 [fixed] - Status column of review page remains blank if Status is change to disapprove(Mass update).

* #519 [fixed] - Status column of Review remains blank if review is in Pending state.

* #514 [fixed] - Getting exception on changing the Status of Product(On mass update).

* #513 [fixed] - Getting Exception in deleting categories.

* #508 [fixed] - Correct the required php version in installer.

* #506 [fixed] - While Installing the framework through installer if at any stage user click on back button and then click on continue to install, then in this case unable to install.

* #457 [fixed] - Admin add product "Undefined variable: configurableFamily".

* #453 [fixed] - Installation of Master Branch.

* #438 [fixed] - Simple Select Attribute Issue

* #426 [fixed] - php artisan down does not work.

* #402 [fixed] - Change the validation message on moving product from wish-list to cart if product added in wish-list is out of stock.

* #399 [fixed] - Accepting future date of birth for customer.

* #396 [fixed] - Layout issue on changing locale.

* #381 [fixed] - On front-end currency symbol display only for Indian Rupee and USD. If code is selected other than these two in currency then code displays before price.

* #378 [fixed] - Images that are applied on category doesn't display in Edit Category Page.

* #369 [fixed] - Displaying incorrect response message on updating the Status of products.

* #368 [fixed] - If products are added in shopping cart and those product get deleted from admin section then it still displays in cart.

* #363 [fixed] - Unable to delete last tax rate.

* #353 [fixed] - Getting exception in deleting currency.

* #347 [fixed] - Pricing Issue.

* #334 [fixed] - My Account Grid displays blank after the bagisto 0.1.2 installation.

* #304 [fixed] - If a current user want to delete his account then in this case a password verification should be required before deleting the user.

* #301 [fixed] - Only customer that are on first page get exported.

* #191 [fixed] - Add a column Shipped to in Order Grid ,to display the name for whom order has been shipped.

* #143 [fixed] - If user login from checkout page, then it should redirect to checkout page.

## **v0.1.3 (20th of December, 2018)** - *Release*

* [feature] Mass selection features had been implemented in datagrid for deletion and mass updation purposes

* [feature] New filter for boolean values like active/inactive or true/false and date values native filters added in datagrid, can be seen in product grid and other data grids of admin section

* [feature] Core configuration section had been implemented so that all the sytem's core settings can be managed from a single place inside admin panel

* [critical fix] XSS vulnerability fix for datagrid thanks to anonymous user for informing

* [fixes] Optimized exception handler (thanks to @AliN11)

* #332 [fixed] Unable to change the Status of user

* #326 [enhanced] Only customer that are on first page get exported

* #324 [enhanced] Change the Button title "Create Tax Rate" to "Save Tax Rate" on Tax Rate page

* #315 [fixed] Getting exception if time taken to subscribe for newsletter increases.Add email validation in newsletter field

* #314 [fixed] No success message after deleting the News Letter Subscribers

* #308 [fixed] Accepting the future date of birth in Customer Grid

* #307 [fixed] Incorrect success message after updating the News Letter Subscribers

* #306 [enhanced] Customers display randomly irrespective of their id

* #305 [fixed] Displaying incorrect role name in account

* #301 [fixed] Only customer that are on first page get exported

* #298 [enhanced] Provide an Option to delete all reviews in Review section of a customer

* #295 [fixed] Unable to change gender of customers from Edit Customer Page

* #287 [fixed] No Status for Order, in customer order grid if Order is placed using "Paypal Standard Payment" method

* #286 [fixed] Unable to update attribute

* #285 [enahanced] Add export functionality for Orders, Invoice and Shipment

* #284 [fixed] Issue with price field.Accepting string also, and if space is provided between two number(5 4) than the price of product is displaying as 5 on frontend

* #283 [fixed] Unable to copy text from any grid

* #279 [fixed] If Inventory source is not selected as active then also after saving it, its status changes to Active

* #278 [fixed] Images that are applied on category doesn't display in Edit Category Page

* #277 [fixed] No email and number validation in Inventory Source Grid

* #276 [fixed] Description started from centre in Categories and Tax Category

* #275 [enhanced] Recent Orders, Shipment and Invoice should display first in grid

* #273 [fixed] Add a validation on price field that it should be numeric on Edit Product Page

* #272 [fixed] Getting exception when click on Save Invoice

* #271 [fixed] Provide little space between line and text in review section(frontend)

* #269 [fixed] Weight of Product is displaying in negative

* #268 [enhanced] Newly Created Product should display first in Product Grid

* #267 [enhanced] Add Pagination for search page on frontend

* #264 [enhanced] Provide mass delete and mass update option in product grid

* #263 [enhanced] Filter for visible in menu is not working in Category grid.

* #262 [fixed] System attributes are also getting deleted

* #260 [fixed] Layout issue in Order Status

* #238 [enhanced] Provide a mass selection option to approve a review

* #228 [enhanced] Bagisto icon should be clickable and by clicking on it, it should redirect to dashboard

* #226 [fixed] Correct the spelling of "expensive" in Sort By

* #213 [fixed] View all link is not required on Rating and Review page

* #209 [enhanced] Add filter according to date in order grid

* #204 [enhanced] A pop-up confirmation should display before deleting an address

* #199 [enhanced] Add button and filter dropdown should be aligned.Changes required in every grid

* #190 [fixed] Add a default group General in "Customer Group" grid and by default customer should lay in this group

* #187 [enhanced] We can add column "Group Name" instead of Group Id and also add this column in filter in Customers Grid

* #183 [enhanced] In Target Currency dropdown , currencies for which rate has already been set should not display in dropdown

* #182 [fixed] Layout issue on Add Exchange Rate page

* #165 [fixed] If a Product is selected as disabled at time of creation,then also it is visible at store front

* #155 [enhanced] If a customer writes any review for product then that review is not visible in review section of customer profile until it is approved by admin

* #128 [enhanced] Calender icon should also be clickable,and on click calender should display

## **v0.1.2 (30th of November, 2018)** - *Release*

* [feature] Paypal integration for online payments

* [feature] Newsletter subscription

* [feature] Email Verification for customers

* [feature] News letter grid for Admin

* #247 - [fixed] Displaying wrong number of products and sales in category, on dashboard

* #245 - [fixed] Add Sales and Customers also in Custom Permission option of Access Control

* #244 - [fixed] Getting exception when applying sorting on Tax Rate

* #242 - [fixed] Confirmation message should be "Do you really want to edit this record?", on editing slider

* #237 - [fixed] Incorrect response message after deleting product from wishlist

* #236 - [fixed] Incorrect response message after removing a product from cart

* #235 - [fixed] User name should display on account dropdown(In case of signed-in user)

* #232 - [added] Add sorting functionality in column "Name" of Inventory Grid

* #230 - [added] Add Sorting functionality on column "Status" of Product Grid

* #229 - [added] Add sorting functionality on Column "Type" in Product Grid, so that product can be sorted according to type

* #225 - [fixed] Slider button should display as clickable on mouse hover

* #224 - [fixed] Status column in invoice remains blank

* #216 - [added] Add a Column "Channel" to verify from which channel order has been placed and also add this column in filter

* #207 - [fixed] Two button are not required to save address

* #206 - [fixed] Correct the confirmation message in pop-up when click on Edit User

* #202 - [fixed] Correct the background text of filter field in Taxes grid.Text should be according to selected column(placeholder)

* #201 - [fixed] Getting exception when applying filter in slider

* #200 - [fixed] Getting exception when applying filter on Exchange Rates grid

* #192 - [fixed] Not able to checkout with different shipping address

* #188 - [fixed] Unable to delete Customer Group

* #187 - [fixed] We can add column "Group Name" instead of Group Id and also add this column in filter in Customers Grid

* #185 - [fixed] Search not working in responsive mode

* #184 - [fixed] Product page mandatory fields are missing '*' or asterisk as failing to indicate required field and inappropriate validation message

* #181 - [fixed] Change the column name in filter from "Target Currency" to "Currency Name"

* #180 - [fixed] Not accepting the code for Currency if it is already used in locales

* #178 - [fixed] Change the Column Name

* #177 - [fixed] Getting exception when clicking on column locale

* #175 - [fixed] Getting exception in deleting attributes

* #174 - [fixed] Getting exception while applying filter on category page

* #173 - [fixed] Getting 500 Internal Server Error on Updating taxes

* #172 - [fixed] Getting 500 Internal Server Error on updating Users

* #166 - [fixed] Getting 404 error on deleting order

* #165 - [fixed] If a Product is selected as disabled at time of creation,then also it is visible at store front

* #165 - [feature] No grid is available in back-end to manage Newsletter

* #164 - [fixed] Loss of data from content field of Slider

* #162 - [fixed] No response when click on "Add to Cart" for configurable product on home page and category page

* #162 - [fixed] No response when click on "Add to Cart" for configurable product on home page and category page

* #161 - [fixed] Inappropriate validation message(System wide fix is applied for validation messages)

* #157 - [fixed] Old password check in edit profile ain't working for customers

* #154 - [fixed] While creating channel Description field,Home Page Content and footer _content is required, but it doesn't throw any validation error if we leave that field blank

* #151 - [fixed] Description and Short description field are throwing validation error message even if description is written

* #150 - [fixed] If currency changes on store front then on admin panel in Order Grid currency changes according to store front

* #149 - [fixed] Getting exception in creating configurable product.

* #148 - [fixed] Search Functionality is not working in all grid of Admin panel

* #146 - [fixed] Tax is not added on product at checkout

* #145 - [fixed] Edit Functionality of Tax Categories is not Working

* #144 - [fixed] "Move All Products To Cart" and "Delete All" link is not working in Wishlist grid(Move all products to cart is removed and delete all works now)

* #142 - [fixed] Correct the spelling of "default" in theme

* #141 - [fixed] Subscribe button on storefront is unresponsive

* #139 - [fixed] Encountered exception while changing locale on storefront

* #137 - [fixed] By default Gender is selected as Male for every customer

* #134 - [fixed] Unable to login with the user account that is created in user grid with custom access

* #133 - [fixed] Add asterisk symbol for email field in Add User page

* #132 - [fixed] Issue in Mass Deletion.This issue exists for every grid(mass actions will return in next release and the issue will remain open till next release)

* #129 - [fixed] Getting issue when deleting orders.Mass action is not working in any grid(Getting Internal server error) while updating Status (mass actions will return in next release and the issue will remain open till next release)

* #126 - [fixed] Add asterisk symbol on SKU field

* #125 - [fixed] Delete button is not available for mass delete of Products in Product Grid(mass actions will return in next release and the issue will remain open till next release)

* #121 - [fixed] Buy now button is not working on index page for some products

* #120 - [fixed] After signup on the frontend, the customer is still not the signup page

* #119 - [fixed] Set value in the login form fields(on Demo)

* [fixes] More ACL added.

## **v0.1.1 (13th of November, 2018)** - *Release*

* #114 - [fixed] Invoice printing added as a feature

* #98 - [fixed] No warning before removing the item from the cart

* #97 - [fixed] Client side validation / js validation is missing at login page

* #96 - [fixed] Search button does not work(@prashant-webkul)

* #95 - [fixed] Buy Now Button does not work(@prashant-webkul)

* #94 - [fixed] Sign-in page shows signup text(@prashant-webkul)

* [fixed] Email Templates logo issue fixed(@jitendra-webkul)

* [fixed] Front Search issue fixed due to hardcoded attribute code in search criteria(@jitendra-webkul)

* [changed] Versioning of core packages

* [fixed] Buynow validation fixes(@jitendra-webkul)

* [feature] New action type added in datagrid

* [feature] Loader added in storefront product page

* [fixed] Tax rates and categories form fixes(@jitendra-webkul)

* [feature] Country state selector added where country and states were there originally in release v0.1.0

* [feature] Multiple addresses for customers with CRUD

* [feature] Customer can now make any of his/her existing address a default address

* [fixed] Customer address 2 form field validation required changed to optional(@jitendra-webkul)

* [fixed] Tax rates validation fixes for zip ranges(@prashant-webkul)

* [changed] Core packages composer file parameter name changed from namespace webkul to bagisto

* [feature] Payment package added in core packages

* [feature] Sales module added in admin with orders, invoices and shipments with datagrid

* [feature] Functionality to indicate the new and featured product in the product's add and edit form

* [feature] Cart actions more faster in storefront

* [changed] Responsive styles refined and extended for checkout pages on storefront

* [fixed] Various UI/UX fixes in store front styles and layouts(@prashant-webkul & @jitendra-webkul)

## **v0.1.0 (30th of October 2018)** - *First Release*

* [feature] Add and modify product with simple and configurable types

* [feature] Add and modify attributes and attribute families for creating products

* [feature] Datagrid for all the major core resources added as index for listing core resources like product, attributes

* [feature] Add and modify channels for creating multiple storefront

* [feature] Add and modify categories to be displayed on storefront

* [feature] Add and modify customers

* [feature] Add and modify customer groups

* [feature] Add and modify customer reviews for moderation by admin

* [feature] Add and modify currently logged in admin user details

* [feature] Add and modify locales for multiple languages support system wide

* [feature] Add and modify currencies to be used in channels

* [feature] Add and modify currency exchange rate for the stores accepting multiple currencies or using multiple channels

* [feature] Add and modify inventory sources with priority to hold products quantities in real time

* [feature] Add and modify channels

* [feature] Add and modify user from admins access with customer roles

* [feature] Add and modify customer roles for users

* [feature] Add and modify slider for storefront as a CMS capability

* [feature] Add and modify tax categories and tax rates

* [feature] Shopping cart in storefront

* [feature] Wishlist for customer

* [feature] Single address for customer

* [feature] Customer can see his reviews in his account section when logged in

* [feature] Customer profile edit feature account section when logged in

* [feature] Customer can view his orders in account section when logged in

* [feature] Customer order notifications via mails

* [feature] Multiple locales and currencies on storefront

* [feature] Locale translations are stored as a separate file in shop and admin packages

* [feature] Single page checkout system for checkout

* [feature] Custom themes and assets provisioning included as a integrated package called "theme" in packages
