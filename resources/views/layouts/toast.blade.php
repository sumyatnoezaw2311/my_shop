<script>

    let info = @json(session('toast'))

    @if(session('toast'))
        setTimeout(function(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: info.icon,
            title: info.title,
        })
    },1000)
        @endif
</script>
