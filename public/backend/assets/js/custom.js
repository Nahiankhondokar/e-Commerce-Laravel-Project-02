(function ($) {
    $(document).ready(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        // Data Table js file
        $("#section").DataTable();
        $("#category").DataTable();
        $("#dataTable").DataTable();

        // ============= Csrf Token Post Type Error Resolve ===========
        // csrf token will not show any error when we pass POST type data through ajax.
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        //===================== section Scripts =====================

        // section status active inactive update script
        $(document).on("click", ".sectionActiveInactive", function () {
            let text = $(this).text();
            let section_id = $(this).attr("section_id");

            $.ajax({
                url: "/admin/section/active-inactive",
                type: "get",
                data: { text, section_id },
                success: function (data) {
                    if (data == "active") {
                        $("#section-" + section_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)">Active</a>'
                        );
                        $("#active-btn" + section_id).hide();
                    } else {
                        $("#section-" + section_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>'
                        );
                        $("#inactive-btn" + section_id).hide();
                    }
                },
            });
        });

        //===================== Category level Scripts =====================

        // Category leve load automatically select on category section
        $(document).on("change", "#categorySection", function () {
            let section_id = $(this).val();
            // alert(section_id);

            $.ajax({
                url: "/admin/get/categroy/section/wise",
                type: "get",
                data: { section_id },
                success: function (data) {
                    $("#appendCategoriesLavel").html(data);
                },
            });
        });

        // Edit Category leve load automatically select on category section
        $(document).on("change", "#editCategorySection", function () {
            let section_id = $(this).val();
            // alert(section_id);

            $.ajax({
                url: "/admin/get/edit/categroy/section/wise",
                type: "get",
                data: { section_id },
                success: function (data) {
                    $("#editAppendCategoriesLavel").html(data);
                },
            });
        });

        // category status active inactive update script
        $(document).on("click", ".categoryActiveInactive", function () {
            let text = $(this).text();
            let category_id = $(this).attr("category_id");

            $.ajax({
                url: "/admin/category/active-inactive",
                type: "get",
                data: { text, category_id },
                success: function (data) {
                    if (data == "active") {
                        $("#category-" + category_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)">Active</a>'
                        );
                        $("#cat_active-btn" + category_id).hide();
                    } else {
                        $("#category-" + category_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>'
                        );
                        $("#cat_inactive-btn" + category_id).hide();
                    }
                },
            });
        });

        //===================== product video image sweet alert Scripts ======================

        // sweet alert show for product video or image delete
        $(document).on("click", "#video_img_delete", function (e) {
            e.preventDefault();

            // user id
            let product_id = $(this).attr("product_id");
            let text = $(this).attr("text");

            // alert(text)

            // alert
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
                    // delete image
                    $.ajax({
                        url: "/admin/product/main_img/video/delete/ajax",
                        type: "get",
                        data: { product_id, text },
                        success: function (data) {
                            if (data == "image") {
                                $(".product_edit_image").slideUp();
                                $(".old_image_hide").attr("value", "");
                            } else {
                                $(".product_video_edit").slideUp();
                                $(".old_video_hide").attr("value", "");
                            }
                        },
                    });
                }
            });
        });

        // product status active inactive update script
        $(document).on("click", ".productActiveInactive", function () {
            let text = $(this).text();
            let product_id = $(this).attr("product_id");

            $.ajax({
                url: "/admin/product/active-inactive",
                type: "get",
                data: { product_id },
                success: function (data) {
                    if (data == "active") {
                        $("#product-" + product_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)">Active</a>'
                        );
                        $("#product_active-btn" + product_id).hide();
                    } else {
                        $("#product-" + product_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>'
                        );
                        $("#product_inactive-btn" + product_id).hide();
                    }
                },
            });
        });

        //===================== product attribute Scripts ======================

        // Add new field for product attribute
        // add row
        $("#addRow").click(function () {
            var html = "";
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html +=
                '<input type="text" name="size[]" class="form-control m-input" placeholder="Size" autocomplete="off">';
            html +=
                '<input type="number" name="price[]" class="form-control m-input" placeholder="price" autocomplete="off">';
            html +=
                '<input type="number" name="stock[]" class="form-control m-input" placeholder="stock" autocomplete="off">';
            html +=
                '<input type="text" name="sku[]" class="form-control m-input" placeholder="SKU" autocomplete="off">';
            html += '<div class="input-group-append">';
            html +=
                '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += "</div>";
            html += "</div>";

            $("#newRow").append(html);
        });
        // remove row
        $(document).on("click", "#removeRow", function () {
            $(this).closest("#inputFormRow").remove();
        });

        // product attribute status active inactive update script
        $(document).on("click", ".productAttrActiveInactive", function () {
            let text = $(this).text();
            let product_attr = $(this).attr("product_attr");

            $.ajax({
                url: "/admin/product/attr/active-inactive",
                type: "get",
                data: { product_attr },
                success: function (data) {
                    if (data == "active") {
                        $("#product_attr-" + product_attr).html(
                            '<a class="badge badge-success"  href="javascript:void(0)">Active</a>'
                        );
                        $("#product_attr_active-btn" + product_attr).hide();
                    } else {
                        $("#product_attr-" + product_attr).html(
                            '<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>'
                        );
                        $("#product_attr_inactive-btn" + product_attr).hide();
                    }
                },
            });
        });

        //===================== product gallery Scripts ======================

        // product gallery status active inactive update script
        $(document).on("click", ".productGallActiveInactive", function () {
            let product_gall = $(this).attr("product_gall");

            $.ajax({
                url: "/admin/product/gallery/active-inactive",
                type: "get",
                data: { product_gall },
                success: function (data) {
                    if (data == "active") {
                        $("#product_gall-" + product_gall).html(
                            '<a class="badge badge-success"  href="javascript:void(0)">Active</a>'
                        );
                        $("#product_gall_active-btn" + product_gall).hide();
                    } else {
                        $("#product_gall-" + product_gall).html(
                            '<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>'
                        );
                        $("#product_gall_inactive-btn" + product_gall).hide();
                    }
                },
            });
        });

        //===================== Product Barnd Scripts ======================

        //product brand add
        $(document).on("submit", "#productBrandAdd", function (e) {
            e.preventDefault();

            let brand = $("#brand_name").val();

            $.ajax({
                url: "/admin/product/brand/add/edit/",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (d) {
                    allProductBrand();
                    $("#productBrandAdd").modal("hide");
                },
            });
        });

        // product Brand status active inactive update script
        $(document).on("click", ".brandActiveInactive", function () {
            let brand_id = $(this).attr("brand_id");
            // alert(brand_id);

            $.ajax({
                url: "/admin/product/brand/active-inactive",
                type: "get",
                data: { brand_id },
                success: function (data) {
                    if (data == "active") {
                        $("#brand-" + brand_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>'
                        );
                        $("#brand_active-btn" + brand_id).hide();
                    } else {
                        $("#brand-" + brand_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>'
                        );
                        $("#brand_inactive-btn" + brand_id).hide();
                    }
                },
            });
        });

        // product brand edit
        $(document).on("click", "#productBrandEditBtn", function (e) {
            e.preventDefault();

            let brand_id = $(this).attr("edit_id");
            // alert(brand_id);

            $.ajax({
                url: "/admin/product/brand/single/edit/" + brand_id,
                success: function (data) {
                    $("#productBrandEdit").modal("show");
                    $("#productBrandEdit #brand_name").val(data.name);
                    $("#productBrandEdit #edit_id").val(data.id);
                    // alert(d.name);
                },
            });
        });

        // product brand update
        $(document).on("submit", "#productBrandUpdate", function (e) {
            e.preventDefault();

            // let brand_name = $('#brand_name').val();
            let brand_id = $(this).attr("edit_id");

            // alert(brand_name - brand_id);

            $.ajax({
                url: "/admin/product/brand/add/edit/" + brand_id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (d) {
                    allProductBrand();
                    $("#productBrandEdit").modal("hide");
                    // alert(d);
                },
            });
        });

        // product brand delete sweet alert
        $(document).on("click", "#deleteBrand", function (e) {
            e.preventDefault();

            let delete_id = $(this).attr("delete_id");

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
                        url: "/admin/product/brand/delete/" + delete_id,
                        success: function (data) {
                            allProductBrand();
                        },
                    });
                }
            });
        });

        //===================== Banner Scripts ======================

        // Banner add
        $(document).on("submit", "#bannerStore", function (e) {
            e.preventDefault();
            // Swal('all fields are require');

            let tittle = $("#tittle").val();
            let image = $("#image").val();

            // alert(image);

            // validation
            if (!image || !tittle) {
                $.ajax({
                    url: "/admin/banner/add/edit/",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (d) {
                        allBanner();
                        $("#bannerAdd").modal("hide");
                        e.target.reset();
                        $("#imgPriview").attr("src", " ");
                    },
                });
            } else {
                Swal.fire("Title & Image are required");
            }
        });

        // Banner status active inactive update script
        $(document).on("click", ".bannerActiveInactive", function () {
            let banner_id = $(this).attr("banner_id");
            // alert(banner_id);

            $.ajax({
                url: "/admin/banner/active-inactive",
                type: "get",
                data: { banner_id },
                success: function (data) {
                    // alert(data);
                    if (data == "active") {
                        $("#banner-" + banner_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>'
                        );
                        $("#banner_active-btn" + banner_id).hide();
                    } else {
                        $("#banner-" + banner_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>'
                        );
                        $("#banner_inactive-btn" + banner_id).hide();
                    }
                },
            });
        });

        // Banner edit
        $(document).on("click", "#bannerEditBtn", function (e) {
            e.preventDefault();

            let banner_id = $(this).attr("edit_id");
            // alert(brand_id);

            $.ajax({
                url: "/admin/banner/single/edit/" + banner_id,
                success: function (data) {
                    $("#BannerEdit").modal("show");
                    $("form input#update_id").val(data.id);
                    $("form input#link").val(data.link);
                    $("form input#alt").val(data.alt);
                    $("form input#tittle").val(data.title);
                    $("form input#old_image").val(data.image);
                    $("img#editImgPreview").attr(
                        "src",
                        `http://127.0.0.1:8000/media/backend/banner/${data.image}`
                    );
                    // alert(d.name);
                },
            });
        });

        // Banner update
        $(document).on("submit", "#BannerUpdate", function (e) {
            e.preventDefault();

            $.ajax({
                url: "/admin/banner/add/edit/",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    allBanner();
                    $("#BannerEdit").modal("hide");
                    e.target.reset();
                    // alert(d);
                },
            });
        });

        // product brand delete sweet alert
        $(document).on("click", "#deleteBanner", function (e) {
            e.preventDefault();

            let delete_id = $(this).attr("delete_id");

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
                        url: "/admin/banner/delete/" + delete_id,
                        success: function (data) {
                            allBanner();
                        },
                    });
                }
            });
        });

        //===================== Coupon Status UPdate Scripts ======================
        $(document).on("click", ".couponActiveInactive", function () {
            let coupon_id = $(this).attr("coupon_id");
            // alert(coupon_id); return false;

            $.ajax({
                url: "/admin/coupon/active-inactive",
                type: "get",
                data: { coupon_id },
                success: function (data) {
                    // alert(data);
                    if (data == "active") {
                        $("#coupon-" + coupon_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>'
                        );
                        $("#coupon_active-btn" + coupon_id).hide();
                    } else {
                        $("#coupon-" + coupon_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>'
                        );
                        $("#coupon_inactive-btn" + coupon_id).hide();
                    }
                },
            });
        });

        //===================== Coupon input feild show ======================
        $(document).on("click", "#Manual", function () {
            $("#couponFeild").css("display", "block");
        });

        $(document).on("click", "#Automatic", function () {
            $("#couponFeild").css("display", "none");
        });

        //===================== Datemask dd/mm/yyyy======================
        $("#datemask").inputmask("dd/mm/yyyy", { placeholder: "dd/mm/yyyy" });
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", { placeholder: "mm/dd/yyyy" });
        //Money Euro
        $("[data-mask]").inputmask();

        // =========== order Curiere or Traking NO show/hide ============
        $(document).on("change", "#order_status", function () {
            // alert();
            const status = $(this).val();
            if (status == "Shipped") {
                $("#courier_name").css({ display: "block" });
                $("#traking_number").css({ display: "block" });
            } else {
                $("#courier_name").css({ display: "none" });
                $("#traking_number").css({ display: "none" });
            }
        });

        //===================== section Scripts =====================
        $(document).on("click", ".shippeActiveInactive", function () {
            let text = $(this).text();
            let shippe_id = $(this).attr("shippe_id");

            $.ajax({
                url: "/admin/shippe/active-inactive",
                type: "get",
                data: { text, shippe_id },
                success: function (data) {
                    if (data == "active") {
                        $("#shippe-" + shippe_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)">Active</a>'
                        );
                        $("#active-btn" + shippe_id).hide();
                    } else {
                        $("#shippe-" + shippe_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>'
                        );
                        $("#inactive-btn" + shippe_id).hide();
                    }
                },
            });
        });

        //===================== User Status UPdate Scripts ======================
        $(document).on("click", ".userActiveInactive", function () {
            let user_id = $(this).attr("user_id");
            // alert(user_id); return false;

            $.ajax({
                url: "/admin/user/active-inactive",
                type: "get",
                data: { user_id },
                success: function (data) {
                    // alert(data);
                    if (data == "active") {
                        $("#user-" + user_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>'
                        );
                        $("#user_active-btn" + user_id).hide();
                    } else {
                        $("#user-" + user_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>'
                        );
                        $("#user_inactive-btn" + user_id).hide();
                    }
                },
            });
        });

        //===================== CMS Status UPdate Scripts ======================
        $(document).on("click", ".CMSActiveInactive", function () {
            let CMS_id = $(this).attr("CMS_id");
            // alert(user_id); return false;

            $.ajax({
                url: "/admin/CMS/active-inactive",
                type: "get",
                data: { CMS_id },
                success: function (data) {
                    // alert(data);
                    if (data == "active") {
                        $("#CMS-" + CMS_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>'
                        );
                        $("#CMS_active-btn" + CMS_id).hide();
                    } else {
                        $("#CMS-" + CMS_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>'
                        );
                        $("#CMS_inactive-btn" + CMS_id).hide();
                    }
                },
            });
        });

        //===================== Rating Status UPdate Scripts ======================
        $(document).on("click", ".ratingActiveInactive", function () {
            let rating_id = $(this).attr("rating_id");
            // alert(admin_id); return false;

            $.ajax({
                url: "/admin/rating/active-inactive",
                type: "get",
                data: { rating_id },
                success: function (data) {
                    // alert(data);
                    if (data == "active") {
                        $("#rating-" + rating_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>'
                        );
                        $("#rating_active-btn" + rating_id).hide();
                    } else {
                        $("#rating-" + rating_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>'
                        );
                        $("#rating_inactive-btn" + rating_id).hide();
                    }
                },
            });
        });

        //===================== Currencie Status UPdate Scripts ======================
        $(document).on("click", ".currencieAtiveInactive", function () {
            let currencie_id = $(this).attr("currencie_id");
            // alert(admin_id); return false;

            $.ajax({
                url: "/admin/currencie/active-inactive",
                type: "get",
                data: { currencie_id },
                success: function (data) {
                    // alert(data);
                    if (data == "active") {
                        $("#currencie-" + currencie_id).html(
                            '<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>'
                        );
                        $("#currencie_active-btn" + currencie_id).hide();
                    } else {
                        $("#currencie-" + currencie_id).html(
                            '<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>'
                        );
                        $("#currencie_inactive-btn" + currencie_id).hide();
                    }
                },
            });
        });

        //===================== Currencie Status UPdate Scripts ======================
        $(document).on("click", ".returnRequestInfo", function (e) {
            e.preventDefault();

            let user_id = $(this).attr("user_id");
            let order_id = $(this).attr("order_id");
            let product_size = $(this).attr("product_size");
            let product_code = $(this).attr("product_code");
            let return_reason = $(this).attr("return_reason");
            let comment = $(this).attr("comment");
            let return_id = $(this).attr("return_id");
            let status = $(this).attr("status");
            // alert(return_reason);
            // return false;

            $.ajax({
                url: "/admin/update/return-order-request/" + return_id,
                type: "get",
                data: {
                    status,
                },
                success: function (data) {
                    // alert(data);
                    if (data == "Approved") {
                        swal.fire("Return Request Approved");
                        $(".returnRequestUpdate-" + return_id).text("Approved");
                    } else {
                        swal.fire("Return Request Rejected");
                        $(".returnRequestUpdate-" + return_id).text("Rejected");
                    }
                },
            });
        });
    });
})(jQuery);
