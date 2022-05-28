<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Financial Year</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Financial Year</a></li>
        </ol>
    </section>
    <section class="content mainCards">
        <div class="row">
            <div class="col-lg-4 col-12">
                <?php
                echo $this->Form->create('FinancialYear',array("url"=>array("controller"=>"Admin","action"=>"financialYear")));?>
                <?php echo $this->Form->input('id',array('type'=>'hidden','class'=>'form-control',"label"=>false));?>
                <div class="box">
                    <div class="box-header with-border"><h4 class="box-title">Financial Year</h4></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Year <span class="text-danger">*</span></label>
                                    <?php echo $this->Form->input('year',array('type'=>'text','class'=>'form-control','required',"placeholder"=>"year","label"=>false));?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Is Current Financial Year ? <span class="text-danger">*</span></label>
                                    <br/>
                                    <?php $options = array('1'=> 'YES','0'=>'No');
                                    $attributes = array('legend' => false,'','default' => 'No');
                                    echo $this->Form->radio('current', $options, $attributes); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="clearfix pull-right">
                            <?php
                            if (empty($this->request->data['MiPrograms']['id'])) {
                                echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-danger btn-sm", "label" => false));
                            } else {
                                echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-danger btn-sm", "label" => false));
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <div class="col-lg-8 col-12">
                <div class="box">
                    <div class="box-header with-border"><h4 class="box-title">Financial Year</h4></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table example_long table-striped table-bordered table-hover" >
                                    <thead style="font-size:15px; font-weight:bold;">
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Year</th>
                                        <th>Current Year</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=0;
                                    foreach($year_list as $item){
                                    $id=$item['FinancialYear']['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $item['FinancialYear']['year']; ?></td>
                                        <td><?php echo ($item['FinancialYear']['current'] ? 'Yes' : 'No' ); ?></td>
                                        <td><?php
                                            echo $this->Html->link('<i  class="glyphicon glyphicon-edit" data-toggle="tooltip" data-original-title="Edit"></i>',array("controller"=>"Admin","action"=>"financialYear",$id,'Edit'), array("escape"=>false)).' ';
                                            echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash" data-toggle="tooltip" data-original-title="Delete"></i>'
                                                    ,array("controller"=>"Admin","action"=>"financialYear",$id,'Delete'),
                                                    array("confirm"=>"Are you sure you want ro delete???","escape"=>false));
                                            ?>
                                        </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
