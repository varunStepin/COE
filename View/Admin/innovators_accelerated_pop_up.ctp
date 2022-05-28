<div class="modal-header bg-info  font-size-30">
    <h5  class="box-title ">
       <?php echo  ucwords(implode(' ',preg_split('/(?=[A-Z])/',$type)));  ?>
    </h5>
    <!-- <i class="ti-printer font-size-18 mr-12" style="padding-right: 20px; cursor: pointer;" onclick="printTotEmp();"></i>-->
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">

        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php if($type=='mentor'){?>
            <table   class="table table-striped example_long table-bordered table-hover" >
                <thead>
                <tr>
                    <th>Sl no.</th>
                    <th>Name </th>
                    <th>Sector </th>
                    <th>No of Events</th>
                    <th>Event Name</th>

                </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<20;$i++){?>
                <tr>
                    <td><?php echo $i+1 ?></td>
                    <td>kiran <?php echo $i ?></td>
                    <td>IT</td>
                    <td>984</td>
                    <td>My Event <?php echo $i ?> </td>

                </tr>

                <?php }?>

                </tbody>
            </table>
            <?php } else if($type=='inventor'){?>
            <table   class="table table-striped example_long table-bordered table-hover" >
                <thead>
                <tr>
                    <th>Sl no.</th>
                    <th>Participants </th>
                    <th>Event name </th>
                    <th>Location</th>


                </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<20;$i++){?>
                    <tr>
                        <td><?php echo $i+1 ?></td>
                        <td> <?php echo $i+50 ?></td>
                        <td>My Event <?php echo $i ?> </td>
                        <td>Banglore India </td>

                    </tr>

                <?php }?>

                </tbody>
            </table>
            <?php } else if($type=='marketResearch'){?>
                <table   class="table table-striped example_long table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th>Sl no.</th>
                        <th>Research Name </th>


                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<20;$i++){?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td>An event is also one particular group of outcomes (= results) among all possible outcomes when experimenting</td>


                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            <?php } else if($type=='papers'){?>
                <table   class="table table-striped example_long table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th>Sl no.</th>
                        <th>Authors </th>
                        <th>Title</th>
                        <th>Stage</th>
                        <th>Baseline</th>
                        <th>Review</th>
                        <th>Publication</th>


                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<20;$i++){?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td>Author <?php echo $i+1 ?></td>
                            <td>Title <?php echo $i+1 ?></td>
                            <td>Stage <?php echo $i+1 ?></td>
                            <td>Baseline <?php echo $i+1 ?></td>
                            <td>Review <?php echo $i+1 ?></td>
                            <td>Publication <?php echo $i+1 ?></td>
                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            <?php } else if($type=='hackathons'){?>
                <table   class="table table-striped example_long table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th>Sl no.</th>
                        <th>Name </th>
                        <th>Place</th>
                        <th>Date</th>
                        <th>Participants</th>
                        <th>Speakers</th>



                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<20;$i++){?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td>Name <?php echo $i+1 ?></td>
                            <td>Place <?php echo $i+1 ?></td>
                            <td>12-02-2020</td>
                            <td>Participants <?php echo $i+1 ?></td>
                            <td>Speakers <?php echo $i+1 ?></td>
                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            <?php } else if($type=='solutionsSupported'){?>
                <table   class="table table-striped example_long table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th>Sl no.</th>
                        <th>Solution name </th>
                        <th>Team/Company</th>
                        <th>Status</th>




                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<20;$i++){?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td>Solution <?php echo $i+1 ?></td>
                            <td>Team <?php echo $i+1 ?></td>
                            <td>Active</td>

                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            <?php } else if($type=='deptsLiasoning'){?>
                <table   class="table table-striped example_long table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th>Sl no.</th>
                        <th>Dept name </th>
                        <th>Solution Name</th>
                        <th>Stage</th>




                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<20;$i++){?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td>Dept name <?php echo $i+1 ?></td>
                            <td>Solution Name  <?php echo $i+1 ?></td>
                            <td>Stage  <?php echo $i+1 ?></td>

                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            <?php } else if($type=='trainersEnrolled'){?>
                <table   class="table table-striped example_long table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th>Sl no.</th>
                        <th>Name </th>
                        <th>College</th>
                        <th>District</th>




                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<20;$i++){?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td>Name <?php echo $i+1 ?></td>
                            <td>College  <?php echo $i+1 ?></td>
                            <td>District  <?php echo $i+1 ?></td>

                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            <?php } else if($type=='traineesSecuredJobAfterTraining'){?>
                <table   class="table table-striped example_long table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th>Sl no.</th>
                        <th>Name </th>
                        <th>Company</th>
                        <th>DOJ</th>
                        <th>Position</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<20;$i++){?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td>Name <?php echo $i+1 ?></td>
                            <td>Company  <?php echo $i+1 ?></td>
                            <td>12-02-2020</td>
                            <td>Position  <?php echo $i+1 ?></td>

                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            <?php }?>


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
