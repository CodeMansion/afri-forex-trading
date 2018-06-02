const AllUsers = function() {

    const LoadComponents = function() {
        $("#loader").hide();
    }

    const SaveAdministrator = function() {
        $("#create_admin_btn").attr('disabled', true);
        $("#loader").show();

        $.ajax({
            url: create_administrator,
            method: "POST",
            data: {
                'role_id': $("#role_id").val(),
                'full_name': $("#full_name").val(),
                'username': $("#username").val(),
                'email': $("#email").val(),
                'telephone': $("#telephone").val(),
                '_token': TOKEN
            },
            success: function(data) {
                if (data.type == "true") {
                    $("#create_admin_btn").attr('disabled', false);
                    $("#loader").hide();
                    toastr.success(data.msg);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else if (data.type == "false") {
                    $("#create_admin_btn").attr('disabled', false);
                    $("#loader").hide();
                    toastr.error(data.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                toastr.error(errorMsg);
                $("#create_admin_btn").attr('disabled', false);
                $("#loader").hide();
            }
        });
    }

    const DeleteMember = function(slug) {
        $.ajax({
            url: delete_member,
            method: "POST",
            data: {
            	'_token': TOKEN,
            	'slug': slug
            },
            success: function(rst){
                if(rst.type == "true") {
                    swal("Deleted Successfully!", rst.msg, "success");
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else if(rst.type == "false") {
                    swal("Unable to delete", rst.msg, "error");
                }
            },
            error: function(jqXHR, textStatus, errorMessage){
                swal("An Error Occur!", errorMessage, "error");
            }
        });
    }


    return {
        init: function() {
            
            LoadComponents();

            $("#create_admin_btn").on("click", function() {
                SaveAdministrator();
            });

            $(".table.table-bordered.table-hover.members tbody tr").each(function(index) {
                $("#delete_member_" + index).on("click", function() {
                    let member_slug = $("#member_slug_" + index).val();
                    swal({
                        title: "Are you sure?",
                        text: "You are about to delete the records of this member",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, function() {
                        DeleteMember(member_slug);
                    });
                });
            });
        }
    }
}();

jQuery(document).ready(function() {
    AllUsers.init();
});