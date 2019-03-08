<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <fieldset>
        <legend><?= __('User Details') ?></legend>
        <table class="table">
            <tbody>
                <tr>
                    <td>Name</td>
                    <td><?= $user->name;?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= $user->email;?></td>
                </tr>
                <tr>
                    <td>Total Units Comsumption</td>
                    <td id="units">****</td>
                </tr>
                <tr>
                    <td>Expected Bill Amount</td>
                    <td id="amount">****.**</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class='col-sm-6'>
                <div class="form-group">
                    <input type="text" id="datepicker1">
                    <input type="text" id="datepicker2">
                    <input type="hidden" id="type" value="year">
                    <button onClick="javascript:loadData()">Update</button>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0)" onClick="javascript:showData('year')" id="year">Yearly</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onClick="javascript:showData('month')" id="month">Monthly</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onClick="javascript:showData('day')" id="day">Daily</a>
            </li>
        </ul>
        <canvas id="myChart"></canvas>
    </fieldset>
</div>
<?php echo $this->Html->script("Chart.js");?>
<?php echo $this->Html->script("chartFunctions.js");?>
<script>
  $( function() {
    $( "#datepicker1" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $( "#datepicker2" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });
    
  } );
  </script>