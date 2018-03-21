	
    
    
    

	<link rel="stylesheet" href="<?php echo base_url();?>assets/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/js/select2/select2.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/js/selectboxit/jquery.selectBoxIt.css">

   	<!-- Bottom Scripts -->
	<script src="<?php echo base_url();?>assets/js/gsap/main-gsap.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/js/joinable.js"></script>
	<script src="<?php echo base_url();?>assets/js/resizeable.js"></script>
	<script src="<?php echo base_url();?>assets/js/neon-api.js"></script>
	<script src="<?php echo base_url();?>assets/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/chart.bundle.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/utils.js"></script>
    
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/datatables/TableTools.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo base_url();?>assets/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
    <script src="<?php echo base_url();?>assets/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
    

    
	<script src="<?php echo base_url();?>assets/js/neon-calendar.js"></script>
	<script src="<?php echo base_url();?>assets/js/neon-chat.js"></script>
	<script src="<?php echo base_url();?>assets/js/neon-custom.js"></script>
	<script src="<?php echo base_url();?>assets/js/neon-demo.js"></script>

	<script src="<?php echo base_url();?>assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>


<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">
	toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>

<?php endif;?>

<?php if ($this->session->flashdata('error_message') != ""):?>

<script type="text/javascript">
	toastr.error('<?php echo $this->session->flashdata("error_message");?>');
</script>

<?php endif;?>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

<script>
window.onload = function () {

var options = {
	animationEnabled: true,  
	title:{
		text: "Institute Revenue by Year"
	},
	axisY: {
		title: "Revenue in India",
		valueFormatString: "#80,,.",
		suffix: "K",
		prefix: "₹"
	},
	data: [{
		type: "area",
		markerSize: 5,
		xValueFormatString: "YYYY",
		yValueFormatString: "₹#,##0.##",
		dataPoints: [
			{ x: new Date(2000, 0), y: 2289000 },
			{ x: new Date(2001, 0), y: 2830000 },
			{ x: new Date(2002, 0), y: 1009000 },
			{ x: new Date(2003, 0), y: 1840000 },
			{ x: new Date(2004, 0), y: 1396000 },
			{ x: new Date(2005, 0), y: 2613000 },
			{ x: new Date(2006, 0), y: 1821000 },
			{ x: new Date(2007, 0), y: 1000000 },
			{ x: new Date(2008, 0), y: 1397000 },
			{ x: new Date(2009, 0), y: 1506000 },
			{ x: new Date(2010, 0), y: 1798000 },
			{ x: new Date(2011, 0), y: 2386000 },
			{ x: new Date(2012, 0), y: 4704000},
			{ x: new Date(2013, 0), y: 4926000 },
			{ x: new Date(2014, 0), y: 1394000 },
			{ x: new Date(2015, 0), y: 972000 },
			{ x: new Date(2018, 0), y: 1140000 }

		]
	}]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
