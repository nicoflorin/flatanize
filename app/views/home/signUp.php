<div class="well">
<div class="page-header">
    <h1>Sign Up</h1>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php 
        if (isset($data)) {
            echo '<div class="alert alert-danger" role="alert"><p>Please provide all required information!</p></div>';
        }
        ?>
        
        <form role="form" action="<?php echo URL?>home/register" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo ($data['username'] == "false") ? 'has-error' : '' ?>">
                        <input type="text" value = "<?php echo ($data['username'] != "false") ? $data['username'] : '' ?>" name="username" id="first_name" class="form-control input-lg" placeholder="User Name" tabindex="1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo ($data['displayname'] == "false") ? 'has-error' : '' ?>">
                        <input type="text" value = "<?php echo ($data['displayname'] != "false") ? $data['displayname'] : '' ?>" name="displayname" id="last_name" class="form-control input-lg" placeholder="Display Name" tabindex="2">
                    </div>
                </div>
            </div>
            <div class="form-group <?php echo ($data['email'] == "false") ? 'has-error' : '' ?>">
                <input type="email" value = "<?php echo ($data['email'] != "false") ? $data['email'] : '' ?>" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
            </div>
            <div class="form-group <?php echo (isset($data['password'])) ? 'has-error' : '' ?>">
                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
            </div>
            <div class="form-group">
                <input type="text" name="wg_code" id="wg_code" class="form-control input-lg" placeholder="Flat Code (if available)" tabindex="5">
            </div>
            <div class="form-group">
                <input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
            </div>
        </form>
    </div>
</div><!-- end row -->
</div>