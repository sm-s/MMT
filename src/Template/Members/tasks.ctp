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
        // sorting the array in order to get dates in descending order
        $tempHours = array();
        foreach ($member->workinghours as $temp) {
            $newDate = date("Y-m-d", strtotime($temp['created_on']));
            $temp['created_on'] = $newDate;
            $tempHours[] = $temp;
        }
        
        usort($tempHours, "cmp");
        function cmp($a, $b) {
            return strcmp($b['date'], $a['date']);
        } 

        //if (!empty($member->workinghours)): 
        if (!empty($tempHours)):  ?>
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
                <?php 
                    //foreach ($member->workinghours as $workinghours):
                    foreach ($tempHours as $hours): 
                    $query = Cake\ORM\TableRegistry::get('Worktypes')
                	->find()
                	->where(['id =' => $hours->worktype_id])
               		->toArray();
                    $worktype = $query[0];
                ?>
                <tr>
                    <td><?= h($hours->date->format('d.m.Y')) ?></td>
                    <td style="text-align: center;"><?= h($hours->date->format('W')) ?></td>
                    <td colspan="2" style="font-family:monospace;"><?= h(wordwrap($hours->description,25,"\n",TRUE)) ?></td>
                    <td style="text-align:center;"><?= $this->Number->format($hours->duration) ?></td>
	            <td><?= h($worktype->description) ?></td> 
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Workinghours', 'action' => 'view', $hours->id]) ?>
                    <?php
                        $admin = $this->request->session()->read('is_admin');
                        $supervisor = ( $this->request->session()->read('selected_project_role') == 'supervisor' ) ? 1 : 0;
                        $manager = ( $this->request->session()->read('selected_project_role') == 'manager' ) ? 1 : 0;
                    if ( ($member->user_id == $this->request->session()->read('Auth.User.id')) || $manager || $supervisor ||  $admin  ) { ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Workinghours', 'action' => 'edit', $hours->id]) ?>

                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Workinghours', 'action' => 'delete', $hours->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hours->id)]) ?> 
                    <?php } ?>
                    </td> 
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>    