<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?php
        // Edit link not visible to devs or managers
        $admin = $this->request->session()->read('is_admin');
        $supervisor = ( $this->request->session()->read('selected_project_role') == 'supervisor' ) ? 1 : 0;       
        if ($admin || $supervisor ) { ?>
            <li><?= $this->Html->link(__('Edit Member'), ['action' => 'edit', $member->id]) ?> </li>
        <?php } 
        // since clients and supervisors don't log time, no need to show a link to their hour 
        if (($member->project_role == 'developer') || ($member->project_role == 'manager')) { ?>
            <li><?= $this->Html->link(__('Logged tasks'), ['controller' => 'Members', 'action' => 'tasks', $member->id]) ?> </li>
        <?php } ?>
    </ul>
</nav>
<div class="members view large-8 medium-16 columns content float: left">
    <h3><?= h($member->user->first_name . " ". $member->user->last_name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Project Role') ?></th>
            <td><?= h($member->project_role) ?></td>
        </tr>
        <tr>
            <th><?= __('Starting Date') ?></th>
            <td><?php 
			if ($member->starting_date != NULL)
				echo h($member->starting_date->format('d.m.Y')); 
			?></td>
        </tr>
        <tr>
            <th><?= __('Ending Date') ?></th>
            <td><?php 
			if ($member->ending_date != NULL)
				echo h($member->ending_date->format('d.m.Y')); 
			?></td>
        </tr>
        <tr>
            <?php

            // Removed link from the email address 
            ?>
            <th><?= __('Email') ?></th>
            <td><?= $member->user->email ?></td>
                
        </tr>
    </table>
    <div class="related">
        <?php if (!empty($member->workinghours)): ?>
        <h4><?= __('Working hours') ?></h4>
            <table cellpadding="0" cellspacing="0">

                <tr>
                    <th><?= __('Worktype') ?></th>
                    <th><?= __('Hours') ?></th>
                </tr>

                <?php         
                $query = $member->workinghours;
                $memberID = $member->id;
               
                foreach ($query as $key) {
                   $hours[] = $key->duration;
                   $sum = array_sum($hours);  
                }
                // Fill array with zeros to avoid a bug if there are no workinghours of some work type
                $sums = array();
                $sums = array_fill(1, 5, 0);
                $id = 0;
                foreach($query as $key) {
                    $hour = 0;
                    if ($key->worktype_id === 1) {
                        $hour = $key->duration;
                        if (!(isset($sums[1]))) {
                            $sums[1] = $hour;
                        }
                        else {
                            $sums[1] += $hour;
                        }
                    }
                    if ($key->worktype_id === 2) {
                        $hour = $key->duration;
                        if (!(isset($sums[2]))) {
                            $sums[2] = $hour;
                        }
                        else {
                            $sums[2] += $hour;
                        }
                    }
                    if ($key->worktype_id === 3) {
                        $hour = $key->duration;
                        if (!(isset($sums[3]))) {
                            $sums[3] = $hour;
                        }
                        else {
                            $sums[3] += $hour;
                        } 
                    }
                    if ($key->worktype_id === 4) {
                        $hour = $key->duration;
                        if (!(isset($sums[4]))) {
                            $sums[4] = $hour;
                        }
                        else {
                            $sums[4] += $hour;
                        }
                    }
                    if ($key->worktype_id === 5) {
                        $hour = $key->duration;
                        if (!(isset($sums[5]))) {
                            $sums[5] = $hour;
                        }
                        else {
                            $sums[5] += $hour;
                        }
                    }                  
                }          
                // Get the names for worktypes
              	$queryForTypes = Cake\ORM\TableRegistry::get('Worktypes')
                    ->find()
                    ->toArray();
                ?>

                <?php             
                foreach($queryForTypes as $type): ?>
                <tr>
                    <td><?= h($type->description) ?></td>                
                    <td><?= h($sums[$type->id]) ?></td>

                <?php endforeach; ?>   
                </tr>
                <tr style="border-top: 2px solid black;">
                    <td><b><?= __('Total') ?></b></td> 
                    <td><b><?= h($sum) ?></b></td>
                </tr>    
            </table>
        <?php endif; ?>          
    </div>   
</div>
