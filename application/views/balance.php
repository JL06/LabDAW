<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<section id="main-content">
          <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i>Balance</h3>
              <!-- page start-->
              <div id="morris">
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Chart Example 1</h4>
                              <div class="panel-body">
                                  <div id="hero-graph" class="graph"></div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Chart Example 2</h4>
                              <div class="panel-body">
                                  <div id="hero-bar" class="graph"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Chart Example 3</h4>
                              <div class="panel-body">
                                  <div id="hero-area" class="graph"></div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Chart Example 4</h4>
                              <div class="panel-body">
                                  <div id="hero-donut" class="graph"></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
 <?php 
    echo '<script src="';
    echo base_url("files/js/jquery.js") . '"></script>' ;
    echo '<script src="';
    echo base_url("files/js/jquery-1.8.3.min.js") . '"></script>' ;
    ?>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
      <?php 
    echo '<script src="';
    echo base_url("files/js/morris-conf.js") . '"></script>' ;
    ?>
    <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>