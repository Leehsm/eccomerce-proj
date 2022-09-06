<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Invoice</title>

        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            table{
                font-size: x-small;
            }
            tfoot tr td{
                font-weight: bold;
                font-size: x-small;
            }
            .gray {
                background-color: lightgray
            }
            .font{
            font-size: 15px;
            }
            .authority {
                /*text-align: center;*/
                float: right
            }
            .authority h5 {
                margin-top: -10px;
                color: rgb(0, 0, 0);
                /*text-align: center;*/
                margin-left: 35px;
            }
            .thanks p {
                color: rgb(0, 0, 0);;
                font-size: 16px;
                font-weight: normal;
                font-family: serif;
                margin-top: 20px;
            }
        </style>

    </head>
    <body>
        <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: rgb(0, 0, 0); font-size: 26px;"><strong>Sahira Shop</strong></h2>
            </td>
            <td align="right">
                <pre class="font" >
                    Sahira Shop HQ
                    +60-191111111
                    support@sahirshop.com
                    No. 10, Kampung Baru 25,
                    81500 Pontian, Johor,
                    Malaysia.<br>
                </pre>
            </td>
        </tr>

        </table>
        <table width="100%" style="background:white; padding:2px;"></table>
        <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
            <tr>
                <td>
                <p class="font" style="margin-left: 20px;">
                <strong>Name:</strong> {{ $order->name }} <br>
                <strong>Email:</strong> {{ $order->email }} <br>
                <strong>Phone:</strong> {{ $order->phone }} <br>
                    
                <strong>Address:</strong> {{ $order->address1 }}, 
                                          {{ $order->address2 }}, 
                                          {{ $order->post_code }}, 
                                          {{ $order->district }},
                                          {{ $order->state }}, 
                                          {{ $order->country }} <br>

                <strong>Note:</strong> {{ $order->notes }} 
                
                </p>
                </td>
                <td>
                <p class="font">
                    <h3><span style="color: rgb(0, 0, 0);">Invoice No:</span> #{{ $order->invoice_no }}</h3>
                    <strong>Order Date: </strong> {{ $order->order_date }} <br>
                    <strong>Delivery Date: </strong> {{ $order->delivered_date }} <br>
                    <strong>Payment Type : </strong> {{ $order->payment_type }} </span>
                </p>
                </td>
            </tr>
        </table>
        <br/>
        <h3>Products</h3>
        <table width="100%">
            <thead style="background-color: rgb(134, 125, 128); color:#000000;">
                <tr class="font">
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Code</th>
                    <th>Quantity</th>
                    <th>Unit Price </th>
                    <th>Total </th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItem as $item)
                <tr class="font">
                    <td align="center">
                        <img src="{{ public_path($item->product->product_thambnail) }}" height="60px;" width="60px;" alt="">
                    </td>
                    <td align="center">
                        {{ $item->product->product_name_en }}
                    </td>
                    <td align="center">
                        {{ $item->size }}
                    </td>
                    <td align="center">
                        {{ $item->color }}
                    </td>
                    <td align="center">
                        {{ $item->product->product_code }}
                    </td>
                    <td align="center">
                        {{ $item->qty }}
                    </td>
                    <td align="center">
                        Rm{{ $item->price }}
                    </td>
                    <td align="center">
                        RM{{ $item->price * $item->qty}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <table width="100%" style=" padding:0 10px 0 10px;">
            <tr>
                <td align="right" >
                    <h2><span style="color: rgb(0, 0, 0);">Subtotal (+ Shipping Fee):</span> {{ $order->amount }}</h2>
                    <h2><span style="color: rgb(0, 0, 0);">Total :</span> {{ $order->amount }}</h2>
                    <h2><span style="color: rgb(0, 0, 0);">{{ $order->status }}</h2>
                </td>
            </tr>
        </table>
        <div class="thanks mt-3">
        <p>Thank You </p>
        </div>
        <div class="authority float-right mt-5">
            <p>-----------------------------------</p>
            <h5>Authority Signature:</h5>
        </div>
    </body>
</html>