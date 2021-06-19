<!-- partial:partials/_footer.html -->
<footer class="footer">
   <div class="container-fluid clearfix">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
         &copy; <?= date('Y'); ?>
         <a href="https://www.sttgarut.ac.id/" class="font-weight-bold ml-1" target="_blank">Sekolah Tinggi Teknologi Garut</a>
      </span>
   </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../assets/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="../assets/js/file-upload.js"></script>


<!-- dataTables -->
<script type="text/javascript" src="../assets/vendors/dataTables/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../assets/vendors/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/vendors/dataTables/dataTables.bootstrap4.min.js"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script> -->

<script>
   $(document).ready(function() {
      $('#example').DataTable({
         "language": {
            "url": "../assets/vendors/dataTables/Indonesian.json",
            "sEmptyTables": "Tidads"
         }
      });
   });
</script>

<!-- End custom js for this page -->
</body>

</html>