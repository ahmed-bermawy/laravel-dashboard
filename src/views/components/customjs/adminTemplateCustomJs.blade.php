<!-- Initialize Scripts -->
<script type="text/javascript">
    $(document).ready(function () {
        $(".treeview-menu").each(function () {
            if ($(this).children().hasClass('active-submenu')) {
                $(this).addClass('menu-open');
                $(this).css('display', 'block');
                $(this).parent('li.treeview').addClass('active');
            }
        });
    });
</script>

<!-- Initialize Delete Action -->
<script type="text/javascript">
    $(document).ready(function () {

        $('.delete').click(function () {
            var id = $(this).data('id');
            $(".modal-body #row_id").val(id);

            $(this).parent().parent().addClass('about_to_delete');

        });

        $('.cancel_delete').click(function () {
            $("table").find(".about_to_delete").removeClass('about_to_delete');
        });

        $('.delete_row').click(function () {

            var id = $('#row_id').val();
            var totl_result = $('#row_id').val();
            var url = $('#path').val() + id;
            // alert(url);
            // return ;
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {"_token": "{{ csrf_token() }}"},
                cache: false,
                dataType: "json",
                success: function (success_array) {
                    $("table").find(".about_to_delete").addClass('destroy_tr');
                    setTimeout(remove_tr, 1500);
                    $total = $("#totalResult").text();
                    $("#totalResult").text($total - 1);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                }

            });

        });

        function remove_tr() {
            $(".destroy_tr").remove();
        }

    });
</script>

<!-- Initialize Toggle Action -->
<script type="text/javascript">
    $(document).ready(function () {

        $('.toggle').click(function (e) {

            var id = $(this).attr("data-id");
            var col = $(this).attr("data-col");
            var table = $(this).attr("data-table");
            var pk = $(this).attr("data-pk");
            var path = $('body').data('base-path');

            $.ajax({
                url: path + "/common/toggle_active",
                type: "POST",
                data: {"_token": "{{ csrf_token() }}", id: id, col: col, table: table, pk: pk},
                cache: false,
                dataType: "json",
                success: function (success_array) {

                    $(".data-table tr[id=" + id + "]  td." + col + " p ").css("color", "green").html(success_array.returned_array == 0 ? "No" : "Yes");

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Test not working " + thrownError);
                }
            });
            e.preventDefault();
        });
    });
</script>


<!-- Initialize Change Password -->
<script type="text/javascript">
    $(document).ready(function () {

        $('.popup').click(function () {
            $(".field_error").hide();
            $("#password").val("");
            $("#confirm_password").val("");
            var id = $(this).data('id');
            var email = $(this).data('email');
            $(".modal-body #row_id").val(id);
            $(".modal-body #email").html(email);
            //$(this).parent().parent().addClass('about_to_delete');
        });

        $('.popup_validate').click(function () {
            var id = $(this).data('id');
            $(".modal-body #user_id").val(id);
        });

        //hide popup window after ajax call
        function hide_popup() {
            $(".close_popup").click();
        }

        // $('.cancel_delete').click(function () {
        //     $("table").find(".about_to_delete").removeClass('about_to_delete');
        // });

        // Change Password Via Ajax
        $('.submit_change_password').click(function () {
            $(".field_error").hide();
            var id = $('#row_id').val();
            // var path = $('body').data('base-path');
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();

            var state = Boolean();
            state = true;

            if (password === "") {
                $("#password_error").fadeIn("fast");
                state = false;
            }

            if (confirm_password === "") {
                $("#confirm_password_error").fadeIn("fast");
                state = false;
            }

            if (confirm_password !== password) {
                $("#not_match_error").fadeIn("fast");
                state = false;
            }

            if (state === true) {
                $.ajax({
                    url: '/dashboard/admins/change_password',
                    type: 'POST',
                    data: {"_token": "{{ csrf_token() }}", id: id, password: password},
                    cache: false,
                    dataType: "json",
                    success: function (success_array) {
                        //alert(success_array.msg);
                        if (success_array.status === "success") {
                            $(".modal-footer #success").html(success_array.msg);
                        } else {
                            $(".modal-footer #fail").html(success_array.msg);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        //alert("Test not working "+thrownError);
                    }
                });
                setTimeout(function () {
                    $('#btn-close').click();
                }, 3000);
            } else {
                return false;
            }

        });

        //Validate Code Via Ajax
        $('.submit_validate_account').click(function () {
            $(".field_error").hide();
            var id = $('#user_id').val();
            var path = $('body').data('base-path');
            var code = $('#code').val();

            var state = Boolean();
            state = true;

            if (code === "") {
                $("#code_error").fadeIn("fast");
                state = false;
            }

            if (state === true) {
                $.ajax({
                    url: path + '/validate_sms',
                    type: 'POST',
                    data: {"_token": "{{ csrf_token() }}", id: id, code: code},
                    cache: false,
                    dataType: "json",
                    success: function (success_array) {
                        if (success_array.status_code === 200) {
                            $(".modal-footer #success").html(success_array.status_description);
                        } else {
                            $(".modal-footer #fail").html(success_array.status_description);
                        }

                        setTimeout(hide_popup, 3000);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        //alert("Test not working "+thrownError);
                    }

                });
            } else {
                return false;
            }

        });
    });
</script>
<!-- Show Pop up Window if there is message called back -->
@if (session('message'))
    <script>
        document.getElementById("popup_message").click();
    </script>;
@endif
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        try {
            CKEDITOR.replace('editor');
        } catch (error) {
            // console.error(error);
        }
    });
</script>
