<?php

// first we include the head that is the same for every kind of page


?>


<body>

    <header class="navbar navbar-default navbar-static-top" role="banner">
      <div class="container">
          <div class="navbar-header">
              <a href="/" class="navbar-brand"><?php echo $_globals_obj->get_value('titlelink'); ?></a>
          </div>
              <nav class="collapse navbar-collapse" role="navigation">
                <ul class="nav navbar-nav">
                  <?php
                    foreach ($_globals_obj->get_value('categories') as $categories)
                    {
                     echo '<li><a id="category" class="titlelink uri white-link" href="' . $categories['uri'] . '">' . $categories['titlelink'] .  '</a></li>';  
                    }
                    ?>
                </ul>
              </nav>
      </div>
    </header>





<!-- Begin Body -->
<div class="container">




                <div class="row">
                  <!-- <div class="col-md-6"> -->
                  <div class="col-md-9">
                    <div class="float-left">

                    <h1><?php echo $_globals_obj->get_value('h1'); ?> </h1>


                    <?php
                      if ($_globals_obj->get_value('ads') > 0)
                      {

                        echo '<!-- adsense big rectangle 336 x 280 -->';
                        echo '<div class="float-right ad">';
                        echo '<img src="https://storage.googleapis.com/support-kms-prod/SNP_2922295_en_v0"></img>';
                        echo '</div>';

                      }
                    ?>
                    

                    <?php echo $_globals_obj->get_value('bodyp1'); ?>   



                    <h2><?php echo $_globals_obj->get_value('h2'); ?> </h2>


                    <?php
                      if ( ($_globals_obj->get_value('ads') > 0) && (($_globals_obj->get_value('bodyp2') != '') ))
                      {

                        echo '<!-- adsense big rectangle 336 x 280 -->';
                        echo '<div class="float-left ad">';
                        echo '<img src="https://storage.googleapis.com/support-kms-prod/SNP_2922295_en_v0"></img>';
                        echo '</div>';

                      }
                    ?>


                    <?php echo $_globals_obj->get_value('bodyp2'); ?>   




                  </div>
                </div>



                    <?php
                      if ($_globals_obj->get_value('ads') > 0)
                      {

                        echo '<!-- adsense big leaderboard 970 x 90 -->';
                        echo '<div class="panel-body">';
                        echo '<img src="https://storage.googleapis.com/support-kms-prod/SNP_0B1FFF853210889959A6510E67D85CE5C919_3094744_en_v1"></img>';
                        echo '</div>';

                      }
                    ?>










              </div>

</div>
        
</body>