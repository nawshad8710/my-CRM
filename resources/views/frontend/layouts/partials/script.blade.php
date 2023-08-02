 <!-- google jquery cdn  -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <!-- bootstrap bundle -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
 <!-- aos animation -->
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 <!-- slick slider -->
 <script src="{{asset('assets/frontend/js/slick.min.js')}}"></script>
 <!-- magnific popup -->
 <script src="{{asset('assets/frontend/js/jquery.magnific-popup.min.js')}}"></script>
 <!-- typed js -->
 <script src="https://unpkg.com/typed.js@2.0.132/dist/typed.umd.js"></script>
 <!-- app js -->
 <script src="{{asset('assets/frontend/js/app.js')}}"></script>
 <!-- aos animation -->
 <script>
     // aos
      AOS.init({
          duration: 1200,
          offset: 1,
      });
  </script>
 <!-- type js -->
 <script>
     var typed = new Typed('#element', {
     strings: ["E-commarce", "Pos Management","ERP Software"],
     loop: true,
     typeSpeed: 100,
     backSpeed: 50,
     });
   </script>
