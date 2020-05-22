<div class="ibox-content">
<div class="invoice" id="invoice">
    <header class="clearfix">
        <div class="row">
            <div class="col-sm-6 mt-md">
                <h2 class="h2 mt-none mb-sm text-dark text-bold">{{getPhrase('invoice')}}</h2>
                <h4 class="h4 m-none text-dark text-bold">{{getPhrase('invoice_no') . ': ' . $invoice->invoice_number_display}}</h4>

                <?php
                $total_tax = 0;
				$total_discount = $invoice->discount_amount;
				$sub_total = $invoice->actual_cost;
				$grand_total = $invoice->paid_amount;

                $class = 'danger'; // Un-paid, due
                $title = $invoice->payment_status;
                if ( 'success' == $invoice->payment_status ) {
                    $class = 'success';
                }
                ?>
                <h3 class="alert alert-{{$class}} alert-bg-p">{{strtoupper($title)}}</h3>
            </div>
            <div class="col-sm-6 text-right mt-md mb-md">
                <div class="ib">
                    <?php
                    $logo = getSetting('Invoice-Logo', 'invoice-settings');
                    if ( empty( $logo ) ) {
                        $logo = IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings');
                    } else {
                    	$logo = asset( 'uploads/settings/' . $logo );
                    }


                    ?>
                    <img src="{{$logo}}" height="40" width="181">
                </div>
                <address class="ib mr-xlg">
                    <?php
                    $site_title = getSetting('Company_Name_On_Invoice', 'invoice-settings');
                    if ( empty( $site_title ) ) {
                    	$site_title = getSetting('site_title', 'site_settings');
                    }

                    $site_address = getSetting('Company-Address', 'invoice-settings');
                    if ( empty( $site_title ) ) {
                    	$site_title = getSetting('site_address', 'site_settings');
                    }
                    ?>
                    <strong>{{$site_title}}</strong>
                    <p>{{$site_address}}</p>
                </address>
            </div>
        </div>
    </header>
    <div class="bill-info">
        <div class="row">
            <div class="col-md-6">
                <div class="bill-to">
                    <p class="h5 mb-xs text-dark text-semibold"><strong>{{getPhrase('invoice_to')}}</strong></p>
                    <address>

                        {{getPhrase('attn')}}&nbsp;{{$invoice->customer->name}}
                        <p>{{$invoice->customer->address}}</p>
                        @if(! empty( $invoice->customer->email ) )
                        <br>
                        <strong>{{getPhrase('email')}}</strong> {{$invoice->customer->email}}
                        @endif

                    </address>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-6">
                <div class="bill-data text-right">
                    <p class="mb-none">
                        <span class="text-dark">{{getPhrase('invoice_date')}}</span>
                        <span class="value">{{digiDate( $invoice->start_date ) }}</span>
                    </p>
                    <h3 class="header-text-d">{{getPhrase('total')}}<span class="amount-main"> {{digiCurrency($invoice->paid_amount, $invoice->currency)}}</span> </h3>

                    <?php
                    $total_paid = $invoice->paid_amount;
                    $amount_due = $invoice->paid_amount - $total_paid;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">

            <table class="table invoice-items">
                <thead>
                <tr class="h4 text-dark text-view">
                    <th width="30%" class="text-center">{{ getPhrase('item_name') }}</th>

                    <th width="10%" class="text-center">{{ getPhrase('rate') }}</th>
                    <th width="7%" class="text-center">{{ getPhrase('discount') }}</th>
                    <th width="10%" class="text-center">{{ getPhrase('amount') }}</th>

                </tr>
                </thead>
                <tbody>

                <tr height="90px" class="product_row">
                    <td valign="top" valign="top">
                    <?php
                    $product_name = '';
                    $item_id = $invoice->item_id;
                    if ( 'subscribe' === $invoice->plan_type ) {
                    	$record = \App\Package::find( $item_id );
                    	if ( $record ) {
                    		$product_name = $record->name;
                    		if ( $record->type === 'temp' ) {
                    			$product_name = getPhrase( 'subscription_for' ) . ' ' . $record->validity. ' ' . str_plural($record->validity_type, $record->validity);
                    		}
                    	}
                    } elseif ( 'lms' === $invoice->plan_type ) {
                    	$record = \App\LmsSeries::find( $item_id );
                    	if ( $record ) {
                    		$product_name = $record->title;
                    	}
                    } elseif ( 'exam' === $invoice->plan_type ) {
                    	$record = \App\Quiz::find( $item_id );
                    	if ( $record ) {
                    		$product_name = $record->title;
                    	}
                    } elseif ( 'combo' === $invoice->plan_type ) {
                    	$record = \App\ExamSeries::find( $item_id );
                    	if ( $record ) {
                    		$product_name = $record->title;
                    	}
                    }

                    $product_tax_display = 0;
                    $tax_value = 0;
                    $discount_value = 0;
                    $amount = $invoice->paid_amount;
                    $product_qty = 1;
                    $product_discount_display = $invoice->discount_amount;
                    ?>
                    {{$product_name}}</td>

                    <td valign="top">{{digiCurrency( $invoice->actual_cost )}}</td>
                    <td valign="top">{{digiCurrency( $invoice->discount_amount )}}</td>
                    <td class="text-center" valign="top"><strong><span class="ttlText" >{{digiCurrency($amount)}}</span></strong>
                    </td>

                </tr>

                </tbody>
            </table>




    </div>

    <div class="invoice-summary">
        <div class="row">
            <div class="col-sm-3 col-sm-offset-9">
                <table class="table h5 text-dark table-bg-t">
                    <tbody>

                    <tr class="b-top-none">
                        <td colspan="2">{{getPhrase('sub_total')}}</td>
                        <td class="text-right amount">{{digiCurrency($sub_total, $invoice->currency)}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">{{getPhrase('total_discount')}}</td>
                        <td class="text-right amount">{{digiCurrency($total_discount, $invoice->currency)}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">{{getPhrase('grand_total')}}</td>
                        <td class="text-right amount">{{digiCurrency($grand_total, $invoice->currency)}}</td>
                    </tr>

                    <tr>
                        <td colspan="2">{{getPhrase('total_paid')}}</td>
                        <td class="text-right amount">{{digiCurrency( $total_paid, $invoice->currency )}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    $authorized_person = getSetting('Authorized-Person', 'invoice-settings');
    ?>
    @if ( ! empty( $authorized_person ) )
    <div class="row">

        <div class="col-sm-8 signature-right">&nbsp;
        </div>
        <div class="col-sm-4 signature-right">
            <?php
            $authorized_sign = getSetting('Authorized-Person-Signature', 'invoice-settings');
            $authorized_designation = getSetting('Authorized-Person-Designation', 'invoice-settings');
            ?>
            <p>{{getPhrase('authorized_person')}}</p>
            @if( ! empty( $authorized_sign ) )
            <p class="sign-img"><img src="{{asset( 'uploads/settings/' . $authorized_sign )}}" width="160" height="100"></p>
            @endif

            @if( ! empty( $authorized_person ) )
            <p>({{$authorized_person}})</p>
            @endif

            @if( ! empty( $authorized_designation ) )
            <p>{{$authorized_designation}}</p>
            @endif
        </div>
    </div>
    @endif
</div>
</div>