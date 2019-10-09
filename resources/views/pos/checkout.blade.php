<div class="order-box">
    <input type="hidden" id ="_order_token" value="{{ csrf_token()}}"/>
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
        </tbody>
    </table>
</div>
<div>
    <table>
    <tr >
        <td id="count">0</td>
        <th>العدد</th>
        <td id="total">0</td>
        <th>الأجمالى</th>
    </tr>
    </table>
</div>
<div class="row" id="checkout-from">
    <div class="input-field col s12">
        <input id="coupon" type="text">
        <label for="coupon" >لديك كوبون خصم؟</label>
    </div>
    <div class="input-field col s6">
        <input id="notes" type="text">
        <label for="notes"> ملاحظات علي الطلب</label>
    </div>
    <div class="input-field col s6">
        <input id="table_number" type="text">
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

