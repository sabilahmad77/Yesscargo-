<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 20px 20px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
        }


        header {
            position: relative;
        }

        footer {
            position: relative;
        }

        th, td {
            border: 1px solid;
            text-align: center;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<!-- Define header and footer blocks before your content -->
<header>
    <table style="width:100%;">
        <tr>
            <td style="width:40%;text-align:left;border-style:none;">
                <img src="gen-img/Yes-Cargo-Logo.png" alt=""
                     style="display:inline;padding-left:0px;margin-left:0px;" width="300">
            </td>
            <td style="width:60%;text-align:right;border-style:none;">
                <p style="font-size:12px;margin:0px;">Near Ladies Market Behind New CityFlower <br> Supermarket,
                    Seiko,Dammam,Saudi Arabia <br>
                    0138838835, 0548240456, 0573165148 <br>
                    www.yescargosaudi.in

                </p>
            </td>
        </tr>
    </table>

</header>



<!-- Wrap the content of your PDF inside a main tag -->
<main style="padding-top: 10px !important; padding-bottom: 16px !important;">

    <table style=" border: 0 !important; width: 100%;">
        <tr>
            <td style="width: 22%;  border: 0 !important; vertical-align: top; ">
                <table style="border-collapse: collapse;" id="tabl1">
                    <tr>
                        <th style="font-size:12px;">DATE</th>
                    </tr>

                    <tr>
                        <td style="font-size:13px;">{{ $invoice->created_at->format('d/m/Y') }}</td>
                    </tr>

                    <tr>
                        <th style="font-size:12px;padding:5px 10px;">Shipment Mode</th>
                    </tr>

                    <tr>
                        <td style="font-size:13px;padding:7px 0px;">{{ $invoice->shipment_mode_slug }}</td>
                    </tr>

                </table>
            </td>
            <td style="width: 28%;  border: 0 !important; vertical-align: top;">
                <table style="border-collapse: collapse; border: 1px solid;">
                    <tr>
                        <th style="padding:5px 0px;"><span style="color:#1f1867;font-size:18px;"> YES CARGO </span></th>
                    </tr>
                    <tr>
                        <th style="font-size:12px;padding:5px 10px;">INVOICE / HAWB NUMBER</th>
                    </tr>
                    <tr>
                        <td style="font-size:13px;padding:10px 0px;">{{ $invoice->invoice_no }}</td>
                    </tr>

                </table>
            </td>
            <td style="width: 48%; padding-left:10px;  border: 0 !important; vertical-align: top;">
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
                        <th colspan="5" style="font-size:12px;padding:11px 0px;">Boxes : {{ $invoice->boxes->count() }}</th>
                        <th colspan="5" style="font-size:12px;">Kg : {{ $boxesWeight }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" style="font-size:12px;padding:11px 0px;">Bill Amount</th>
                        <th colspan="5" style="font-size:12px;">{{ 'SAR '. number_format($netBill, 2) }} </th>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style=" padding-top: 10px; padding-bottom: 10px;">
        <table style="width:100%;">
            <tr>
                <th style="text-align:left; width:50%;font-size:12px;padding-left:5px;">Shipper</th>
                <th style="text-align:left; width:50%;font-size:12px;padding-left:5px;">Consignee Details</th>
            </tr>
            <tbody>
            <tr>
                <td style="text-align:left;padding-left:5px;">
                    <p style="margin:0px;font-size:13px;">MR. {{ $invoice->customer->name }}</p>
                    <p style="margin:0px;font-size:13px;">{{ $invoice->customer->city }}</p>
                    <p style="margin:0px;font-size:13px;">{{ $invoice->customer->phone1 }}</p>
                    <p style="margin:0px;font-size:13px;"></p>
                </td>
                <td style="text-align:left;padding-left:5px;">
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

    <table style="width:100%;">
        <tbody>
        <tr>
            <td style="width:50% !important; vertical-align: top;">
                <table style="width:100%;">
                    <thead style="background-color:red;">
                    <tr>
                        <th style="color:white; font-size:12px !important;">S. N.</th>
                        <th style="color:white; font-size:12px !important;">Item Description: السلعة وص</th>
                        <th style="color:white; font-size:12px !important;">Qty: كمية</th>
                        <th style="color:white; font-size:12px !important;">Value (SAR): قيمة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoice->boxes as $box)
                        @if($loop->odd)
                            <tr>
                                <td colspan="4"
                                    style="background-color:yellow; color:black; font-size:13px !important;">
                                    {{ 'Box '. $loop->iteration}}
                                    -&nbsp;{{  $box->box_weight .'kg' }}</td>
                            </tr>
                            @foreach($box->boxes_items as $boxItem)
                                <tr>
                                    <td style="font-size:13px !important;">{{ $loop->iteration }}</td>
                                    <td style="font-size:13px !important;">{{ $boxItem->item_name }}</td>
                                    <td style="font-size:13px !important;">{{ $boxItem->quantity }}</td>
                                    <td style="font-size:13px !important;">{{ $boxItem->item_per_cost }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </td>
            <td style="width:50% !important; vertical-align: top;">
                <table style="width:100%;">
                    <thead style="background-color:red;">
                    <tr>
                        <th style="color:white; font-size:12px !important;">S. N.</th>
                        <th style="color:white; font-size:12px !important;">Item Description: السلعة وص</th>
                        <th style="color:white; font-size:12px !important;">Qty: كمية</th>
                        <th style="color:white; font-size:12px !important;">Value (SAR): قيمة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoice->boxes as $box)
                        @if($loop->even)
                            <tr>
                                <td colspan="4"
                                    style="background-color:yellow; color:black; font-size:13px !important;">
                                    {{ 'Box '. $loop->iteration}}
                                     -&nbsp;{{  $box->box_weight .'kg' }}</td>
                            </tr>
                            @foreach($box->boxes_items as $boxItem)
                                <tr>
                                    <td style="font-size:13px !important;">{{ $loop->iteration }}</td>
                                    <td style="font-size:13px !important;">{{ $boxItem->item_name }}</td>
                                    <td style="font-size:13px !important;">{{ $boxItem->quantity }}</td>
                                    <td style="font-size:13px !important;">{{ $boxItem->item_per_cost }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>

    </table>

    <table style="width:100%; margin-top:10px; margin-bottom:10px;">
        <tbody>
        <tr>
            <td style="font-size: 13px; border-style:none;text-align:left;">Amount in words: <span style="text-transform: uppercase;"> {{ $amountString }} </span> </td>
            <td style="font-size: 13px; border-style:none;text-align:right;">المبلغ بالكلمات</td>
        </tr>
        <tr>
            <td style=" font-size: 13px; border-style:none;text-align:left;">Remarks: {{ $invoice->invoice_note }}</td>
            <td style="border-style:none;text-align:right; font-size: 13px;">      ملاحظات</td>
        </tr>
        </tbody>
    </table>

    <table style="width: 100% !important; border:0px !important;" width="100%">
        <tbody>
        <tr>
            <td style="width: 40%; border:0px !important; vertical-align: top;">
                <table style="width:97%; border:0px !important;">
                    <tr>
                        <td style="text-align:left;border: 1px solid blue; padding:6px;">
                            <div
                                style="color: black !important; text-align:left; font-weight: bold; margin-bottom: 5px; font-size:14px !important;direction: rtl">
                                PROHIBITED
                                & RESTRICTED GOODS : قيود تحريم البضائع
                            </div>
                            <div style="color: red !important; text-align:left; font-size:10px !important;  margin-bottom: 5px;">
                                ماء زمزم أو سائل أو بطاريات أو أي مواد قابلة لإشعال أسطوانة غاز أو أسمنت أو ساعة أو
                                كاميرا أو هاتف محمول أو كمبيوتر محمول إلخ ... جميع المنتجات البترولية والزي العسكري
                                والشرطي إلخ.
                            </div>
                            <div style="color: blue !important; text-align:left; font-size:11px !important;">
                                Zamzam water, liquid, batteries, or any flammable items
                                Gascylinder, Cement, Watch, Camera, Mobile, Lap top
                                Etc... All Petrolium Products, Miltary & Police uniform
                                Etc....
                            </div>
                        </td>
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

                </table>
            </td>
            <td style="width: 20%; border:0px !important; vertical-align: top;">
                <table style="width:98%;border:none;">
                    <tr>
                        <th style="border:none;">
                            <img src="data:image/png;base64, {!! $qrcode !!}">
                        </th>
                    </tr>
                </table>
            </td>
            <td style="width: 40%; border:0px !important; vertical-align: top;">
                <table style="width:100%;">
                    <thead>
                    <tr>
                        <th style="text-align:left;padding:4px;width:60%; font-size: 13px;"><span
                                style="color:blue;font-size:10px;"> Amount </span><span
                                style="color:blue;font-size:10px;display:inline;float:right;">الإجمالي</span></th>
                        <th style="text-align:left;padding:4px;width:40%;font-size:11px;">{{ 'SAR '.number_format($boxShipmentCharges, 2) }} </th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding:4px;width:60%; font-size: 10px;"><span
                                style="color:blue;font-size:10px;">Packaging </span> <span
                                style="color:blue;font-size:10px;display:inline;float:right;">رسوم التعبئة</span></th>
                        <th style="text-align:left;padding:4px;width:40%;font-size:11px;">{{ 'SAR '.number_format($invoice->packing_charges,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding:4px;width:60%; font-size: 10px;"><span
                                style="color:blue;font-size:10px;"> Box </span> <span
                                style="color:blue;font-size:10px;display:inline;float:right;">رسوم الصندوق</span></th>
                        <th style="text-align:left;padding:4px;width:40%;font-size:11px;">{{ 'SAR '.number_format($invoice->box_charges,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding:4px;width:60%; font-size: 10px;"><span
                                style="color:blue;font-size:10px;"> Invoice </span> <span
                                style="color:blue;font-size:10px;display:inline;float:right;"> رسوم الفاتورة</span></th>
                        <th style="text-align:left;padding:4px;width:40%;font-size:11px;">{{ 'SAR '.number_format($invoice->bill_charges,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding:4px;width:60%; font-size: 10px;"><span
                                style="color:blue;font-size:10px;">Other </span> <span
                                style="color:blue;font-size:10px;display:inline;float:right;">رسوم الاخرى</span></th>
                        <th style="text-align:left;padding:4px;width:40%;font-size:11px;"> {{'SAR ' . number_format($invoice->other_charges,2) }} </th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding:4px;width:60%; font-size: 13px;"><span
                                style="color:blue;font-size:10px;">Discount  </span> <span
                                style="color:blue;font-size:10px;display:inline;float:right;"> الخصم</span></th>
                        <th style="text-align:left;padding:4px;width:40%;font-size:11px;">{{ 'SAR '.number_format($invoice->discount,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding:4px;width:60%; font-size: 10px;"><span
                                style="color:blue;font-size:10px;">VAT </span> <span
                                style="color:blue;font-size:10px;display:inline;float:right;"> ضريبة القيمة المضافة </span>
                        </th>
                        <th style="text-align:left;padding:4px;width:40%;font-size:11px;">{{ 'SAR '.number_format($vat_value,2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align:left;padding:4px;width:60%; font-size: 10px;"><span
                                style="color:blue;font-size:10px;">Net Total </span> <span
                                style="color:blue;font-size:10px;display:inline;float:right;">الإجمالي الصافي</span>
                        </th>
                        <th style="text-align:left;padding:4px;width:40%;font-size:11px;">{{ 'SAR '. number_format($netBill,2) }}</th>
                    </tr>
                    </thead>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <table style="width:100%; margin-top:10px; float: unset;">
        <tr>
            <div style="border: 1px solid blue; padding:10px;">
                <div style="font-weight: bold; color:black; font-size: 14px;margin-bottom: 10px;">
                    TERMS & CONDITIONS
                </div>
                <div style="color: red !important; margin-bottom:6px; text-align:left; font-size:10px !important;">
                    لشروط : لا يوجد ضمان للزجاج / العناصر القابلة للكسر. الشركة غير مسؤولة عن العناصر المستلمة في حالة
                    تالفة. 2 - / لن تقبل الشكاوي بعد 2
                    أيام من تاريخ التسليم 3 - الشركة غير مسؤولة عن رسوم التصوير أو أي رسوم أخرى تفرض محليًا. 4 - في حالة
                    المطالبة (خسارة)
                    يجب إبراز ما يثبت المستندات في حالة فقد العبوة. تتم التسوية (20 ر.س. / كجم) لكل قواعد الشركة. 6- لن
                    تقوم الشركة بذلك
                    تحمل المسؤولية عن الكوارث الطبيعية والتأخير في التخليص الجمركي
                </div>
                <div style="color: blue !important; text-align:left; font-size:10px !important;">

                    1 - No garantee for glass / breakable items Company not responsible items received in damaged
                    condition. 2 - \Complaints will not be accepted after 2
                    days from the date of delivery 3 - Company not responsible for octray charges charges or any other
                    vcharges levied locally. 4 - In case of claim (loss)
                    proof of documents should be produced In case of loss of package . settlement will be made (20 S.
                    R./ KG) as per company rules. 6 - company will not
                    take responsibility for natural calamity and delay in customs clearance :
                </div>
            </div>
        </tr>
    </table>

</main>
<footer>

    <table style="width:100%;">
        <tr>
            <th style="border-style:none;font-size:13px;font-weight:400;text-align:left;font-weight:bold;">Shippers
                signature الشاحن توقيع</th>
            <th style="border-style:none;font-size:13px;font-weight:400;text-align:center;color:#b71c1c;font-weight:bold;">
                Thanks for your Visit ! Come Again
            </th>
            <th style="border-style:none;font-size:13px;font-weight:400;text-align:right;font-weight:bold;">Checked &
                Received by <img src="{{ public_path('gen-img/Checked & Received by.webp') }}" alt=""
                                 style="display:inline;padding-left:10px;" width="60"></th>
        </tr>
    </table>

</footer>
</body>
</html>
