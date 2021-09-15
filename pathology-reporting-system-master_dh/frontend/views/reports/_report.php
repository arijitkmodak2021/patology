
<table cellspacing="0" cellpadding="0" style="width: 100%; margin-left: 5em;">

    <tr>
        <th width="10" align="left">
            <p><u>S.No.</u></p>
        </th>
        <th width="40" align="left">
            <p><u>Test Name</u></p>
        </th>
        <th width="15" align="left">
            <p><u>Result</u></p>
        </th>
        <th width="25" align="right">
            <p><u>Reference Interval</u></p>
        </th>
    </tr>

    <?php if(isset($model->patientTests)) {
        foreach($model->patientTests as $key => $test) {
            ?>
            <tr>
                <td  width="10" align="left"><?= $key+1;?></td>
                <td  width="40" align="left"><?= isset($test->testsType)?$test->testsType->name:'-'; ?></td>
                <td  width="15" align="left"><?= $test->test_result;?></td>
                <td  width="25" align="right"><?= isset($test->testsType)?$test->testsType->reference_interval:'-';?></td>
                <p><br \></p>
            </tr>

            <?php
        }
    } ?>
</table>
<br>
<?php if(!empty($model->summary)): ?>
    <div class="col-md-12 notice">
        <h3>Summary</h3>
        <div class="well">
            <?= nl2br($model->summary)  ;?>
        </div>
    </div><!--/col-->
<?php endif; ?>
<br>
<br><br>
