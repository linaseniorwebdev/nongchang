<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="public/js/core/app-menu.js"></script>
<script src="public/js/core/app.js"></script>
<script src="public/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="public/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="public/vendors/js/tables/buttons.colVis.min.js"></script>
<script src="public/vendors/js/tables/datatable/dataTables.colReorder.min.js"></script>
<script src="public/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
<script src="public/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
<script src="public/vendors/js/tables/datatable/dataTables.fixedHeader.min.js"></script>
<script src="public/vendors/js/extensions/sweetalert.min.js"></script>
<script src="public/vendors/js/extensions/toastr.min.js"></script>
<script src="public/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>
<script src="public/vendors/js/charts/jvector/china.js"></script>
<script src="public/vendors/js/forms/select/select2.full.min.js"></script>
<script src="public/vendors/js/forms/select/selectize.min.js"></script>
<script src="public/vendors/js/extensions/cropper.min.js"></script>
<script src="public/vendors/js/jasny-bootstrap/jasny-bootstrap.js"></script>
<script src="https://open.ys7.com/sdk/js/1.4/ezuikit.js"></script>
<?php
if (isset($name))
	echo '<script src="public/js/admin/' . $name . '.js"></script>';
?>
</body>

</html>