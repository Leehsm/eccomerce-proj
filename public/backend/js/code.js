$(function(){
    $(document).on('click','#delete',function(e){
      e.preventDefault();
      var link = $(this).attr("href");

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
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

//Confirm
$(function(){
  $(document).on('click','#confirm',function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: 'Are you sure?',
      text: "Once confirm, you won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, confirm order.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Confirm!',
          'Confirm Changes',
          'success'
        )
      }
    })
  });
});

//Processing
$(function(){
  $(document).on('click','#processing',function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: 'Are you sure?',
      text: "Once confirm, you won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, process order.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Processing!',
          'Processing Order',
          'success'
        )
      }
    })
  });
});

//PICKED
$(function(){
  $(document).on('click','#picked',function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: 'Are you sure?',
      text: "Once confirm, you won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, picked order.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Picked!',
          'Order Picked',
          'success'
        )
      }
    })
  });
});

//Shipped
$(function(){
  $(document).on('click','#shipped',function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: 'Are you sure?',
      text: "Once confirm, you won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, ship order.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Shipped!',
          'Order Shipped',
          'success'
        )
      }
    })
  });
});

//Dilevered
$(function(){
  $(document).on('click','#delivered',function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: 'Are you sure?',
      text: "Once confirm, you won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, deliver order.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Delivered!',
          'Order Delivered',
          'success'
        )
      }
    })
  });
});

//Cancel
$(function(){
  $(document).on('click','#cancel',function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: 'Are you sure?',
      text: "Once confirm, you won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, cancel order.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Cancel!',
          'Order Cancel',
          'success'
        )
      }
    })
  });
});