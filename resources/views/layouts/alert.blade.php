<script>

    let alertInfo = @json(session('alert'))

    @if(session('alert'))
    Swal.fire(
        info.title,
        info.message,
        info.icon
    )
    @endif
</script>
