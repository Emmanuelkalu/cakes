
  <!-- add come -->
  <!-- Plugins-->
  <!-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
  <script src="plugins/jquery/dist/jquery.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/owl-carousel/owl.carousel.min.js"></script>
  <script src="plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
  <script src="plugins/jquery.waypoints.min.js"></script>
  <script src="plugins/jquery.countTo.js"></script>
  <script src="plugins/jquery.matchHeight-min.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- <script src="plugins/gmap3.min.js"></script> -->
  <script src="plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
  <script src="plugins/slick/slick/slick.min.js"></script>
  <script src="plugins/slick-animation.min.js"></script>
  <script src="plugins/jquery.slimscroll.min.js"></script>
  <!-- Custom scripts-->
  <script src="js/main.js?v=<?php echo time(); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const error = urlParams.get('error');
      const success = urlParams.get('success');

      if (error) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: error,
        });
      } else if (success) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: success,
        });
      }
    });



    // cart.js
$(document).ready(function() {
    $('.cartform').on('submit', function(e) {
        e.preventDefault();
        var productId = $(this).attr('data-id');
        var quantity = $(this).children($('input[name="qty"]')).val();; // You can modify this to allow quantity selection

        $.ajax({
            url: 'core/forms/add_to_cart',
            method: 'POST',
            data: { product_id: productId, quantity: quantity },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    toast('Item successfully added to your cart!', {link:'checkout',msg:'checkout now'});
                    updateCartCount(response.cartCount);
                } else {
                    toast('Error: ' + response.message);
                }
            },
            error: function(e) {
              console.log(e)
                toast('An error occurred. Please try again.');
            }
        });
    });

    function updateCartCount(count) {
        $('#cart-count').text(count);
    }


});



function toast (msg,action) {
  let body = document.querySelector('body');
  let newCont =document.createElement('div')
  newCont.className="toastr-container animate__animated animate__fadeIn"
  newCont.innerHTML = `
    <div class="toastr">
      <p class="msg">${msg}</p>
      <div style="${!action ? 'display:none' : '' }" class="flex end py-2">
      <a class="btn" href="${action?.link}">
        ${action?.msg}
      </a></div>
  </div>`
  body.prepend(newCont);

  setTimeout(() => {
    newCont.remove()
  }, 6000);
}

document.addEventListener('DOMContentLoaded', function() {
  // Get the header
  var header = document.querySelector('.header--3');
  
  // Get the offset position of the navbar
  var sticky = header.offsetTop;
  
  // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function stickyHeader() {
    if (window.pageYOffset > sticky) {
      header.classList.add('fixed-top');
    } else {
      header.classList.remove('fixed-top');
    }
  }
  
  // When the user scrolls the page, execute stickyHeader
  window.onscroll = function() {
    stickyHeader();
  };
});


  </script>