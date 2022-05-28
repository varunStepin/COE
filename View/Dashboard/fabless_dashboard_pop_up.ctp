<div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
    <h5  class="box-title text-white">
        <?php echo $title;  ?>
    </h5>
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">
        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php
            if($type=='Companies'){?>
                <table class="table table-striped example_long table-bordered table-responsive table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Company Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Product</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Website</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['name'] ?></td>
                            <td><?= $list[$type]['company_type'] ?></td>
                            <td><?= $list[$type]['status'] ?></td>
                            <td><?= $list[$type]['product'] ?></td>
                            <td><?= $list[$type]['email'] ?></td>
                            <td><?= $list[$type]['mobile'] ?></td>
                            <td><?= $list[$type]['website'] ?></td>
                            <td><?= $list[$type]['address'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='PartnerDetail'){?>
                <table class="table table-striped example_long table-bordered  table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Partner Name</th>
                        <th>Contact Person</th>
                        <th>Mobile No</th>
                        <th>Partner Type</th>
                        <th>Sub Type</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['partner_name'] ?></td>
                            <td><?= $list[$type]['contact_person'] ?></td>
                            <td><?= $list[$type]['mobile'] ?></td>
                            <td><?= $list[$type]['partner_type'] ?></td>
                            <td><?= $list[$type]['sub_type'] ?></td>
                            <td><?= $list[$type]['status'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='IncubateeDetail'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Company Name</th>
                        <th>Contact Person</th>
                        <th>Mobile No</th>
                        <th>Type</th>
                        <th>Sub Type</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['company_name'] ?></td>
                            <td><?= $list[$type]['contact_person'] ?></td>
                            <td><?= $list[$type]['mobile'] ?></td>
                            <td><?= $list[$type]['incubatee_type'] ?></td>
                            <td><?= $list[$type]['sub_type'] ?></td>
                            <td><?= $list[$type]['status'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            ?>
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
