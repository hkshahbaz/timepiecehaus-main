@isset($order)
    @if($order->status_id == 12)
        Waiting For Payment
    @elseif($order->status_id == 13)
        -
    @else
        @php $statuses->prepend("Select Status", ""); @endphp
        {!! Form::select('status_id', $statuses, old('status_id'),
        ['class' => 'form-control order_status_id', 'required',
        'onchange' => 'updateStatus('.$order->id.', this.value)',
        'data-placeholder' => "Select Status"]) !!}

        <script type="text/javascript">
            $(".order_status_id").select2();
        </script>
    @endif
@endisset
