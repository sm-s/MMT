<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav"></ul>
</nav>
<div class="users form large-8 medium-16 columns content float: left">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit profile') ?></legend>
            <h4 style="font-size:100%;">General</h4><?php
            echo $this->Form->input('email');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('phone');
            ?><h4 style="font-size:100%;">Password</h4><?php
            echo $this->Form->input('password', ['value' => '', 'id' => 'key', 'empty']);
            ?>
            <label class="confirmPassword">Retype the password</label>
                <input type="password" name="confirm_key" id="confirm_key"> </input> <span id='message'></span>
            <br><?php
            echo $this->Form->button(__('Submit'));
            ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>

<script>
    $('#confirm_key').on('keyup', function () {
        if ($(this).val() == $('#key').val()) {
            $('#message').html('Passwords match').css('color', 'green');
        } 
        else { 
            $('#message').html('Confirmation password is not a match').css('color', 'orange');
        }    
    });
</script>