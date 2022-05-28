<div class="modal-header bg-info  font-size-30">
    <h5 class="box-title ">
        <?=  ' Details Of Participants '  ?>
    </h5>
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">
        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php if ($queryString['type'] == 'CifRoundtableParticipant') { ?>
                <table class="table example_long table-striped table-bordered table-hover">
                        <thead class="bg-primary-gradient text-white">
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Participant Name</th>
                                <th>Gender</th>
                                <th>Contact Number</th>
                                <th>email</th>
                                <th>Organizatiom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($table_list as $list) {  ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $list['CifRoundtable']['name']; ?></td>
                                    <td><?php echo $list['CifRoundtableParticipant']['participant_name']; ?></td>
                                    <td><?php echo $list['CifRoundtableParticipant']['gender']; ?></td>
                                    <td><?php echo $list['CifRoundtableParticipant']['contact_number']; ?></td>
                                    <td><?php echo $list['CifRoundtableParticipant']['email']; ?></td>
                                    <td><?php echo $list['CifRoundtableParticipant']['organization']; ?></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                </table>
            <?php }  ?>
        </div>
    </div>
</div>
<div class="modal-footer modal-footer-uniform">
    <button type="button" class="btn btn-bold btn-pure btn-info btn-sm float-right" data-dismiss="modal">Close</button>
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
