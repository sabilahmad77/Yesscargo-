<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .section{
            margin:5px 0px;
        }
        .invoice-header{
            height: 150px;
            /* background:black; */
            position: relative;
        }
        .VAT{
            text-align:center;
            margin: 0px;
            margin: 0px;
            /* margin-top: -45px; */
            color: #191970;
            position: absolute;
            bottom: 0px;
            left: 30%;
            display:inline-block;
        }
        .invoice-header-address{
            padding: 10px;
            float:right;
            border:2px solid red;
        }
        .invoice-header-address p{
            margin:0px;
        }
        
        #side-by-side-table3{
            position: relative;
        }
        .tbl1{
            position: absolute;
            top: 0px;
            left: 0px;
            border-collapse: collapse;
        }
        .tbl2{
            position: absolute;
            top: 0px;
            left: 27%;
            border-collapse: collapse;
        }
        .tbl3{
            position: absolute;
            top: 0px;
            right: 0px;
            border-collapse: collapse;
        }
       
        .reminder-sect{
            border: 2px solid blue;
            padding: 5px 5px;
        }
        .footer h3{
            display:inline;
        }
        .column {
        flex: 10%;
        height: 100px;
        padding: 10px;
        margin: 5px;
        /* background-color: #cccccc; */
        text-align: center;
        }
        .container {
        display: flex;
        }
        table, td, th {
        border: 2px solid #191970;
        text-align:center;
        /* //padding: 5px 5px; */
        }
        /*
        table {
        border-collapse: collapse;
        
        } */
      
    </style>
</head>
<body>
    
    <div class="invoice-header">
        <img src="gen-img/Yes-Cargo-Logo.png" style="width: 30%; margin-top:35px;" alt="No logo">
        <h3 class="VAT">VAT No. 311271339700003</h3>
        <div class="invoice-header-address">
            <p > Near Ladies Market <br>
                Behind New CityFlower <br>
                Supermarket, <br>
                Seiko,Dammam,Saudi Arabia <br>
                0138838835, 0548240456 <br>
                0573165148 <br>
                www.yescargosaudi.com <br>
            </p>
        </div>
    </div>
    <br>
    <!-- <div  id="side-by-side-table3">
        

        <table  class="tbl1">
            <tr>
                <th style="width: 170px;">Date </th>
            </tr>
            <tr>
                <td style="text-align: center;padding:5px 0px;">123</td>
            </tr>
            <tr>
                <th style="width: 170px;padding:5px; 0px">Shipment Mode </th>
            </tr>
            <tr>
                <td style="text-align: center;">123</td>
            </tr>
        </table>

        <table  class="tbl2">
            <tr>
                <th style="width: 240px;padding:5px 0px;">YES CARGO </th>
            </tr>
            <tr>
                <td style="text-align: center;padding:5px 0px;">INVOICE / HAWB NUMBER</td>
            </tr>
            <tr>
                <th style="width: 240px;padding: 30px 0px;">Date </th>
            </tr>
            
        </table>

        <table  class="tbl3">
            <tr>
                <th style="width: 25px;padding:5px 0px;">1 </th>
                <th style="width: 25px;padding:5px 0px;">2 </th>
                <th style="width: 25px;padding:5px 0px;">3 </th>
                <th style="width: 25px;padding:5px 0px;">4 </th>
                <th style="width: 25px;padding:5px 0px;">5 </th>
                <th style="width: 25px;padding:5px 0px;">6 </th>
                <th style="width: 25px;padding:5px 0px;">7 </th>
                <th style="width: 25px;padding:5px 0px;">8 </th>
                <th style="width: 25px;padding:5px 0px;">9 </th>
                <th style="width: 25px;padding:5px 0px;">10 </th>
            </tr>
            <tr>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">1</td>
                <td style="text-align: center;padding:5px;">10</td>

            </tr>
            <tr>
                <th  colspan="5" style="padding:15px;">Pcs : 1 </th>
                <th  colspan="5" style="padding:15px;">Kg : 71 </th>
            </tr>
            <tr>
                <th  colspan="5" style="padding:15px;">Bill Amount </th>
                <th  colspan="5" style="padding:15px;">550.000 </th>
            </tr>
        </table>

    </div> -->
    <div class="section">
        <table style="width:100%;border-collapse: collapse; border: none;">
                <tr>
                    <th style="width:30%; border: none;">
                        <table style=" border: none;border-collapse: collapse;">
                        <tr >
                                <th style="width:30%;padding:5px 45px;color:blue;">Date </th>
                            </tr>
                            <tr>
                                <td style="padding:13px 5px;">{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <th style="width:30%;padding:5px 45px;color:blue;">Shipment Mode </th>
                            </tr>
                            <tr>
                                <td style="padding:15px 45px;">XYZ</td>
                        </tr>
                        </table>
                    </th>
                    <th style="width:30%;border: none;">
                        <table style=" border: none;border-collapse: collapse;">
                            
                            <tr>
                                <th style="width: 30%;padding:5px 20px;color:blue;">YES CARGO </th>
                            </tr>
                            <tr>
                                <td style="text-align: center;padding:5px 20px;color:blue;">INVOICE / HAWB NUMBER</td>
                            </tr>
                            <tr>
                                <th style="width: 30%;padding: 30px 20px;">Date </th>
                            </tr>
                        
                        </table>
                    </th>
                    <th style="width:40%;border: none;">
                        <table style="width:40% border: none;border-collapse: collapse;float:right;">
                            
                        <tr>
                            <th style="width:5%;padding:5px;">1 </th>
                            <th style="width:5%;padding:5px;">2 </th>
                            <th style="width:5%;padding:5px;">3 </th>
                            <th style="width:5%;padding:5px;">4 </th>
                            <th style="width:5%;padding:5px;">5 </th>
                            <th style="width:5%;padding:5px;">6 </th>
                            <th style="width:5%;padding:5px;">7 </th>
                            <th style="width:5%;padding:5px;">8 </th>
                            <th style="width:5%;padding:5px;">9 </th>
                            <th style="width:5%;padding:5px;">10 </th>
                        </tr>
                        <tr>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">1</td>
                            <td style="text-align: center;padding:5px;">10</td>

                        </tr>
                        <tr>
                            <th  colspan="5" style="padding:15px;">Pcs : {{ $order->invoice_item_details_count }}</th>
                            <th  colspan="5" style="padding:15px;">Kg : {{ $totalWeight }} </th>
                        </tr>
                        <tr>
                            <th  colspan="5" style="padding:15px;">Bill Amount </th>
                            <th  colspan="5" style="padding:15px;">{{ number_format($billAmount,2) }} </th>
                        </tr>
                        
                        </table>
                    </th>
                </tr>
        </table>
    </div>
    <div class="section">
       
       <table style="width:100%;border-collapse: collapse; border: 2px solid #191970; ">
        <tr>
            <th style="width:50%;text-align:left; padding: 5px;color:blue;">Shipper </th>
            <th style="width:50%;text-align:left; padding: 5px;color:blue;">Consignee Details</th>
        </tr>
        <tr>
            <td style="text-align:left; padding: 0px 5px;">
                <p>Mr. {{ $order->sales_person }}</p>
            </td>
            <td style="text-align:left; padding:7px;">
                <p style="margin:0px;"> {{ $order->cust_name }}</p>
                <p style="margin:0px;"> {{ $order->cust_address }}</p>
                <p style="margin:0px;"> {{ $order->cust_phone }}</p>
                <p style="margin:0px;"> {{ $order->cust_email }}</p>
            </td>
        </tr>
       </table>
    </div>

    <div class="section">
       
       <table style="width:100%;border-collapse: collapse; border: 2px solid #191970; ">
        <tr>
            <!-- <th style="width:50%;text-align:left; padding: 5px;">Shipper </th>
            <th style="width:50%;text-align:left; padding: 5px;">Consignee Details</th> -->
            <th style="width:5%;text-align:left; padding: 5px;">SR#</th>
            <th style="width:5%;text-align:left; padding: 5px;">Box</th>
            <th style="width:20%;text-align:left; padding: 5px;">Item Description</th>
            <th style="width:10%;text-align:left; padding: 5px;">Qty</th>
            <th style="width:10%;text-align:left; padding: 5px;">Value</th>
            <th style="width:5%;text-align:left; padding: 5px;">SR#</th>
            <th style="width:5%;text-align:left; padding: 5px;">Box</th>
            <th style="width:20%;text-align:left; padding: 5px;">Item Description</th>
            <th style="width:10%;text-align:left; padding: 5px;">Value</th>
            <th style="width:10%;text-align:left; padding: 5px;">Qty</th>
        </tr>
        @foreach($order->invoice_item_details as $key => $item )
        <tr>
            
            <td style="text-align:left; padding:5px;color:#191970;">{{ ++$key }}</td>
            <td style="text-align:left; padding:5px;">1</td>
            <td style="text-align:left; padding:5px;">{{ $item->item_name }}</td>
            <td style="text-align:left; padding:5px;">{{ $item->quantity }}</td>
            <td style="text-align:left; padding:5px;">{{ $item->item_per_cost*$item->quantity }}</td>
            
            <td style="text-align:left; padding:5px;color:#191970;">1</td>
            <td style="text-align:left; padding:5px;">1</td>
            <td style="text-align:left; padding:5px;">1</td>
            <td style="text-align:left; padding:5px;">1</td>
            <td style="text-align:left; padding:5px;">1</td>
           
        </tr>
        @endforeach
        
       </table>
    </div>

    <div class="section">
        <h3 style="margin:0px;display:inline;">Amount in words :</h3><h5 style="display:inline;"></h5> 
        <br>
        <h3 style="margin:4px 0px;color:#191970;display:inline;">Remarks : </h3><h5 style="display:inline;">{{ $order->invoice_note }}</h5>
    </div>
    <!-- <div class="section">
        <div style="width:100%;border: 2px solid blue;padding:5px;min-height:120px;">
            <div style="width:47%;display:inline-block;">
                <h4 style="margin:0px;">Shipper</h4>
                <br>
                <p style="margin:0px;">MR </p>
            </div>
            <div style="float:right;width:50%;display:inline-block;border-left: 2px solid blue; padding-left: 5px;">
                <h4 style="margin:0px;">Consignee Details</h4>
                <br>
                <p style="margin:0px;"> X</p>
                <p style="margin:0px;">X</p>
                <p style="margin:0px;"> X</p>
                <p style="margin:0px;"> X</p>
            </div>
        </div>
    </div> -->

   

    
    
    <div class="section">
        <table style="width:100%;border-collapse: collapse; border:none; ">
            <tr>
                <td style="width:40%;text-align:left; padding: 5px;border: 2px solid #191970;">
                    <h4 style="margin: 0px;color:red;text-align:left;">PROHIBITED & RESTRICTED GOODS </h4>
                    <p style="margin: 0px;text-align:left;color:color:blue;">Zamzam water, liquid, batteries, or any flammable items 
                        Gascylinder, Cement, Watch, Camera, Mobile, Lap top
                        Etc... All Petrolium Products, Miltary & Police uniform
                        Etc....
                    </p>
                </td>
                <td style="width:20%;text-align:left; padding: 5px;border:none;"></td>
                <td style="width:40%;text-align:left; padding: 5px;border:none;">
                    <table  style="width:100%;border-collapse: collapse; ">
                    <tr>
                        <th style="width:50%;text-align:left;padding:5px;color:blue;">Amount</th>
                        <td style="width:50%;text-align:left;padding:5px;">35</td>
                    </tr>
                    <tr>
                        <th style="width:50%;text-align:left;padding:5px;color:blue;">Bill Charge</th>
                        <td style="width:50%;text-align:left;padding:5px;">35</td>
                    </tr>
                    <tr>
                        <th style="width:50%;text-align:left;padding:5px;color:blue;">Other Charge</th>
                        <td style="width:50%;text-align:left;padding:5px;">35</td>
                    </tr>
                    <tr>
                        <th style="width:50%;text-align:left;padding:5px;color:blue;">Discount</th>
                        <td style="width:50%;text-align:left;padding:5px;">35</td>
                    </tr>
                    <tr>
                        <th style="width:50%;text-align:left;padding:5px;color:blue;">VAT</th>
                        <td style="width:50%;text-align:left;padding:5px;">35</td>
                    </tr>
                    <tr>
                        <th style="width:50%;text-align:left;padding:5px;color:blue;">Net Total</th>
                        <td style="width:50%;text-align:left;padding:5px;">35</td>
                    </tr>
                    </table>
                </td>
            </tr>
            
        </table>
    </div>
    
    <div class="section">
        <div class="reminder-sect">
        <p style="color:blue;">
        1 - No garantee for glass / breakable items Company not responsible items received in damaged condition. 2 - \Complaints will not be accepted after 2
        days from the date of delivery 3 - Company not responsible for octray charges charges or any other vcharges levied locally. 4 - In case of claim (loss)
        proof of documents should be produced In case of loss of package . settlement will be made (20 S. R./ KG) as per company rules. 6 - company will not
        take responsibility for natural calamity and delay in customs clearance
        </p>
        </div>
    </div>

    <div class="section footer">
        
        <div style="width:25%;display:inline-block;text-align: left;">
            <h4 style="display:inline-block;color:blue;"> Shippers signature </h4>
        </div>
        <div style="width:48%;display:inline-block;text-align: center;">
            <h4 style="display:inline-block;color:red;"> Thanks for your Visit! Come Again. </h4>
        </div>
        <div style="width:25%;display:inline-block;text-align: right;">
            <h4 style="display:inline-block;color:blue;">Checked & Received by </h4>
        </div>
    </div>

</body>
</html>