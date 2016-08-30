<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Back'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
</ul>
</nav>

<div class="notes index large-9 medium-18 columns content float: left">
    <h3><?= __('Feedback') ?></h3>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('note_read') ?></th>
                <th><?= $this->Paginator->sort('created_on') ?></th>
                <th><?= $this->Paginator->sort('project_role') ?></th>
                <th colspan="2"><?= __('Preview') ?></th>
                <th class="actions"><?= __('Actions') ?></th>

            </tr>
        </thead>
        <tbody>
             <?php foreach ($notes as $note): ?>
                <tr>
                    <?php 
                    if ($note->note_read == NULL || $note->note_read == 0) {
                        $read = "unread";
                    } 
                    else {
                        $read = "read";
                    } 
                    $preview = substr($note->content, 0, 50);?>
                    <td><?= h($read) ?></td>
                    <td><?= h($note->created_on->format('d.m.Y')) ?></td>
                    <td><?= h($note->project_role) ?></td>
                    <td colspan="2"><?= h($preview ) ?></td>
                    <td class="Actions"><?= $this->Html->link(__('View'), ['action' => 'view', $note->id]) ?>
                    <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $note->id],
                            ['confirm' => __('Are you sure you want to delete # {0}?', $note->id)]
                        )?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>