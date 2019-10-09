<div class="order-box">
    <table id="order" class="display"  width="100%">
        <thead>
            <tr>
                <th>الحالة</th>
                <th>السعر</th>
                <th>الكمية</th>
                <th>المنتج</th>
            </tr>
        </thead>
        <tfoot>
        </tfoot>
        <tbody>
            @php
            $total_price = 0;
            $count_product  = 0
            @endphp
            @foreach($items as $item)

                @php
                    $total_price +=  ($item->price * $item->quantity);
                    $count_product += $item->quantity;
                @endphp
                <tr>
                    <th>{{ __(ucfirst($item->status)) }}</th>
                    <th>{{ $item->price }}</th>
                    <th>{{ $item->quantity }}</th>
                    <th>{{ $item->name }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    <table>
    <tr >
        <td id="total">{{ $total_price }}</td>
        <th>الأجمالى</th>
        <td id="status"> {{  __(ucfirst($order->status)) }}</td>
        <th>الحالة</th>
    </tr>
        <tr>
            <td id="discount_value">{{ $order->discount  }}</td>
            <th>قيمة الخصم</th>

            <td id="order_number">{{ $count_product }}</td>
            <th>العدد</th>
        </tr>
        @if($order->coupon_id != '')
            <tr id="coupon_info">
                <td id="total">{{ $total_price - $order->discount }}</td>
                <th>الصافى</th>
            </tr>
        @endif
    </table>
</div>
