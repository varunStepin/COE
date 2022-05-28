
<!-- css -->
<?php  echo $this->Html->css('../assets/vendor_components/datatable/datatables.min');?>



<style>
    table.dataTable  {
        color: #151414;
        border-collapse: collapse !important;
    }
</style>


<!-- Js -->

<?php  echo $this->Html->script('../assets/vendor_components/datatable/datatables.min');?>
<?php echo $this->Html->script('pages/data-table');?>