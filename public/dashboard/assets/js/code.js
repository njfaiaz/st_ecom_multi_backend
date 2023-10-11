$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
            Swal.fire({
            title: 'Are you sure?',
            text: "Delete This Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        })
    });
  });

  $(function(){
    $(document).on('click','#block',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
            Swal.fire({
            title: 'Are you sure?',
            text: "Block This User?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Block it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                'Blocked!',
                'User has been Blocked.',
                'success'
                )
            }
        })
    });
  });

  $(function(){
    $(document).on('click','#unblock',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
            Swal.fire({
            title: 'Are you sure?',
            text: "Unblock This User?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Unblock it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                'Unblock!',
                'User has been Active.',
                'success'
                )
            }
        })
    });
  });
