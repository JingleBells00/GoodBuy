<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Invoice</title>

        @include('mails.invoice_styles')
    </head>

    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                @foreach($orders as $order)

                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <h2>GoodBuy</h2>
                                </td>

                                <td>
                                    Invoice #: @php

                                    echo(rand(0,10000));

                                    @endphp
                                    <br>
                                    {{$order->created_at}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    {{$order->address}}
                                </td>

                                <td>
                                    {{$order->name}}<br>
                                    {{Session::get('client')->email}}

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endforeach

                <tr class="heading">
                    <td>
                        Payment Method
                    </td>

                    <td>
                        Check #
                    </td>
                </tr>

                <tr class="details">
                    <td>
                        Credit cards
                    </td>

                    <td>
                        1000
                    </td>
                </tr>

                <table>
                    <tr class="heading">
                        <td>
                            Item
                        </td>
                        <td>
                            Quantity
                        </td>
                        <td>
                            Unit cost
                        </td>
                        <td>
                            Price
                        </td>
                    </tr>

                    @foreach($orders as $order)
                    @foreach($order->cart->items as $item)
                    <tr class="item">
                        <td>
                            {{$item['product_name']}}
                        </td>
                        <td>{{$item['qty']}}</td>
                        <td>{{$item['product_price']}}</td>
                        <td>
                            {{$item['product_price'] *$item['qty']}}
                        </td>
                    </tr>
                    @endforeach
                    <tr class="total">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            Total: ${{$order->cart->totalPrice}}
                        </td>
                    </tr>
                    @endforeach

                    </tr>
                </table>
            </table>
        </div>
    </body>

</html>