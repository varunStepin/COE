<div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
    <h5  class="box-title text-white">
        <?php echo $title;  ?>
    </h5>
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">
        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php
            if($type=='ManageFacility'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Project Name</th>
                        <th>No. Hours Utilized</th>
                        <th>Year Wise Target</th><th>Phase</th>
                        <th>Resources Used</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['list_of_equipments'] ?></td>
                            <td><?= $list[$type]['no_of_hours_utilized'] ?></td>
                            <td><?= $list[$type]['yearwise_target'] ?></td><td><?= $list[$type]['phase'] ?></td>
                            <td><?= $list[$type]['details_of_revenue'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>

</div>
<div class="modal-footer modal-footer-uniform">
    <!--<button type="button" class="btn btn-bold btn-pure btn-info  float-right" onclick="upcoming_birthday();">Upcoming</button>-->
    <button type="button" class="btn btn-bold btn-pure btn-info btn-sm float-right" data-dismiss="modal">Close</button>
</div>
<script>
    $(function () {
        'use strict'

        $('.model_slim_scroll').slimScroll({
            height: '300px'
        });
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
</script>
