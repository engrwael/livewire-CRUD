@extends('layouts.base')

@section('pageTitle')
Home Page
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        <h1>Livewire CRUD</h1>
        <hr style="background-color:salmon">
        @livewire('country-component')
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.addEventListener('openAddCountryModal', function(e) {
        //alert(e.detail.title);
        $('#AddCountryModal').modal('show');
    })

    window.addEventListener('openEditCountryModal', function(e) {
        //alert(e.detail.id);
        $('#EditCountryModal').modal('show');
    })

    window.addEventListener('success', function(e) {
        $('#AddCountryModal').modal('hide');
        Swal.fire(
            'Good job!'
            , e.detail.success
            , 'success'
            , 'timerProgressBar'

        )
    })

    window.addEventListener('success-update', function(e) {
        $('#EditCountryModal').modal('hide');
        // Swal.fire(
        //     'Good job!'
        //     , e.detail.success
        //     , 'success'
        // )

        const Toast = Swal.mixin({
            toast: true
            , position: 'top-end'
            , showConfirmButton: false
            , timer: 3000
            , timerProgressBar: true
            , didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success'
            , title: 'Updated successfully'
            , color: '#f00'
        })

    })

    window.addEventListener('confirm-delete', function(e) {
        Swal.fire({
            title: e.detail.confirm
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
            , allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value) {
                    window.livewire.emit('deleted', e.detail.id);

                }
            }
        })

    })

    window.addEventListener('delete-success', function(e) {
        Swal.fire(
            'Deleted!'
            , e.detail.success
            , 'success'
        )
    });

    window.addEventListener('multiple-delete', function(e) {
        Swal.fire({
            title: e.detail.confirm
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
            , allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value) {
                    window.livewire.emit('multi-deleted', e.detail.ids);
                }
            }
        })
    })

    window.addEventListener('multi-delete-success', function(e) {
        Swal.fire(
            'Deleted!'
            , e.detail.success
            , 'success'
        )
    });

    window.addEventListener('multiple-delete-error', function(e) {
        Swal.fire({
            icon: 'error'
            , title: e.detail.confirm
        })
    })

</script>
@endsection
