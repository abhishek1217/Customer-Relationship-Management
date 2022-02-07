<div class="sign-up">
            <p class="sign-up-text">Sign Up</p>
            <?php
            if(isset($_SESSION['success']))
            {
            ?>
            <div class="message">
                <strong>Success!   </strong><strong><?php echo $_SESSION['success'];?></strong>
            </div>
            <?php
            }
            unset($_SESSION['success']);
            if(isset($_SESSION['error']))
            {
            ?>
            <div class="message">
                <strong>Error!</strong> <?php echo $_SESSION['error']; ?>
            </div>
            <?php
            }
            unset($_SESSION['error']);
            ?>
            <form method="post">
                <div class="row">
                        <div class="col-25">
                            <label for="F_name">First Name</label>
                        </div>
                            <div class="col-75">
                                <input type="text" name = "F_name" class="reg-input"/>
                            </div>
                </div>
                <div class="row">
                        <div class="col-25">
                            <label for="L_name">Last Name</label>
                        </div>
                            <div class="col-75">
                                <input type="text" name="L_name" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                        <div class="col-25">
                            <label for="Gender">Gender</label>
                        </div>
                            <div class="col-75">
                                <input type="text" name="Gender" class="reg-input"/>
                            </div>
                </div>
                <div class="row">
                        <div class="col-25">
                            <label for="Phone_No">Phone No</label>
                        </div>
                            <div class="col-75">
                                <input type="number" name="Phone_No" class="reg-input"/>
                            </div>
                </div>
                <div class="row">
                        <div class="col-25">
                            <label for="Username">Username</label>
                        </div>      
                            <div class="0.75">
                                <input type="text" name="Username" class="reg-input"/>
                            </div>
                </div>
                <div class="row">
                        <div class="col-25">
                        <label for="email">Email</label>
                        </div>
                            <div class="col-75">
                        <input type="email" name="email">
                        </div>
                </div>
                <div class="row">
                        <div class="col-25">
                        <label for="pass">Password</label>
                        </div>
                            <div class="col-75">
                        <input type="password" name="pass" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                        <div class="col-25">
                        <label for="pass2">Confirm Password</label>
                        </div>
                            <div class="col-75">
                        <input type="password" name="pass2" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                        <div class="col-25">
                        <input class="create-button" type="submit" value="Sign Up">
                        </div>
                </div>
            </form>
        </div>