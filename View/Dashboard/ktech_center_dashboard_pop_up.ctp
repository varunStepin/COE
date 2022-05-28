<div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
    <h5  class="box-title text-white">
        <?php echo $title;  ?>
    </h5>
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">
        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php
            if($type=='ManageAgricultureInnovation'){?>
                <table class="table table-striped example_long table-bordered table-responsive table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>No. of concepts Registered </th>
                        <th>Details of Innovation</th>
                        <th>Complete detail of shortlisted Innovation</th>
                        <th>Incubation start Date</th>
                        <th>Current Status</th>
                        <th>Incubation Outcome</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['no_of_concepts_registered'] ?></td>
                            <td><?= $list[$type]['detail_innovation'] ?></td>
                            <td><?= $list[$type]['shortlisted_innvoation_detail'] ?></td>
                            <td><?= $list[$type]['incubation_start_date'] ?></td>
                            <td><?= $list[$type]['current_status'] ?></td>
                            <td><?= $list[$type]['incubation_outcome'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='ManageProblemStatement'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Details</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['details'] ?></td>
                            <td><?= $list[$type]['types'] ?></td>
                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='KtechEventConducted'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Speakers</th>
                        <th>No. Participants</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['title'] ?></td>
                            <td><?= $list[$type]['date'] ?></td>
                            <td><?= $list[$type]['speakers'] ?></td>
                            <td><?= $list[$type]['no_participants'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='KtechPartnership'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Organization</th>
                        <th>Partnership Nature</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['organization'] ?></td>
                            <td><?= $list[$type]['partnership_nature'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='KtechFundRaisedStartup'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Startup Name</th>
                        <th>Fund Amount</th>
                        <th>Funding Agency</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$list){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list[$type]['startup_name'] ?></td>
                            <td><?= $list[$type]['fund_amount'] ?></td>
                            <td><?= $list[$type]['funding_agency'] ?></td>
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
