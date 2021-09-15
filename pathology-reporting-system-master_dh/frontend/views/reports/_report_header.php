<div style="width: 100%; margin: 0 auto; text-align: center">
   
</div>
<p><br \></p>
<p><br \></p>
<p><br \></p>
<p><br \></p>
<p><br \></p>
<p><br \></p>
<p><br \></p>
<table cellspacing="0" cellpadding="0" style="width:100%;margin-left: 5em;" >
    <tr>
        <td class="tr0 td0">
            <p class="p0 ft0">Name </p>
        </td>
        <td class="tr0 td1">
            <p class="p1 ft0"><strong>: <?= isset($model->patient->user)?$model->patient->user->name:"-"; ?></strong></p>
        </td>
        <td class="tr0 td0">
            <p class="p5 ft0">Referred By</p>
        </td>
        <td class="tr0 td1">
            <p class="p1 ft0"><strong>: <?= $model->referred_doctor;?></p>
        </td>
    </tr>
    <tr>
        <td class="tr0 td5">
            <p class="p2 ft0">Gender</p>
        </td>
        <td class="tr0 td6">
            <p class="p4 ft0">
                <?php if(isset($model->patient)) {
                    if($model->patient->gender == 'm') {
                        echo ": Male";
                    } else {
                        echo ": Female";
                    }
                } ?>
            </p>
        </td>
        <td class="tr0 td2">
            <p class="p2 ft0">Sample No</p>
        </td>
        <td colspan="2" class="tr0 td13">
            <p class="p2 ft0">
                <nobr>: <?= $model->sample_no;?></nobr>
            </p>
        </td>
    </tr>

    <tr>
        <td class="tr0 td2">
            <p class="p0 ft0">Age</p>
        </td>
        <td class="tr0 td3">
            <p class="p2 ft0">: 
                <?= $model->patient->dob;?>
            </p>
        </td>
        <td class="tr0 td2">
            <p class="p2 ft0">Reported On</p>
        </td>
        <td class="tr0 td3">
            <p class="p2 ft0">: <?= date_format(date_create($model->created_date),"d M Y, H:i")?></p>
        </td>
    </tr>
    
</table>
<p><br \></p>