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
                        }, 2000);
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


    setInterval(() => {
        showDispute();
        showNewMembers();
        showActivityLogs();
        showTransactions();
        showMembersEarnings();
    }, 10000)
    
    return {    
        init: function() {
            LoadComponent();
            showDispute();
            showNewMembers();
            showActivityLogs();
            showTransactions();
            showMembersEarnings();

            $("#make_withdrawal_btn").on("click", function() {
                MakeWithdrawal();
            });
        }
    }
}();

jQuery(document).ready(function() {
    AppDashboard.init();
});