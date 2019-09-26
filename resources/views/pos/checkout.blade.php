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

<div id="buttons">
    <button type="button" id="clear" class="btn btn-danger">إلغاء</button>
    <button type="button" id="payment" class="btn btn-success">تنفيذ</button>
</div>

