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
            <td>{{ $order->Volume }}</td>
            <td>{{ $order->Order }}</td>
            @if($order->State == 0)
                <span class="badge bg-secondary">Order Started</span>
            @elseif($order->State == 1)
                <span class="badge bg-success">Order Placed</span>
            @elseif($order->State == 2)
                <span class="badge bg-danger">Canceled by Client</span>
            @else($order->State == 3)
                <span class="badge bg-warning text-dark">Partially Filled</span>
            @endif
        </tr>
    @empty
        @php echo userTableEmptyMessage('order') @endphp
    @endforelse
</tbody>