<div class="widget">
    <div class="tab_container" id="content">
        <div id="profile" class="tab_content">

            <div id="profile_img">
                <img width="120" height="120" src="images/avatar.png">
                <a class="btnMsgLeft mt5" href="#"><img class="icon" alt="" src="images/icons/dark/adminUser.png">
                    <span>Send Message</span></a>

            </div>
            <h4 class="hset"><?php echo empty($person->userDetails->first_name) ? "" : $person->userDetails->first_name . " " . $person->userDetails->last_name; ?></h4>
            <p class="sub_title"><?php echo empty($person->userDetails->city) ? "" : $person->userDetails->city . ", " . $person->userDetails->country; ?></p>
            <div class="hr"></div>
            <div class="profile-user-info-details"> 
                <?php
                if (!empty($person->userAcademics[0])) {
                    ?>
                    <div class="con_left"><strong> Education</strong></div>
                    <div class="info_right"><?php echo empty($person->userAcademics[0]->school) ? "" : $person->userAcademics[0]->school ?></div>
                    <?php
                }

                if (!empty($person->userRecomendations)) {
                    ?>
                    <div class="con_left"><strong> Recomendations</strong></div>
                    <div class="info_right"><?php echo empty($person->userRecomendations) ? "" : 'Recomended by ' . count($person->userRecomendations) . ' people' ?></div>
    <?php
}


if (!empty($person->userWorkExperiences)) {
    ?>




    <?php
    foreach ($person->userWorkExperiences as $workexperience) {

        if ($workexperience->is_working) {

            $website = $workexperience->website_url;
            ?>
                            <div class="con_left"> <strong>Current Employment</strong></div>
                            <div class="info_right">
                            <?php
                            echo $workexperience->organization . '</div>';
                            break;
                        }
                    }
                }

                if (!empty($website)) {
                    ?>



                        <div class="con_left"><strong> Website</strong></div>
                        <div class="info_right"><?php echo $website; ?></div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="fix"></div>
    </div>

    <div class="nugget_edit minus20">
        <!-- Main Nugget Info Div -->
        <div class="nugget_info">





<?php ?>



<?php
foreach ($details as $key => $detailArray) {
    echo '<div class="nugget_heading mt20">';
    echo '<span class="' . $key . '"></span>';
    echo '<h2>' . $key . '</h2>';
    echo '</div>';
    foreach ($detailArray as $detail) {
        ?>

                    <!--Nugget info start -->
                    <div class="ndata bbot">    
                        <div class="info_heading"><h4><span><?php echo $detail['title']; ?></span> <?php echo $detail['organization']; ?></h4></div>
                        <div class="right_mini_info"><?php echo $detail['date']; ?></div>
                        <div class="description"><?php echo $detail['description']; ?>.</div>
                        <div class="fix"></div>
                    </div>  <!--Nugget info end -->




    <?php }
} ?>






            <div class="fix"></div>
        </div>
        <div class="widgets"> </div>
    </div>












