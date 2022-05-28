<div class="table-wrapper-scroll-y">
    <div class="table-responsive model_slim_scroll" style="height: 500px">
        <?php if ($type == 'is_innovations_commercialized') { ?>
            <table class="table table-striped example_long table-bordered table-hover">
                <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Startup Name</th>
                        <th>Type</th>
                        <th>Incubated Date</th>
                        <th>Status</th>
                        <th>OutCome</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($manage_list as $key => $list) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list['TbiStartup']['startup_name'] ?></td>
                            <td><?= $list['TbiStartup']['startup_type'] ?></td>

                            <td><?php echo  $list['TbiStartup']['innovation_date'] ?></td>
                            <td><?= $list['TbiStartup']['status'] ?></td>
                            <td><?= $list['TbiStartup']['outcome'] ?></td>
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>
        <?php } else  if ($type == 'is_incubated_off_tbi') { ?>
            <table class="table table-striped example_long table-bordered table-hover">
                <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Startup Name</th>
                        <th>Type</th>
                        <th>Incubated Date</th>
                        <th>Status</th>
                        <th>OutCome</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($manage_list as $key => $list) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list['TbiStartup']['startup_name'] ?></td>
                            <td><?= $list['TbiStartup']['startup_type'] ?></td>
                            <td><?= $list['TbiStartup']['tbi_date'] ?></td>
                           <td><?=  $list['TbiStartup']['tbi_status'] ?></td>
                            <td><?= $list['TbiStartup']['tbi_outcome'] ?></td>
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>
        <?php }  else if ($type == 'is_event_conducted') { ?>
            <table class="table table-striped example_long table-bordered table-hover">
                <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                       
                        <th>Event Name</th>
                        <th>Event Date</th>
                        <th>Event Location</th>
                        


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($manage_list as $key => $list) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            
                            <td><?= $list['TbiEvent']['event_name'] ?></td>

                            <td><?php
                                echo ($list['TbiEvent']['event_date'] != '0000-00-00') ? date('d-m-Y', strtotime($list['TbiEvent']['event_date'])) : '-' ?></td>
                            <td><?= $list['TbiEvent']['event_location'] ?></td>
                           
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>
        <?php }    else { ?>
            <table class="table table-striped example_long table-bordered table-hover">
                <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Startup Name</th>
                        <th>Type</th>
                        <?php
                        if ($type == 'is_incubated') {
                            echo "<th>Incubated Date</th>";
                        } else  if ($type == 'is_graduated') {
                            echo "<th>Graduated Date</th>";
                        }
                        ?>
                        <th>Details</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($manage_list as $key => $list) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $list['TbiStartup']['startup_name'] ?></td>
                            <td><?= $list['TbiStartup']['startup_type'] ?></td>

                            <?php if ($type == 'is_incubated') { ?>
                                <td><?php
                                    echo ($list['TbiStartup']['incubation_start_date'] != '0000-00-00') ? date('d-m-Y', strtotime($list['TbiStartup']['incubation_start_date'])) : '-' ?>
                                </td>
                            <?php } ?>
                            <?php if ($type == 'is_graduated') { ?>
                                <td><?php
                                    echo  $list['TbiStartup']['graduated_date']; ?>
                                </td>
                            <?php } ?>
                            <td><?= $list['TbiStartup']['details'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>


<script>
    $(function() {
        'use strict'

        $('.model_slim_scroll').slimScroll({
            height: '300px'
        });
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
</script>