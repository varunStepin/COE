<?= $this->element('cssJs/charts'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<style>
    .tabs {
        margin-top: 20px;
    }

    .tabs-menu1 ul li a.active,
    .tabs-menu1 ul li a:hover {
        color: #ffffff !important;
        font-weight: 600 !important;
        border: none;
        height: 40px;
        transition-duration: 000.3s;
    }

    .tabs-menu1 ul li a {
        font-weight: 600 !important;
    }

    .color-tab-1 {
        border: #FF9800 2px solid;
        color: #FF9800 !important;
        font-weight: 600 !important;
    }

    .color-tab-1.active,
    .color-tab-1:hover {
        transition-duration: 1s;
        background: #eac554;
        background: -moz-linear-gradient(45deg, #eac554 0%, #FF9800 100%);
        background: -webkit-linear-gradient(45deg, #eac554 0%, #FF9800 100%);
        background: linear-gradient(45deg, #eac554 0%, #FF9800 100%);
        color: #FFFFFF !important;
        font-weight: 600 !important;
    }
    

    .color-tab-2 {
        border: #f32148 2px solid;
        color: #f32148 !important;
        font-weight: 600 !important;
    }

    .color-tab-2.active,
    .color-tab-2:hover
     {
        transition-duration: 1s;
        background: #9C27B0;
        background: -moz-linear-gradient(45deg, #f32148 0%, #b53f7b 100%);
        background: -webkit-linear-gradient(45deg, #f32148 0%, #b53f7b 100%);
        background: linear-gradient(45deg, #f32148 0%, #b53f7b 100%);
        color: #FFFFFF !important;
        font-weight: 600 !important;
    }

    .color-tab-3 {
        border: #009688 2px solid;
        color: #009688 !important;
        font-weight: 600 !important;
    }

    .color-tab-3.active,
    .color-tab-3:hover {
        transition-duration: 1s;
        background: #4caf50;
        background: -moz-linear-gradient(45deg, #4caf50 0%, #009688 100%);
        background: -webkit-linear-gradient(45deg, #4caf50 0%, #009688 100%);
        background: linear-gradient(45deg, #4caf50 0%, #009688 100%);
        color: #FFFFFF !important;
        font-weight: 600 !important;
    }
  
</style>
<div class="content-wrapper">
    <section class="content drillDown">
        <div class="row">
            <div class="col-md-12" align="center">
                <button type="button" class="btn btn-info">K-Tech Innovation Hub - CIF <?= $this->Session->read('Phase'); ?></button>
            </div>
        </div>
        <div class="row mt-15">
            <div class="col-lg-8">
                <div class="navbar-custom-menu">
                    <ul class="nav tabs-menu1">
                        <li class="mr-15">
                            <?php if ($this->Session->read('Centre') == 'Belgavi') { ?>
                                <a href="#" onclick="setCentre('Belgavi')" class="btn-sm color-tab-1 active sub-tabs">    Belgavi  </a>
                            <?php } else { ?>
                                <a href="#" onclick="setCentre('Belgavi')" class="btn-sm color-tab-1 sub-tabs">     Belgavi  </a>
                            <?php } ?>
                        </li>
                        <li class="mr-15">
                            <?php if ($this->Session->read('Centre') == 'Jalahalli') { ?>
                                <a href="#" onclick="setCentre('Jalahalli')" class="btn-sm color-tab-2 active sub-tabs">    Jalahalli</a>
                            <?php } else { ?>
                                <a href="#" onclick="setCentre('Jalahalli')" class="btn-sm color-tab-2 sub-tabs">     Jalahalli</a>
                            <?php } ?>
                        </li>
                        <li class="mr-15">
                            <?php if ($this->Session->read('Centre') == 'Mangalore') { ?>
                                <a href="#" onclick="setCentre('Mangalore')" class="btn-sm color-tab-3 active sub-tabs">   Mangalore</a>
                            <?php } else { ?>
                                <a href="#" onclick="setCentre('Mangalore')" class="btn-sm color-tab-3 sub-tabs">  Mangalore</a>
                            <?php } ?>
                        </li>
                        <li class="mr-15">
                            <?php if ($this->Session->read('Centre') == 'Mysuru') { ?>
                                <a href="#" onclick="setCentre('Mysuru')" class="btn-sm color-tab-1 active sub-tabs">  Mysuru</a>
                            <?php } else { ?>
                                <a href="#" onclick="setCentre('Mysuru')" class="btn-sm color-tab-1 sub-tabs">  Mysuru</a>
                            <?php } ?>
                        </li>
                        <li class="mr-15">
                            <?php if ($this->Session->read('Centre') == 'Shivamogga') { ?>
                                <a href="#" onclick="setCentre('Shivamogga')" class="btn-sm color-tab-2 active sub-tabs">  Shivamogga </a>
                            <?php } else { ?>
                                <a href="#" onclick="setCentre('Shivamogga')" class="btn-sm color-tab-2 sub-tabs">  Shivamogga </a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
               
            </div>

            <div class="col-2 mb-20">
                <?php echo $this->Form->input("year", array("type" => "select", "class" => "form-control select2 yearWise pull-right", "options" => $years, "label" => false, "empty" => "Year", 'value' => $year)) ?>
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
        $.fn.loadModalData = function(type, category, id) {
            console.log(type, category, year);

            let url = encodeURI('<?php echo Router::url(array("controller" => "Admin", "action" => "cifDashboardDetail")); ?>?type=' + type + '&category=' + category + '&year=' + $('#year').val() + '&id=' + id);
            $('#chartDetailModalContent').load(url, function() {
                $('#chartDetailModal').modal({
                    show: true
                });
            });
        }

        // $('#cif_events').load('<?php echo Router::url(array("controller" => "cifDashboard", "action" => "events")); ?>');
        $('#year').on('change', function() {
            location.href = '<?php echo Router::url(array("controller" => "Admin", "action" => "cifDashboard")); ?>/' + $(this).val();
        });


    });
</script>
<script>
    function setCentre(type) {

        $.ajax({
            type: "POST",
            url: '<?php echo Router::url(array("controller" => "Home", "action" => "setCentre")); ?>',
            data: {
                centre: type
            },
            cache: false,
            success: function(html) {
                window.location.reload();
            }
        });
    }
</script>