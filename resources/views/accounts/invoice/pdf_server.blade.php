<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        
       
        @font-face {
            font-family: 'Amiri';
            src: url('/public/fonts/Amiri-Regular.ttf');
        }

      

        /* Set the text direction to right-to-left */
        body {
            direction: rtl;
            text-align: right;
        }
        /* CLIENT-SPECIFIC STYLES */
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

       

        

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
        #tabl1, th, td {
            border: 1px solid;
            text-align:center;
        }
    </style>
</head>

<body>
    
    <div style="display:block;">
        <div class="logo" style="float:left;display:inline;">
            <img src="gen-img/Yes-Cargo-Logo.png" alt="" style="display:inline;padding-left:0px;margin-left:0px;" width="300">
        </div>
        <div class="logo" style="width:50%;float:right;display:inline;text-align:right;">
            <p style="font-size:12px;margin:0px;">Near Ladies Market Behind New CityFlower Supermarket, Seiko,Dammam,Saudi Arabia <br>
                0138838835, 0548240456, 0573165148 <br>
                www.yescargosaudi.com  
                
            </p>
        </div>
    </div>
    
    
    <div style="display:block;margin-top:60px;">

        <table style="width:100%;">
            <tr>
                <th style="border-style:none;font-size:15px;font-weight:400;text-align:center;font-weight:bold;">VAT No. 311271339700003 </th>
            </tr>
        </table>

    </div>
    <div style="display:block;margin-top:5px;">
        <div style="float: left; width: 22%;">
                <table style="border-collapse: collapse;" id="tabl1">
                <tr> <th style="font-size:12px;">DATE</th> </tr>
                    
                <tr> <td style="font-size:13px;">{{ $invoice->starting_date }}</td> </tr>
                
                <tr> <th style="font-size:12px;padding:5px 10px;">Shipment Mode</th> </tr>
                    
                <tr> <td style="font-size:13px;padding:7px 0px;">{{ $invoice->shipment_mode_slug }}</td> </tr>
                
                </table>
        </div>
        <div style="float: left; width: 28%;">
                <table style="border-collapse: collapse; border: 1px solid;">
                    <tr><th style="padding:5px 0px;"> <span style="color:#1f1867;font-size:18px;"> YES CARGO </span></th> </tr>
                    <tr> <th style="font-size:12px;padding:5px 10px;">INVOICE / HAWB NUMBER</th> </tr>
                    <tr> <td style="font-size:13px;padding:10px 0px;">{{ $invoice->invoice_no }}</td> </tr>
                    
                </table>
        </div>
        <div style="float: right; width: 48%;padding-left:10px;">
                <table style="border-collapse: collapse; border: 1px solid;width:100%;">
                    <tr>
                        <th style="font-size:12px;">1</th>
                        <th style="font-size:12px;">2</th>
                        <th style="font-size:12px;">3</th>
                        <th style="font-size:12px;">4</th>
                        <th style="font-size:12px;">5</th>
                        <th style="font-size:12px;">6</th>
                        <th style="font-size:12px;">7</th>
                        <th style="font-size:12px;">8</th>
                        <th style="font-size:12px;">9</th>
                        <th style="font-size:12px;">10</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="5" style="font-size:12px;padding:11px 0px;">Pcs : {{ $totalNoOfPieces }}</th>
                        <th colspan="5" style="font-size:12px;">Kg : {{ $totalWeight }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" style="font-size:12px;padding:11px 0px;" >Bill Amount </th>
                        <th colspan="5" style="font-size:12px;">{{ 'SAR '. number_format($netBill, 2) }} </th>
                    </tr>
                </table>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div style="display:block;margin-top:25px;">
        <table style="width:100%;">
            <tr >
                <th style="text-align:left; width:50%;font-size:12px;padding-left:5px;">Shipper </th>
                <th style="text-align:left; width:50%;font-size:12px;padding-left:5px;">Consignee Details</th>
            </tr>
            <tbody>
                <tr>
                    <td  style="text-align:left;padding-left:5px;">
                        <p style="margin:0px;font-size:13px;">MR. {{ @$invoice->customer->name }}</p>
                        <p style="margin:0px;font-size:13px;">{{ @$invoice->customer->city }}</p>
                        <p style="margin:0px;font-size:13px;">{{ @$invoice->customer->phone1 }}</p>
                        <p style="margin:0px;font-size:13px;"></p>
                    </td>
                    <td  style="text-align:left;padding-left:5px;">
                        <p style="margin:0px;font-size:13px;">{{ $invoice->cosignee_name }}</p>
                        <p style="margin:0px;font-size:13px;">{{ $invoice->cosignee_address }}</p>
                        <p style="margin:0px;font-size:13px;">PINCODE-{{ $invoice->cosignee_pincode }}</p>
                        <p style="margin:0px;font-size:13px;">Mob 1: {{ $invoice->cosignee_phone1 }}</p>
                        <p style="margin:0px;font-size:13px;">Mob 2:{{ $invoice->cosignee_phone2 }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="display:block;margin-top:5px;">
        <table style="width:100%;">
        <thead>
            <tr >
                <th style="text-align:left;"><span style="color:gray;font-size:12px;"> S. N.  </span></th>
                <th style="text-align:left;"> <span style="color:gray;font-size:12px;">Box  <img src="gen-img/Box.webp" alt="" style="display:inline;" width="20"></span>  </th>
                <th style="text-align:left;"> <span style="color:gray;font-size:12px;padding:5px;">Item Description </span> <img src="gen-img/Item Description.webp" alt="" style="display:inline;float:right;" width="50"></th>
                <th style="text-align:left;"> <span style="color:gray;font-size:12px;">Qty  </span><img src="gen-img/Qty.webp" alt="" style="display:inline;float:right;" width="25"></th>
                <th style="text-align:left;"> <span style="color:gray;font-size:12px;">Value </span><img src="gen-img/value.png" alt="" style="display:inline;float:right;" width="30"></th>

                <th style="text-align:left;"> <span style="color:gray;font-size:12px;"> S. N.  </span></th>
                <th style="text-align:left;"> <span style="color:gray;font-size:12px;">Box  <img src="gen-img/Box.webp" alt="" style="display:inline;" width="20"></span>  </th>
                <th style="text-align:left;"> <span style="color:gray;font-size:12px;padding:5px;">Item Description </span><img src="gen-img/Item Description.webp" alt="" style="display:inline;float:right;" width="50"></th>
                <th style="text-align:left;"> <span style="color:gray;font-size:12px;">Qty  </span><img src="gen-img/Qty.webp" alt="" style="display:inline;float:right;" width="25"></th>
                <th style="text-align:left;"><span style="color:gray;font-size:12px;"> Value </span><img src="gen-img/value.png" alt="" style="display:inline;float:right;" width="30"></th>
            </tr>
        </thead>
            <tbody>
            <?php $i = 0; ?>
                @foreach($invoice->invoice_item_details as $key => $item)
                    @if ($loop->odd)
                                    <tr>
                                    
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->boxes }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                        @if($loop->last)
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    @endif
                                    @if ($loop->even)
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->boxes }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                       
                                    </tr>
                                   @endif
                
                @endforeach
               
            </tbody>
        </table>
    </div>
    <div style="display:block;margin-top:5px;">

        <table style="width:100%;">
            <tr>
                <th style="width:20%;font-size:12px;text-align:left;border-style:none;">Amount in words: </th>
                <td style="border-style:none;text-align:left;font-size:13px;">{{  $amountString }}</td>
            </tr>
            <tr>
                <th style="width:20%;font-size:12px;text-align:left;border-style:none;">Remarks: </th>
                <td style="border-style:none;text-align:left;font-size:13px;">{{ $invoice->invoice_note  }} <img src="gen-img/Remarks.webp" alt="" style="display:inline;float:right;" width="50"></td>
            </tr>
        </table>

    </div>
    <div style="display:block;margin-top:5px;">
        <div style="float: left; width:40%; ">
             <table style="width:97%;">
                <tr>
                    <th style="text-align:left;border: 1px solid blue;"> 
                        <img src="gen-img/PROHIBITED.webp" alt="" style="width:95%;" >

                    </th>
                </tr>
                <!-- <tr>
                    <td style="text-align:left;padding:3px;">
                       <p style="color:#1f1867;font-size:12px;"> Zamzam water, liquid, batteries, or any flammable items 
                        Gascylinder, Cement, Watch, Camera, Mobile, Lap top
                        Etc... All Petrolium Products, Miltary & Police uniform
                        Etc...
                        </p>
                    </td>
                </tr> -->
                <tr>
                    <td style="text-align:left;font-size:13px;padding:3px;border:none;padding-top:40px;">
                    TERMS & CONDITIONS
                    </td>
                </tr>
            </table>     
            <!-- <span style="border: 1px solid blue;padding:5px;">    
                <img src="{{ public_path('gen-img/PROHIBITED & RESTRICTED GOODS.webp') }}" alt="" style="width:95%;" >
            </span>   
                <h6 style="margin-top:30px;"> TERMS & CONDITIONS</h6> -->
        </div>
        <div style="float: left; width:20%;">
            <table style="width:98%;border:none;">
                <tr>
                    <th style="border:none;">
                        <img src="data:image/png;base64, {!! $qrcode !!}">
                    </th>
                </tr>
            </table>
        </div>
        <div style="float: left; width:40%;">
            <table style="width:100%;">
                <thead>
                    <tr>
                        <th style="text-align:left;padding-left:4px;width:60%;"> <span style="color:blue;font-size:12px;"> Amount </span> <img src="gen-img/Amount.webp" alt="" style="display:inline;float:right;" width="50"> </th>
                        <th style="text-align:left;padding-left:4px;width:40%;font-size:13px;">{{'SAR '. number_format($shipmentPricePerKg, 2) }} </th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding-left:4px;"><span style="color:blue;font-size:12px;"> Packing Charges </span> <img src="gen-img/PackingCharges.webp" alt="" style="display:inline;float:right;" width="50"></th>
                        <th style="text-align:left;padding-left:4px;width:40%;font-size:13px;">{{ 'SAR '. number_format($invoice->packing_charges,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding-left:4px;"><span style="color:blue;font-size:12px;"> Box Charges </span> <img src="gen-img/BoxCharges.webp" alt="" style="display:inline;float:right;" width="50"></th>
                        <th style="text-align:left;padding-left:4px;width:40%;font-size:13px;">{{ 'SAR '. number_format($invoice->box_charges,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding-left:4px;"><span style="color:blue;font-size:12px;"> Invoice Charge </span> <img src="gen-img/BillCharge.webp"  style="display:inline;float:right;" width="50"></th>
                        <th style="text-align:left;padding-left:4px;width:40%;font-size:13px;">{{ 'SAR '. number_format($invoice->bill_charges,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding-left:4px;"><span style="color:blue;font-size:12px;">Other Charge </span> <img src="gen-img/OtherCharge.webp"  style="display:inline;float:right;"  width="50"></th>
                        <th style="text-align:left;padding-left:4px;width:40%;font-size:13px;">{{ 'SAR '. number_format($invoice->other_charges,2) }} </span> </th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding-left:4px;"><span style="color:blue;font-size:12px;">Discount  </span> <img src="gen-img/Discount.webp" alt="" style="display:inline;float:right;" width="45"></th>
                        <th style="text-align:left;padding-left:4px;width:40%;font-size:13px;">{{ 'SAR '. number_format($invoice->discount,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding-left:4px;"><span style="color:blue;font-size:12px;">VAT </span><img src="gen-img/VAT.webp" alt="" style="display:inline;float:right;" width="70"></th>
                        <th style="text-align:left;padding-left:4px;width:40%;font-size:13px;">{{'SAR '. number_format($vat_value,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding-left:4px;"><span style="color:blue;font-size:12px;">Net Total </span> <img src="gen-img/NetTotal.webp" alt="" style="display:inline;float:right;" width="60"></th>
                        <th style="text-align:left;padding-left:4px;width:40%;font-size:13px;">{{ 'SAR '. number_format($netBill,2) }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div style="display:block;margin-top:45px;width:100%;border: 1px solid blue;">
        <!-- <p style="padding:5px;border: 1px solid black;font-size:12px;margin:0px;color:#1f1867;">
            1 - No garantee for glass / breakable items Company not responsible items received in damaged condition. 2 - \Complaints will not be accepted after 2
            days from the date of delivery 3 - Company not responsible for octray charges charges or any other vcharges levied locally. 4 - In case of claim (loss)
            proof of documents should be produced In case of loss of package . settlement will be made (20 S. R./ KG) as per company rules. 6 - company will not
            take responsibility for natural calamity and delay in customs clearance
        </p> -->
        <img src="gen-img/term & contion(box).webp" alt="" style="width:100%">
    </div>
    <div style="display:block;margin-top:15px;">

        <table style="width:100%;">
            <tr>
                <th style="border-style:none;font-size:13px;font-weight:400;text-align:left;font-weight:bold;">Shippers signature <img src="gen-img/Shippers signature.webp" alt="" style="display:inline;padding-left:10px;" width="60"></th>
                <th style="border-style:none;font-size:13px;font-weight:400;text-align:center;color:#b71c1c;font-weight:bold;">Thanks for your Visit ! Come Again</th>
                <th style="border-style:none;font-size:13px;font-weight:400;text-align:right;font-weight:bold;">Checked & Received by <img src="gen-img/Checked & Received by.webp" alt="" style="display:inline;padding-left:10px;" width="60"></th>
            </tr>
        </table>

    </div>
</body>

</html>