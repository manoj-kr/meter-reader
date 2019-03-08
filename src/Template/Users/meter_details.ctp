<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
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
                    <td>No. of Units</td>
                    <td>****</td>
                </tr>
            </tbody>
        </table>
        <canvas id="myChart"></canvas>
    </fieldset>
</div>
<?php echo $this->Html->script("Chart.js");?>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Units',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    $.ajax({
        url: 'http://localhost/myapp/users/random',
        type: 'GET',
        dataType: 'JSON',
        beforeSend: function(){
            $('#progress').fadeIn();
        },
        success: function(){
            $('#progress').fadeIn();
            var ctx = document.getElementById("myChart").getContext('2d');
            
        }
        complete: function(){
            $('#progress').fadeOut();
        }
        error: function(){
            console.log('There was some error while requesting')
        }
    })
</script>