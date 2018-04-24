<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 " style="border: 3px solid #5499C7;">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="7800">
                            @if(isset($credit))
                                ${{ number_format($credit->amount, 2) }}
                            @else
                                $0.00
                            @endif
                        </span>
                        <small class="font-green-sharp"></small>
                    </h3>
                    <small>MY RECENT CREDIT</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 " style="border: 3px solid #54C7B4;">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="7800">
                            @if(isset($debit))
                                ${{ number_format($debit->amount, 2) }}
                            @else
                                $0.00
                            @endif
                        </span>
                        <small class="font-green-sharp"></small>
                    </h3>
                    <small>MY RECENT DEBIT</small>
                </div>
                <div class="icon">
                    <i class="icon-like"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 " style="border: 3px solid #C75654;">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <small class="font-green-sharp">$</small>
                        <span data-counter="counterup" data-value="567">{{ number_format($balance, 2) }}</span>
                    </h3>
                    <small>MY WALLET BALANCE</small>
                </div>
                <div class="icon">
                    <i class="icon-basket"></i>
                </div>
            </div>
        </div>
    </div>
</div>