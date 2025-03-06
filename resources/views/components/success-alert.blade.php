@if(session('success'))
    <div id="success-alert" class="fixed top-16 right-5 bg-green-500 text-white p-4 rounded-lg mb-4 transition-opacity duration-500 ease-in-out opacity-0 transform translate-y-4" role="alert">
        {{ session('success') }}
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('opacity-0', 'translate-y-4');
            alert.classList.add('opacity-100', 'translate-y-0');

            setTimeout(() => {
                alert.classList.remove('opacity-100', 'translate-y-0');
                alert.classList.add('opacity-0', 'translate-y-4');
            }, 2000);
        }
    });
</script>
