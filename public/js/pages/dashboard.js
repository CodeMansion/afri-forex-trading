var AppDashboard = function() {
    
    var LoadComponent = function() {
        $("#dispute_loader").hide();
        $("#members_loader").hide();
        $("#support_loader").hide();
        $("#transaction_loader").hide();
        $("#activity_loader").hide();
        $("#latest_news_loader").hide();
        $("#latest_earnings_loader").hide();
        $("#loader").hide();
        $("#withdrawal_loader").hide();
        $("#user_details_for_fund").hide();
        $("#share_fund_btn").hide();
    }

    var showDispute = function() {
        $("#dispute_loader").show();
        $.ajax({
            url: DISPUTE, 
            success: function(data) {
                $("#dispute_loader").hide();
                $('#show_dispute').html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                console.log(errorMsg);
            }
        });
    }

    var showNewMembers = function() {
        $("#members_loader").show();
        $.ajax({
            url: MEMBERS, 
            success: function(data) {
                $("#members_loader").hide();
                $('#show_members').html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                console.log(errorMsg);
            }
        });
    }

    var showActivityLogs = function() {
        $("#activity_loader").show();
        $.ajax({
            url: ACTIVITY, 
            success: function(data) {
                $("#activity_loader").hide();
                $("#show_logs").html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                console.log(errorMsg);
            }
        });
    }

    var showTransactions = function() {
        $("#transaction_loader").show();
        $.ajax({
            url: TRANSACTION, 
            success: function(data) {
                $("#transaction_loader").hide();
                $('#show_transaction').html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                console.log(errorMsg);
            }
        });
    }

    var showLatestNews = function() {
        $("#transaction_loader").show();
        $.ajax({
            url: TRANSACTION, 
            success: function(data) {
                $("#transaction_loader").hide();
                $('#show_transaction').html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                console.log(errorMsg);
            }
        });
    }

    var showLatestWithdrawals = function() {
        $("#withdrawal_loader").show();
        $.ajax({
            url: WITHDRAWAL, 
            success: function(data) {
                $("#withdrawal_loader").hide();
                $('#show_withdrawals').html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                console.log(errorMsg);
            }
        });
    }

    var showMembersEarnings = function() {
        $("#latest_earnings_loader").show();
        $.ajax({
            url: EARNINGS, 
            success: function(data) {
                $("#latest_earnings_loader").hide();
                $('#show_latest_earnings').html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                console.log(errorMsg);
            }
        });
    }

    var MakeWithdrawal = function() {
        var amount = $("#amount").val();

        if(amount.length < 1) {
            toastr.error("Provide an amount for withdrawal");
        } else {
            $("#loader").show();
            $("#make_withdrawal_btn").attr('disabled',true);
            
            $.ajax({
                url: WITHDRAW, 
                type: "POST",
                data: {
                    '_token': TOKEN,
                    'amount': amount
                },
                success: function(data) {
                    if (data.type == "true") {
                        $("#loader").hide();
                        $("#make_withdrawal_btn").attr('disabled',false);

                        toastr.success(data.msg);

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else if (data.type == "false") {
                        toastr.error(data.msg);
                        $("#loader").hide();
                        $("#make_withdrawal_btn").attr('disabled',false);
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    toastr.error(errorMsg);
                    $("#loader").hide();
                    $("#make_withdrawal_btn").attr('disabled',false);
                }
            });
        }
    }


    var GetDetails = function(detail) {
        $("#get_detail_btn").attr("disabled", true);
        $("#get_detail_btn").html("<i class='fa fa-spinner fa-spin'></i> Processing...");
        $.ajax({
            url: USERDETAILS,
            method: "POST",
            data: {
                '_token': TOKEN,
                'detail': detail
            },
            success: function(rst) {
                if(rst =="false"){
                    toastr.error("this user "+detail+" does not exist");
                    $("#get_detail_btn").attr("disabled", false);
                    $("#get_detail_btn").html("Continue");
                }else{
                    $("#get_detail_btn").attr("disabled", false);
                    $("#get_detail_btn").html("<i class='fa fa-check'></i> Continue");
                    $("#get_detail_btn").hide();
                    $(".username_detail_filed").fadeOut();
                    $("#user_details_for_fund").fadeIn();
                    $("#user_details_for_fund").html(rst);
                    $("#share_fund_btn").show();
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                toastr.error(errorMsg);
            }
        });
    };

    const ShareFund = function(user_id, amount) {
        $("#share_fund_btn").attr("disabled", true);
        $("#share_fund_btn").html("<i class='fa fa-spinner fa-spin'></i> Processing...");
        $.ajax({
            url: SHARE_FUND,
            method: "POST",
            data: {
                '_token': TOKEN,
                'user_id': user_id,
                'amount': amount
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#share_fund_btn").attr("disabled", false);
                    $("#share_fund_btn").html(" Submit");
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#share_fund_btn").attr("disabled", false);
                    $("#share_fund_btn").html("Try Again");
                    toastr.error(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                $("#share_fund_btn").attr("disabled", false);
                $("#share_fund_btn").html("Try Again");
                toastr.error(errorMsg);
            }
        });
    };


    setInterval(() => {
        showDispute();
        showNewMembers();
        showActivityLogs();
        showTransactions();
        showMembersEarnings();
        showLatestWithdrawals();
    }, 10000);
    
    return {    
        init: function() {
            LoadComponent();
            showDispute();
            showNewMembers();
            showActivityLogs();
            showTransactions();
            showMembersEarnings();
            showLatestWithdrawals();

            $("#make_withdrawal_btn").on("click", function() {
                MakeWithdrawal();
            });

            $("#cancel_user_details").on("click", function() {
                $(".username_detail_filed").fadeIn();
                $("#detail_field").val("");
                $("#get_detail_btn").show();
                $("#share_fund_btn").hide();
                $("#user_details_for_fund").html("");
                $("#user_details_for_fund").hide();
            });

            $("#share_fund_btn").on("click", function() {
                var user_id = $("#receiver_user_id").val();
                var amount = $("#amount_to_transfer").val();
                if (user_id.length < 1) {
                    toastr.error("Please this text field can not be empty!");
                } else if (amount.length < 1) {
                    toastr.error("Please this text field can not be empty!");
                } else {
                    ShareFund(user_id, amount);
                }
            });

            $("#get_detail_btn").on("click", function() {
                var detail = $("#detail_field").val();
                if (detail.length < 1) {
                    toastr.error("Please this text field can not be empty!");
                } else {
                    GetDetails(detail);
                }
            });
        }
    }
}();

jQuery(document).ready(function() {
    AppDashboard.init();
});