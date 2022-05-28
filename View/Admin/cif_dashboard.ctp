<?= $this->element('cssJs/charts'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <section class="content drillDown">
        <div class="row">
            <div class="col-md-12" align="center">
                <button type="button" class="btn btn-info">K-Tech Innovation Hub - CIF <?= $this->Session->read('Phase'); ?></button>
            </div>
        </div>
        <div class="row mt-15">
            <div class="col-lg-8">

            </div>
            <div class="col-2 mb-20">
            
                <?php echo $this->Form->input("year", array("type" => "select", "class" => "form-control select2 yearWise pull-right", "options" => $years, "label" => false, "empty" => "Year",'value'=>$year)) ?>
          
            </div>
            <div class="col-2 mb-20">
                <?php echo $this->Html->link('<span><i class="fa fa-arrow-left"></i> Dashboard</span>', array("controller" => "Admin", "action" => "cifDashboard"), array('class' => 'btn btn-info pull-right btn-sm', "escape" => false)); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Cif/Dashboard/events'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Cif/Dashboard/publicity_mentions'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Cif/Dashboard/startups_enrolled'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Cif/Dashboard/startups_raising_fund'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Cif/Dashboard/gender_diversity'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Cif/Dashboard/external_event_participation'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Cif/Dashboard/connects'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Cif/Dashboard/customer_satisfaction'); ?>
            </div>
            <div class="col-12">
                <?php echo $this->element('Cif/Dashboard/fund_expence'); ?>
            </div>
        </div>
    </section>
</div>
<div class="modal center-modal fade" id="chartDetailModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="chartDetailModalContent">


            </div>
        </div>
    </div>
<script>
    $(function() {
        'use strict';
        $.fn.loadModalData = function(type ,category,id) { 
            console.log(type,category,year);

            let url =encodeURI('<?php echo Router::url(array("controller" => "Admin", "action" => "cifDashboardDetail")); ?>?type='+type+'&category='+category+'&year='+ $('#year').val()+'&id='+id);
            $('#chartDetailModalContent').load(url, function() {
                $('#chartDetailModal').modal({
                    show: true
                });
            });
        }

        // $('#cif_events').load('<?php echo Router::url(array("controller" => "cifDashboard", "action" => "events")); ?>');
        $('#year').on('change', function() {
            location.href='<?php echo Router::url(array("controller" => "Admin", "action" => "cifDashboard")); ?>/'+$(this).val();
        });
    });
</script>