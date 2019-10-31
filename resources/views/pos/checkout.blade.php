<div class="order-box">
    <input type="hidden" id ="_order_token" value="{{ csrf_token()}}"/>
    @if(isset($order))
        <input type="hidden" id ="order_id" value="{{ $order->id }}"/>
    @endif
    <table id="order" class="display"  width="100%">
        <thead>
            <tr>
                <th>X</th>
                <th>السعر</th>
                <th>الكمية</th>
                <th>الصنف</th>
                <th>المنتج</th>
                <th>p_id</th>
            </tr>
        </thead>
        <tfoot>
        </tfoot>
        <tbody>
            @php
            $quantity = 0;
            $total = 0;
            @endphp
            @if(isset($items))
                @foreach($items as $item)
                    @php
                        $quantity += $item->quantity;
                        $total += ($item->price * $item->quantity);
                    @endphp
                    <tr>
                        <td>
                            <span class="delete fas fa-trash-alt"></span>
                        </td>
                        <td><span class="price"> {{ $item->price }}</span></td>
                        <td><span class=" qty-inc"><i class="fas fa-plus-square"></i></span>
                            <span class="qty" data-product-id="{{ $item->product_id }}">{{ $item->quantity }}</span>
                            <span class=" qty-dec"><i class="fas fa-minus-square"></i></span>
                        </td>
                        <td></td>
                        <td><span class="name">{{ $item->name }}</span></td>
                        <td><span  class="p_id">{{ $item->product_id }}</span></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<div>
    <table>
    <tr >
        <td id="count">{{ $quantity }}</td>
        <th>العدد</th>
        <td id="total">{{ $total }}</td>
        <th>الأجمالى</th>
    </tr>
    </table>
</div>
<div class="row" id="checkout-from">
    <div class="input-field col s12">
        <input id="coupon" type="text" value="{{ isset($order) && $order->coupon_id !='' ? $order->code:'' }}">
        <label for="coupon" >لديك كوبون خصم؟</label>
    </div>
    <div class="input-field col s6">
        <input id="notes" type="text" value="{{ isset($order) ? $order->notes:'' }}">
        <label for="notes"> ملاحظات علي الطلب</label>
    </div>
    <div class="input-field col s6">
        <input id="table_number" type="text" value="{{ isset($order) ? $order->table_number:'' }}">
        <label for="table_number"> رقم التربيزة/العميل </label>
    </div>
    <div class="col s12">
        <div id="buttons">
            <button type="button" id="clear" class="btn btn-danger">إلغاء</button>
            <button type="button" id="payment" class="btn btn-success">تنفيذ</button>
        </div>
    </div>
</div>
<div id="checkout-processing">
    <div class="col s12">
        <div class="loader">Proccesing...</div>
    </div>
</div>
<div id="order-status">
        <table>
            <tr>
                <td id="status"></td>
                <th>الحالة</th>
                <td id="order_number"></td>
                <th>رقم الأوردر</th>
            </tr>
            <tr id="coupon_info">
                <td id="discount_value"></td>
                <th>قيمة الخصم</th>
                <td id="coupon_code"></td>
                <th>كود الخصم</th>
            </tr>
        </table>
</div>

