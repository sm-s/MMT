<?php
echo $this->Html->css('jquery-ui.min');
echo $this->Html->script('jquery');
echo $this->Html->script('jquery-ui.min');
?>

<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav"></ul>
</nav>
<div class="workinghours form large-8 medium- columns content float: left">
    <?= $this->Form->create($workinghour) ?>
    <fieldset>
        <?php 
        // full name for the member
        $first= $this->request->session()->read('Auth.User.first_name');
        $last= $this->request->session()->read('Auth.User.last_name'); ?>
        <legend><?= __('Log time late for ') . $first . " " . $last ?></legend>    

        <?php

            // Req 21: Using jQuery UI datepicker
            echo $this->Form->input('date', ['type' => 'text', 'readonly' => true]);
            ?> </br>
        <?php  
            echo $this->Form->input('description');
            echo $this->Form->input('duration', array('style' => 'width: 35%;'));
            echo $this->Form->input('worktype_id', ['options' => $worktypes]);
        
            $project_id = $this->request->session()->read('selected_project')['id'];
            $query1 = Cake\ORM\TableRegistry::get('Weeklyreports')
                ->find()
           	->select(['year','week']) 
            	->where(['project_id =' => $project_id])
                ->toArray(); 
            
            if ($query1 != null) {
                // picking out the week of the last weekly report from the results
                $max = max($query1);

                $maxYear = $max['year'];
                $maxWeek = $max['week'];
                
                //$mDate: the first day of the new weeklyreport week (monday)
                $monday = new DateTime();
                $monday->setISODate($maxYear,$maxWeek,1);
                $mDate1 = $monday->format('d M Y');
                $mDate = date('d M Y', strtotime($mDate1));
            }
			
            echo $this->Form->button(__('Submit'));
        ?>    
    </fieldset>
    <?= $this->Form->end() ?>
</div>

<script> 
    /*
     * Req 21:
     * minDate is the monday of the week of the weeklyreport
     * maxDate is the current day
     */
    $( "#date" ).datepicker({
        dateFormat: "MM d, yy",
        minDate: new Date('<?php echo $mDate; ?>'),
        maxDate: '0', 
        firstDay: 1,
        showWeek: true,
        showOn: "both",
        buttonImage: "../webroot/img/glyphicons-46-calendar.png",
        buttonImageOnly: true,
        buttonText: "Select date"       
    });
</script>


