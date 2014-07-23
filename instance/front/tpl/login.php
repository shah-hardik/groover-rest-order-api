<div class="col-lg-12" >
    <form name="Form1" action="" method="post">
        <div class="login " style="box-shadow:0 2px 7px rgba(0, 0, 0, 0.4)" >
            <?php if ($error != ''): ?>
                <div style="height:30px">&nbsp;</div>

                <div class="error" style="margin:0px 30px">
                    <img src="<?php print _MEDIA_URL ?>img/login-erroe.png" width="28" height="26" alt=" " />
                    <strong>ERROR:</strong> The password and username you entered 
                    is incorrect. 
                </div>
            <?php endif; ?>
            <div class="logo" style="color:white;font-weight:bold;padding-top:35px">
                <img src="<?php print _MEDIA_URL ?>img/ga_logo.png" />
            </div>
            <div class="fields" id="new_login" style="">
                <input type="text" name="email" id="email" placeholder="Email" />
                <input type="password" name="password" id="password" placeholder="Password" />
                <div><input type="submit" name="sbt_btn" id="sbt_btn" value="Login" class="login" style="" /></div>
                <div style="clear:both">&nbsp;</div>
            </div>

        </div>
    </form>
</div>

<div style="background-color: #00ccff;height:18px;position:fixed;bottom:0px;width:100%">
</div>