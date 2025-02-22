<tbody>
    @forelse($openOrders as $order)
        <tr class="tr-{{ $order->Order}}">
            <td>{{ $order->Time }}</td>
            <td>{{ $order->Symbol }}</td>
            <td>{{ $order->Profit }}</td>
            <td>{{ $order->Commission }}</td>
            <td>{{ $order->Fee }}</td>
            <td>{{ $order->PositionID}}</td>
            <td>{{ $order->PriceSL }}</td>
            <td>{{ $order->PriceTP }}</td>
            <td>{{ number_format($order->Volume / 100000, 3) }} lot</td>
            <td>{{ $order->Order }}</td>
        </tr>
    @empty
        @php echo userTableEmptyMessage('order') @endphp
    @endforelse
</tbody>