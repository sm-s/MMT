<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        
        <?php

// SUMMER MMT
        // Link not visible to devs or managers
        $admin = $this->request->session()->read('is_admin');
        $supervisor = ( $this->request->session()->read('selected_project_role') == 'supervisor' ) ? 1 : 0;       
        if ($admin || $supervisor ) { ?>
            <li><?= $this->Html->link(__('Edit Member'), ['action' => 'edit', $member->id]) ?> </li>
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
        <h4><?= __('Working hours') ?></h4>
        <?php if (!empty($member->workinghours)): ?>
            <table cellpadding="0" cellspacing="0">

                <tr>
                    <th><?= __('Worktype') ?></th>
                    <th><?= __('Hours') ?></th>
                </tr>

                <?php         
                $query = $member->workinghours;
                $memberID = $member->id;
                // Total of workinghours
                foreach ($query as $key) {
                   $hours[] = $key->duration;
                   $sum = array_sum($hours);  
                }
                // Hours per worktype
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

        <h4><?= __('Logged tasks') ?></h4>
        <?php if (!empty($member->workinghours)): ?>
            <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>                  
                    <th><?= __('Date') ?></th>                    
                    <th style="width:220px;"><?= __('Description') ?></th>
                    <th style="width:70px;"><?= __('Duration') ?></th>
                    <th><?= __('Worktype') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
                <?php foreach ($member->workinghours as $workinghours): 
                	$query = Cake\ORM\TableRegistry::get('Worktypes')
                		->find()
                		->where(['id =' => $workinghours->worktype_id])
                		->toArray();
                	$worktype = $query[0];
                ?>
                <tr>
                    <td><?= h($workinghours->date->format('d.m.Y')) ?></td>
                    <?php 
                    /*<td><?= h(Cake\Utility\Text::wrap($workinghours->description, ['width' => 15, 'wordWrap' => false])) ?></td>*/ ?>
                    <td><?= h(wordwrap($workinghours->description,33,"\n",TRUE)) ?></td>
                    <td style="text-align:center;"><?= $this->Number->format($workinghours->duration) ?></td>
	                <td><?= h($worktype->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Workinghours', 'action' => 'view', $workinghours->id]) ?>
                    <?php
                        $admin = $this->request->session()->read('is_admin');
                        $supervisor = ( $this->request->session()->read('selected_project_role') == 'supervisor' ) ? 1 : 0;
                        $manager = ( $this->request->session()->read('selected_project_role') == 'manager' ) ? 1 : 0;
                        
                        // the week and the year of the workinghour
                        $week= $workinghours->date->format('W');
                        $year= $workinghours->date->format('Y');
                        $firstWeeklyReport = false;
                        // the week and year of the last weekly report
                        $project_id = $this->request->session()->read('selected_project')['id'];
                        $query = Cake\ORM\TableRegistry::get('Weeklyreports')
                            ->find()
                            ->select(['year','week']) 
                            ->where(['project_id =' => $project_id])
                            ->toArray();
                        if ($query != null) {
                            // picking out the week of the last weeklyreport from the results
                            $max = max($query);
                            $maxYear = $max['year'];
                            $maxWeek = $max['week'];
                        }
                        else {
                            $firstWeeklyReport = true;
                        }

                        // edit and delete are only shown if the weekly report is not sent
                        // edit and delete can also be viewed by the developer who owns them

			// IF (you are the owning user or a manager) AND workinghour isn't from previous weeks
			// OR you are an admin or a supervisor
			 
                        if ( ( ($member->user_id == $this->request->session()->read('Auth.User.id') || $manager)                        
                                && ($firstWeeklyReport || (($year >= $maxYear) && ($week > $maxWeek) ) ) ) 
                                                || ($admin || $supervisor) ) { ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Workinghours', 'action' => 'edit', $workinghours->id]) ?>

                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Workinghours', 'action' => 'delete', $workinghours->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workinghours->id)]) ?> 
                    <?php } ?>
                </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
