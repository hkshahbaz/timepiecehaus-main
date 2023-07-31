<script type="text/javascript">
    $(function () {
        @if(session()->get('success'))
        new PNotify({
            title: 'Success',
            layout: 'center',
            text: '{{ session()->get('msg') }}',
            icon: 'icon-checkmark3',
            type: 'success'
        });
        @endif
        @if(session()->get('error'))
        new PNotify({
            title: 'Error',
            layout: 'center',
            text: '{{ session()->get('msg') }}',
            icon: 'icon-checkmark3',
            type: 'error'
        });
        @endif
    });
</script>
