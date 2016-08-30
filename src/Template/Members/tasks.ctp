<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?php use Cake\I18n\Time;
        // back to member's page ?>
        <li><?= $this->Html->link(__('Back'), ['action' => 'view', $member->id]) ?></li>
    </ul>
</nav>
<div class="workinghours index large-9 medium-18 columns content float: left">
    <h3><?= h($member->user->first_name . " ". $member->user->last_name) ?></h3>
    <div class="related">
    <h4><?= __('Logged tasks') ?></h4>
        <?php 
        // reversing the array in order to get dates in descending order
        $preserved = array_reverse($member->workinghours, true);
        if (!empty($preserved)): ?>
            <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>                  
                    <th><?= __('Date') ?></th>
                    <th style="width:60px;"><?= __('Week') ?></th>                    
                    <th colspan="2"><?= __('Description') ?></th>
                    <th style="width:70px;"><?= __('Duration') ?></th>
                    <th><?= __('Worktype') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
                <?php foreach ($preserved as $workinghours): 
                	$query = Cake\ORM\TableRegistry::get('Worktypes')
                		->find()
                		->where(['id =' => $workinghours->worktype_id])
                		->toArray();
                	$worktype = $query[0];
                ?>
                <tr>
                    <td><?= h($workinghours->date->format('d.m.Y')) ?></td>
                    <td style="text-align: center;"><?= h($workinghours->date->format('W')) ?></td>
                    <td colspan="2" style="font-family:monospace;"><?= h(wordwrap($workinghours->description,25,"\n",TRUE)) ?></td>
                    <!--<td><?= h(wordwrap($workinghours->description,33,"\n",TRUE)) ?></td>-->
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