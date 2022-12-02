(function ($) {
    $(document).ready(function () {
        // csrf token will not show any error when we pass POST type data through ajax.
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // product filtering system by laravel
        // $(document).on('change', '#sort', function(){
        //     this.form.submit();
        //     // alert()
        // });

        // sweet alert show befor delete
        $(document).on("click", "#delete", function (e) {
            e.preventDefault();

            let link = $(this).attr("href");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });

        // product filtering system by ajax
        $(document).on("change", "#sort", function () {
            const sort = $(this).val();
            const url = $("#url").val();
            const fabric = get_filter("fabric");
            const sleeve = get_filter("sleeve");
            const fit = get_filter("fit");
            $.ajax({
                url: url,
                type: "get",
                data: { sort, url, fabric, sleeve, fit },
                success: function (data) {
                    $(".filter_products").html(data);
                },
            });
        });

        // filter by fabrics , sleeve
        $(document).on("click", ".fabric", function () {
            const sort = $("#sort option:selected").val();
            const url = $("#url").val();
            const fabric = get_filter(this);
            const sleeve = get_filter("sleeve");
            const fit = get_filter("fit");
            // console.log(this);
            $.ajax({
                url: url,
                type: "get",
                data: { sort, url, fabric, sleeve, fit },
                success: function (data) {
                    $(".filter_products").html(data);
                },
            });
        });

        // filter by fabric, sleeve
        $(document).on("click", ".sleeve", function () {
            const sort = $("#sort option:selected").val();
            const url = $("#url").val();
            const fabric = get_filter("fabric");
            const sleeve = get_filter("sleeve");
            const fit = get_filter("fit");
            // console.log(this);
            $.ajax({
                url: url,
                type: "get",
                data: { sort, url, fabric, sleeve, fit },
                success: function (data) {
                    $(".filter_products").html(data);
                },
            });
        });

        // filter by fabric, sleeve, fit
        $(document).on("click", ".fit", function () {
            const sort = $("#sort option:selected").val();
            const url = $("#url").val();
            const fabric = get_filter("fabric");
            const sleeve = get_filter("sleeve");
            const fit = get_filter("fit");
            // console.log(this);
            $.ajax({
                url: url,
                type: "get",
                data: { sort, url, fabric, sleeve, fit },
                success: function (data) {
                    $(".filter_products").html(data);
                },
            });
        });

        // function for filtering
        function get_filter(cls_name) {
            let filterArr = [];
            // console.log(`.${cls_name}:checked`);

            $("." + cls_name + ":checked").each(function () {
                filterArr.push($(this).val());
                // alert($(this).val());
            });

            return filterArr;
            // console.log(filterArr);
        }

        // get price product size wise
        $(document).on("change", "#getPrice", function () {
            const size = $(this).val();
            const product_id = $("#getPrice").attr("product_id");
            // alert(size + product_id);

            if (size) {
                $.ajax({
                    url: "/get-price-by-product-size",
                    type: "get",
                    data: { size, product_id },
                    success: function (data) {
                        // alert(data['attrDiscountPrice']); return false;
                        if (
                            data["getDiscount"]["attrDiscountPrice"] !=
                            data["getDiscount"]["attrPrice"].price
                        ) {
                            $(".currencie_items").hide();
                            $(".getAttrPriceWithDiscount").html(
                                `<del>$${data["getDiscount"]["attrPrice"].price}</del> - $${data["getDiscount"]["attrDiscountPrice"]} ${data.currencie} `
                            );
                        } else {
                            $(".currencie_items").hide();
                            $("#getAttrPriceWithOutDiscount").text(
                                "$" +
                                    data["getDiscount"]["attrDiscountPrice"] +
                                    data.currencie
                            );
                        }

                        // alert(data.price);
                    },
                });
            } else {
                $(".getAttrPrice").text(00);
            }
        });

        // =========== cart page qty increment or decrement ============
        $(document).on("click", ".btnItemUpdate", function () {
            let new_qty = 0;

            // decrement button
            if ($(this).hasClass("qtyDecrement")) {
                let qty = $(this).prev().val();
                if (qty == 1) {
                    swal.fire("You can not decrement your Produdct item");
                } else {
                    new_qty = parseInt(qty) - 1;
                }
            }

            // increment button
            if ($(this).hasClass("qtyIncrement")) {
                let qty = $(this).prev().prev().val();
                new_qty = parseInt(qty) + 1;
            }

            const cartId = $(this).attr("cartId");
            // alert(cartId); return false;
            $.ajax({
                url: "/update/cart-item-qty",
                data: { cartId, new_qty },
                success: function (data) {
                    // alert(data); return false;
                    if (data.status == false) {
                        swal.fire("Product Stock is not available !");
                    }
                    // console.log(data);
                    $(".totalCartItem").html(data.totalCartItem);
                    $("#appendCartItem").html(data.view);
                },
            });
        });

        // =========== cart item Delete ============
        $(document).on("click", ".cartitemDelete", function () {
            // get cart id
            const cart_id = $(this).attr("cartId");
            // alert(cart_id);

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/delete-cart-item",
                        data: { cart_id },
                        success: function (data) {
                            // console.log(data);
                            $(".totalCartItem").html(data.totalCartItem);
                            $("#appendCartItem").html(data.view);
                            swal.fire("Cart Product Deleted");
                        },
                    });
                }
            });
        });

        // =========== validate Registration form on keyup and submit ============
        $("#registerForm").validate({
            rules: {
                name: "required",
                phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
                password: {
                    required: true,
                    minlength: 5,
                },
                email: {
                    required: true,
                    email: true,
                    remote: "check-email",
                },
            },
            messages: {
                name: "Please enter your name",
                phone: {
                    required: "Please enter a phone",
                    minlength: "Your phone number must have 11 digits",
                    maxlength: "Your phone number must have 11 digits",
                },
                password: {
                    required: "Please provide a password",
                },
                email: {
                    required: "Please enter a valid email address",
                    remote: "Email Already Exists",
                },
            },
        });

        // =========== validate Login form on keyup and submit ============
        $("#loginForm").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5,
                },
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                password: {
                    required: "Please enter password",
                },
                email: {
                    required: "Please enter email address",
                },
            },
        });

        // =========== user contact details form validation ============
        $("#UserContactForm").validate({
            rules: {
                name: "required",
                phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
            },
            messages: {
                name: "Please enter your name",
                phone: {
                    required: "Please enter a phone",
                    minlength: "Your phone number must have 11 digits",
                    maxlength: "Your phone number must have 11 digits",
                },
            },
        });

        // =========== user password update ============
        $(document).on("keyup", "#current_pass", function () {
            // get cart id
            const curr_pass = $(this).val();
            // alert(curr_pass); return false;

            $.ajax({
                url: "/user/password-check",
                data: { curr_pass },
                success: function (data) {
                    // alert(data)
                    // console.log(data);
                    if (data == true) {
                        $("#alert-msg").html(
                            `<p style="color: green;">Password Match</p>`
                        );
                    } else {
                        $("#alert-msg").html(
                            `<p style="color: red;">Password Does Not Match</p>`
                        );
                    }
                },
            });
        });

        // =========== user password change validation ============
        $("#passUpdateForm").validate({
            rules: {
                current_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 6,
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                },
            },
            messages: {
                current_password: {
                    required: "Current Password is required",
                },
                new_password: {
                    required: "New Password is required",
                    minlength: "Your phone number must have 6 digits",
                },
                confirm_password: {
                    required: "Confirm Password is required",
                    minlength: "Your phone number must have 6 digits",
                },
            },
        });

        // =========== Coupn apply scripts ============
        $(document).on("submit", "#applyCoupon", function (e) {
            e.preventDefault();

            const user = $(this).attr("user");
            const code = $("#code").val();
            // alert(user);

            if (user == 1) {
                $.ajax({
                    url: "/user/coupon-apply",
                    type: "post",
                    data: { code },
                    success: function (res) {
                        // alert(res.message);
                        if (res.status == false) {
                            swal.fire(res.message);
                            $(".couponDiscount").html("$00");
                            $(".grandTotal").html("$" + res.totalAmount);
                        }

                        if (res.status == true) {
                            $(".totalCartItem").html(res.totalCartItem);
                            $("#appendCartItem").html(res.view);
                            $(".couponDiscount").html("$" + res.couponDiscount);
                            $(".grandTotal").html(
                                "$" + res.AfterCouponDiscount
                            );
                            // alert(res.AfterCouponDiscount);
                            swal.fire(res.message);
                            $("#code").val("");
                        }
                    },
                });
            } else {
                swal.fire("Login First to Add Coupon");
            }
        });

        // =========== Delivery Address form validation  ============
        $("#DeliveryAddressForm").validate({
            rules: {
                name: "required",
                address: "required",
                city: "required",
                country: "required",
                pincode: "required",
                phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
            },
            messages: {
                name: "Please enter your name",
                address: "Please enter your address",
                city: "Please enter your city",
                country: "Please enter your country",
                pincode: "Please enter your pincode",
                phone: {
                    required: "Please enter a phone",
                    minlength: "Your phone number must have 11 digits",
                    maxlength: "Your phone number must have 11 digits",
                },
            },
        });

        // =========== Shipping charges add ============
        $('input[name="address_id"]').bind("change", function () {
            const total_price = $(this).attr("total_price");
            const coupon_amount = $(this).attr("coupon_amount");
            const shipping_charge = $(this).attr("shipping_charge");
            const cod_pincode_count = $(this).attr("cod_pincode_count");
            const prepaid_pincode_count = $(this).attr("prepaid_pincode_count");
            // alert(coupon_amount);

            // checking postal code & COD payment method
            if (cod_pincode_count > 0) {
                // show code payment method
                $(".cod_payment").show();
                $(".err_msg").html("");
            } else {
                // hide code payment method
                $(".cod_payment").hide();
                $(".err_msg").html(
                    `<p style="color: red">Invalid Postal Code</p>`
                );
            }

            // checking postal code & Prepaid payment method
            if (prepaid_pincode_count > 0) {
                $(".prepaid_payment").show();
                $(".err_msg").html("");
            } else {
                $(".prepaid_payment").hide();
                $(".err_msg").html(
                    `<p style="color: red">Invalid Postal Code</p>`
                );
            }

            $(".shipping_charges").html(`$${shipping_charge}`);
            const grandTotal =
                parseInt(total_price) +
                parseInt(shipping_charge) -
                parseInt(coupon_amount);
            // alert( coupon_amount );
            $(".grandTotal").text(`$${grandTotal}`);
        });

        // ============== Postal code checking ===============
        $(document).on("click", "#postalCheckBtn", function () {
            const postal_code = $("#postal_code").val();
            // alert(postal_code);

            $.ajax({
                url: "/postal-code/check",
                data: { postal_code },
                success: function (data) {
                    swal.fire(data);
                },
            });
        });

        // ============== Postal code checking ===============
        $(document).on("click", "#wishlistUserLogin", function (e) {
            e.preventDefault();
            swal.fire("Login first for wishlist");
        });

        // ============== Product Rating & Review Scripts ===============
    });
})(jQuery);
