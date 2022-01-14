$('a.btn-delete').on('click', function(event) {
    event.preventDefault();
    Swal.fire({
        title: $(this).attr('title'),
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        confirmButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = $(this).attr('href');
        } else if (result.isDenied) {
            return false;
        }
    });
});

$('button.btn-delete').on('click', function(event) {
    event.preventDefault();
    Swal.fire({
        title: $(this).attr('title'),
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        confirmButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            $(this).parents('form:first').submit();
        } else if (result.isDenied) {
            return false;
        }
    });
});

$('.btn-deletes').on('click', function(event) {
    event.preventDefault();
    Swal.fire({
        title: $(this).attr('title'),
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        confirmButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            $('.form-deletes').submit();
        } else if (result.isDenied) {
            return false;
        }
    });
});