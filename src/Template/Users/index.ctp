<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->created) ?></td>
                <td class="actions">
                    <?php echo $this->Html->image("icons/view.png", [
                            "alt" => "Meter Details",
                            "style" => "width:25px;height:25px;",
                            'url' => ['controller' => 'Users', 'action' => 'view', $user->id]
                        ]);?>
                    <?php echo $this->Html->image("icons/meter.png", [
                            "alt" => "Meter Details",
                            "style" => "width:25px;height:25px;",
                            'url' => ['controller' => 'Users', 'action' => 'meterDetails', $user->id]
                        ]);?>
                    <?php echo $this->Html->image("icons/edit.png", [
                            "alt" => "Meter Details",
                            "style" => "width:25px;height:25px;",
                            'url' => ['controller' => 'Users', 'action' => 'edit', $user->id]
                        ]);?>
                    <?= $this->Form->postLink($this->Html->image("icons/remove.png", [
                            "alt" => "Meter Details",
                            "style" => "width:25px;height:25px;"
                        ]), ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td> 
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
